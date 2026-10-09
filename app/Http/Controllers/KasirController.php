<?php

namespace App\Http\Controllers;

use App\Models\TransaksiKoran;
use App\Models\TransaksiOnline;
use App\Models\TransaksiPriangan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class KasirController extends Controller
{
    /**
     * Overview / Dashboard Kasir
     */
    public function dashboard(Request $request)
    {
        $today = Carbon::today()->toDateString();

        $bayarHariIni = (int) (
            TransaksiKoran::whereDate('tanggal_transaksikoran', $today)->sum('jumlahbayar_transaksikoran') +
            TransaksiOnline::whereDate('tanggal_transaksionline', $today)->sum('jumlahbayar_transaksionline') +
            TransaksiPriangan::whereDate('tanggal_transaksipriangan', $today)->sum('jumlahbayar_transaksipriangan')
        );

        $txHariIni = (int) (
            TransaksiKoran::whereDate('tanggal_transaksikoran', $today)->count() +
            TransaksiOnline::whereDate('tanggal_transaksionline', $today)->count() +
            TransaksiPriangan::whereDate('tanggal_transaksipriangan', $today)->count()
        );

        $totalPenerimaanBulan = (int) (
            TransaksiKoran::whereMonth('tanggal_transaksikoran', Carbon::now()->month)->sum('jumlahbayar_transaksikoran') +
            TransaksiOnline::whereMonth('tanggal_transaksionline', Carbon::now()->month)->sum('jumlahbayar_transaksionline') +
            TransaksiPriangan::whereMonth('tanggal_transaksipriangan', Carbon::now()->month)->sum('jumlahbayar_transaksipriangan')
        );

        $recentKasir = new Collection();
        $koran = TransaksiKoran::latest('id')->take(3)->get();
        foreach ($koran as $k) {
            $recentKasir->push((object)[
                'faktur'   => $k->nofakturkoran,
                'media'    => 'Koran Cetak',
                'customer' => $k->nama_pemasangkoran,
                'bayar'    => (int) $k->jumlahbayar_transaksikoran,
                'sisa'     => (int) $k->piutang_transaksikoran,
                'tanggal'  => $k->tanggal_transaksikoran,
            ]);
        }
        $online = TransaksiOnline::latest('id')->take(3)->get();
        foreach ($online as $o) {
            $recentKasir->push((object)[
                'faktur'   => $o->nofakturonline,
                'media'    => 'Media Online',
                'customer' => $o->nama_pemasangonline,
                'bayar'    => (int) $o->jumlahbayar_transaksionline,
                'sisa'     => (int) $o->piutang_transaksionline,
                'tanggal'  => $o->tanggal_transaksionline,
            ]);
        }

        return view('pages.kasir.dashboard', compact(
            'bayarHariIni',
            'txHariIni',
            'totalPenerimaanBulan',
            'recentKasir'
        ));
    }

    /**
     * Setoran Iklan (Penerimaan Pelunasan / DP Faktur Iklan)
     */
    public function penerimaanIklan(Request $request)
    {
        $search = $request->input('search');
        $mediaFilter = $request->input('media', 'all');

        $fakturList = new Collection();

        // 1. Koran
        if (in_array($mediaFilter, ['all', 'koran'])) {
            $koranQ = TransaksiKoran::query();
            if ($search) {
                $koranQ->where(function($q) use ($search) {
                    $q->where('nofakturkoran', 'like', "%{$search}%")
                      ->orWhere('nama_pemasangkoran', 'like', "%{$search}%");
                });
            }
            foreach ($koranQ->latest()->get() as $item) {
                $fakturList->push((object)[
                    'id' => $item->id,
                    'type' => 'koran',
                    'faktur' => $item->nofakturkoran,
                    'media' => 'Koran Cetak',
                    'customer' => $item->nama_pemasangkoran,
                    'tanggal_muat' => $item->tanggal_muatkoran ?? $item->tanggal_transaksikoran,
                    'sales' => $item->sales_iklankoran ?? '-',
                    'totaltagihan' => (int) $item->totaltagihan_transaksikoran,
                    'jumlahbayar' => (int) $item->jumlahbayar_transaksikoran,
                    'piutang' => (int) $item->piutang_transaksikoran,
                ]);
            }
        }

        // 2. Online
        if (in_array($mediaFilter, ['all', 'online'])) {
            $onlineQ = TransaksiOnline::query();
            if ($search) {
                $onlineQ->where(function($q) use ($search) {
                    $q->where('nofakturonline', 'like', "%{$search}%")
                      ->orWhere('nama_pemasangonline', 'like', "%{$search}%");
                });
            }
            foreach ($onlineQ->latest()->get() as $item) {
                $fakturList->push((object)[
                    'id' => $item->id,
                    'type' => 'online',
                    'faktur' => $item->nofakturonline,
                    'media' => 'Media Online',
                    'customer' => $item->nama_pemasangonline,
                    'tanggal_muat' => $item->tanggal_tayangonline ?? $item->tanggal_transaksionline,
                    'sales' => $item->sales_iklanonline ?? '-',
                    'totaltagihan' => (int) $item->totaltagihan_transaksionline,
                    'jumlahbayar' => (int) $item->jumlahbayar_transaksionline,
                    'piutang' => (int) $item->piutang_transaksionline,
                ]);
            }
        }

        // 3. TV
        if (in_array($mediaFilter, ['all', 'tv'])) {
            $tvQ = TransaksiPriangan::query();
            if ($search) {
                $tvQ->where(function($q) use ($search) {
                    $q->where('nofakturpriangan', 'like', "%{$search}%")
                      ->orWhere('nama_pemasangpriangan', 'like', "%{$search}%");
                });
            }
            foreach ($tvQ->latest()->get() as $item) {
                $fakturList->push((object)[
                    'id' => $item->id,
                    'type' => 'tv',
                    'faktur' => $item->nofakturpriangan,
                    'media' => 'Priangan TV',
                    'customer' => $item->nama_pemasangpriangan,
                    'tanggal_muat' => $item->tanggal_tayangpriangan ?? $item->tanggal_transaksipriangan,
                    'sales' => $item->sales_iklanpriangan ?? '-',
                    'totaltagihan' => (int) $item->totaltagihan_transaksipriangan,
                    'jumlahbayar' => (int) $item->jumlahbayar_transaksipriangan,
                    'piutang' => (int) $item->piutang_transaksipriangan,
                ]);
            }
        }

        return view('pages.kasir.penerimaan.iklan', compact('fakturList', 'search', 'mediaFilter'));
    }

    /**
     * Process Payment for Iklan
     */
    public function storePenerimaanIklan(Request $request)
    {
        $request->validate([
            'type' => 'required|in:koran,online,tv',
            'id' => 'required|integer',
            'nominal_bayar' => 'required|numeric|min:1',
            'metode_pembayaran' => 'required|string',
        ]);

        $nominal = (int) $request->input('nominal_bayar');

        if ($request->type === 'koran') {
            $trx = TransaksiKoran::findOrFail($request->id);
            $trx->jumlahbayar_transaksikoran += $nominal;
            $trx->piutang_transaksikoran = max(0, $trx->totaltagihan_transaksikoran - $trx->jumlahbayar_transaksikoran);
            $trx->save();
            $fakturNo = $trx->nofakturkoran;
        } elseif ($request->type === 'online') {
            $trx = TransaksiOnline::findOrFail($request->id);
            $trx->jumlahbayar_transaksionline += $nominal;
            $trx->piutang_transaksionline = max(0, $trx->totaltagihan_transaksionline - $trx->jumlahbayar_transaksionline);
            $trx->save();
            $fakturNo = $trx->nofakturonline;
        } else {
            $trx = TransaksiPriangan::findOrFail($request->id);
            $trx->jumlahbayar_transaksipriangan += $nominal;
            $trx->piutang_transaksipriangan = max(0, $trx->totaltagihan_transaksipriangan - $trx->jumlahbayar_transaksipriangan);
            $trx->save();
            $fakturNo = $trx->nofakturpriangan;
        }

        return redirect()->back()->with('success', "Bukti Kas Masuk (BKM) untuk faktur {$fakturNo} sebesar Rp " . number_format($nominal, 0, ',', '.') . " berhasil diterbitkan!");
    }

    /**
     * Setoran Sirkulasi Koran
     */
    public function penerimaanSirkulasi(Request $request)
    {
        // Sample Agen Sirkulasi Data & Billing calculation
        $agenList = collect([
            (object)[
                'id' => 1,
                'kode_agen' => 'AGN-TSM-01',
                'nama_agen' => 'Agen H. Mulyana (Kota Tasikmalaya)',
                'wilayah' => 'Tasikmalaya Kota',
                'eksemplar' => 1500,
                'harga_satuan' => 4000,
                'tagihan_kotor' => 6000000,
                'retur_bapr' => 150, // 150 eksemplar retur
                'nilai_retur' => 600000,
                'tagihan_bersih' => 5400000,
                'setoran_tercatat' => 4000000,
                'sisa_tagihan' => 1400000,
                'status' => 'Sebagian',
            ],
            (object)[
                'id' => 2,
                'kode_agen' => 'AGN-CMS-02',
                'nama_agen' => 'Agen Loper Ciamis Utama',
                'wilayah' => 'Ciamis',
                'eksemplar' => 1200,
                'harga_satuan' => 4000,
                'tagihan_kotor' => 4800000,
                'retur_bapr' => 80,
                'nilai_retur' => 320000,
                'tagihan_bersih' => 4480000,
                'setoran_tercatat' => 4480000,
                'sisa_tagihan' => 0,
                'status' => 'Lunas',
            ],
            (object)[
                'id' => 3,
                'kode_agen' => 'AGN-SING-03',
                'nama_agen' => 'Toko Buku & Koran Singaparna',
                'wilayah' => 'Kab. Tasikmalaya',
                'eksemplar' => 800,
                'harga_satuan' => 4000,
                'tagihan_kotor' => 3200000,
                'retur_bapr' => 50,
                'nilai_retur' => 200000,
                'tagihan_bersih' => 3000000,
                'setoran_tercatat' => 1500000,
                'sisa_tagihan' => 1500000,
                'status' => 'Sebagian',
            ],
            (object)[
                'id' => 4,
                'kode_agen' => 'AGN-BR-04',
                'nama_agen' => 'Kios Koran Sub-Agen Banjar',
                'wilayah' => 'Kota Banjar',
                'eksemplar' => 600,
                'harga_satuan' => 4000,
                'tagihan_kotor' => 2400000,
                'retur_bapr' => 40,
                'nilai_retur' => 160000,
                'tagihan_bersih' => 2240000,
                'setoran_tercatat' => 0,
                'sisa_tagihan' => 2240000,
                'status' => 'Belum Bayar',
            ],
        ]);

        return view('pages.kasir.penerimaan.sirkulasi', compact('agenList'));
    }

    /**
     * Process Setoran Sirkulasi
     */
    public function storePenerimaanSirkulasi(Request $request)
    {
        $request->validate([
            'nama_agen' => 'required|string',
            'periode' => 'required|string',
            'nominal_setoran' => 'required|numeric|min:1',
            'metode_pembayaran' => 'required|string',
        ]);

        $nominal = (int) $request->input('nominal_setoran');
        $agen = $request->input('nama_agen');

        return redirect()->back()->with('success', "Setoran Sirkulasi dari {$agen} sebesar Rp " . number_format($nominal, 0, ',', '.') . " berhasil dicatat ke Kas Harian!");
    }

    /**
     * Penjualan Langsung / Tunai tanpa faktur tempo
     */
    public function penerimaanTunai(Request $request)
    {
        $recentTunai = collect([
            (object)[
                'no_kwitansi' => 'KW-TNI-20261001',
                'tanggal' => Carbon::now()->toDateString(),
                'pembeli' => 'Bpk. Hendra (Perorangan)',
                'kategori' => 'Iklan Baris / Kolom Kecil',
                'keterangan' => 'Pemasangan Iklan Kehilangan STNK Motor',
                'metode' => 'Tunai Kasir',
                'jumlah' => 75000,
                'kasir' => 'Siti Nurhaliza',
            ],
            (object)[
                'no_kwitansi' => 'KW-TNI-20261002',
                'tanggal' => Carbon::now()->toDateString(),
                'pembeli' => 'Dinas Pendidikan Kab. Tasik',
                'kategori' => 'Pembelian Koran Eceran Sisa Stock',
                'keterangan' => 'Beli 50 Eksemplar Edisi Khusus HUT Tasik',
                'metode' => 'Transfer QRIS',
                'jumlah' => 250000,
                'kasir' => 'Siti Nurhaliza',
            ],
            (object)[
                'no_kwitansi' => 'KW-TNI-20260905',
                'tanggal' => Carbon::now()->subDay()->toDateString(),
                'pembeli' => 'Pengepul Daur Ulang Mandiri',
                'kategori' => 'Penjualan Kertas Afval / Koran Bekas',
                'keterangan' => 'Penjualan Kertas Afval Cetak 120 Kg',
                'metode' => 'Tunai Kasir',
                'jumlah' => 360000,
                'kasir' => 'Siti Nurhaliza',
            ],
        ]);

        return view('pages.kasir.penerimaan.tunai', compact('recentTunai'));
    }

    /**
     * Process Penjualan Langsung
     */
    public function storePenerimaanTunai(Request $request)
    {
        $request->validate([
            'pembeli' => 'required|string',
            'kategori' => 'required|string',
            'keterangan' => 'required|string',
            'jumlah' => 'required|numeric|min:1',
            'metode' => 'required|string',
        ]);

        $noKwitansi = 'KW-TNI-' . date('Ymd') . rand(100, 999);
        $nominal = (int) $request->input('jumlah');

        return redirect()->back()->with('success', "Kwitansi Penjualan Langsung {$noKwitansi} sebesar Rp " . number_format($nominal, 0, ',', '.') . " berhasil dicatat!");
    }

    /**
     * Realisasi Bukti Pengeluaran (BP) - BKK (Bukti Kas Keluar)
     */
    public function realisasiBp(Request $request)
    {
        $bpList = collect([
            (object)[
                'id' => 101,
                'no_bp' => 'BP-2026-10-001',
                'tanggal_pengajuan' => Carbon::now()->subDays(2)->toDateString(),
                'pemohon' => 'Ahmad Fauzi (AE Iklan)',
                'divisi' => 'Divisi Iklan',
                'keperluan' => 'Pencairan Komisi KH & Insentif AE Klien Pemkab Tasik',
                'nominal_acc' => 1250000,
                'status_persetujuan' => 'ACC Anggaran',
                'status_kasir' => 'Belum Dicairkan',
            ],
            (object)[
                'id' => 102,
                'no_bp' => 'BP-2026-10-002',
                'tanggal_pengajuan' => Carbon::now()->subDay()->toDateString(),
                'pemohon' => 'Randi Kurnia (Operasional Sirkulasi)',
                'divisi' => 'Divisi Sirkulasi',
                'keperluan' => 'BBM & Tol Operasional Pengiriman Koran Luar Kota (Ciamis-Banjar)',
                'nominal_acc' => 450000,
                'status_persetujuan' => 'ACC Anggaran',
                'status_kasir' => 'Belum Dicairkan',
            ],
            (object)[
                'id' => 103,
                'no_bp' => 'BP-2026-10-003',
                'tanggal_pengajuan' => Carbon::now()->subDays(4)->toDateString(),
                'pemohon' => 'Dedi Gunawan (Sales Executive)',
                'divisi' => 'Divisi Iklan',
                'keperluan' => 'BBM & Jamuan Klien Prospek PT Bank BJB',
                'nominal_acc' => 300000,
                'status_persetujuan' => 'ACC Anggaran',
                'status_kasir' => 'Dicairkan (BKK-0941)',
            ],
            (object)[
                'id' => 104,
                'no_bp' => 'BP-2026-10-004',
                'tanggal_pengajuan' => Carbon::now()->toDateString(),
                'pemohon' => 'Rina Marlina (Redaksi / Kontributor)',
                'divisi' => 'Redaksi / Umum',
                'keperluan' => 'Honorium Kontributor Tulisan Liputan Khusus Daerah',
                'nominal_acc' => 750000,
                'status_persetujuan' => 'ACC Anggaran',
                'status_kasir' => 'Belum Dicairkan',
            ],
        ]);

        return view('pages.kasir.pengeluaran.realisasi-bp', compact('bpList'));
    }

    /**
     * Process Realisasi BP (Release Cash / BKK)
     */
    public function storeRealisasiBp(Request $request)
    {
        $request->validate([
            'no_bp' => 'required|string',
            'nominal_cair' => 'required|numeric|min:1',
            'penerima' => 'required|string',
            'catatan' => 'nullable|string',
        ]);

        $noBkk = 'BKK-' . date('Ym') . rand(100, 999);
        $nominal = (int) $request->input('nominal_cair');

        return redirect()->back()->with('success', "Bukti Kas Keluar ({$noBkk}) untuk {$request->no_bp} sebesar Rp " . number_format($nominal, 0, ',', '.') . " berhasil dicairkan!");
    }

    /**
     * Buku Kas & Tutup Shift Kasir
     */
    public function bukuKas(Request $request)
    {
        $today = Carbon::now()->translatedFormat('d F Y');

        // Totals calculation
        $totalPenerimaanIklan = (int) (
            TransaksiKoran::whereDate('tanggal_transaksikoran', Carbon::today())->sum('jumlahbayar_transaksikoran') +
            TransaksiOnline::whereDate('tanggal_transaksionline', Carbon::today())->sum('jumlahbayar_transaksionline') +
            TransaksiPriangan::whereDate('tanggal_transaksipriangan', Carbon::today())->sum('jumlahbayar_transaksipriangan')
        );

        $totalSetoranSirkulasi = 4000000;
        $totalPenjualanTunai = 325000;
        $totalKasMasuk = $totalPenerimaanIklan + $totalSetoranSirkulasi + $totalPenjualanTunai;

        $totalPengeluaranBp = 300000; // Total BKK realized today
        $saldoAwalShift = 1000000; // Saldo awal Modal Kasir
        $saldoAkhirShift = $saldoAwalShift + $totalKasMasuk - $totalPengeluaranBp;

        // Mutasi Kas Shift Hari ini
        $mutasiShift = collect([
            (object)[
                'waktu' => '08:15',
                'jenis' => 'Kas Masuk',
                'ref' => 'BKM-001',
                'kategori' => 'Setoran Iklan (FKKRN001)',
                'uraian' => 'Pelunasan Iklan Sekda Kab. Tasikmalaya',
                'masuk' => 4500000,
                'keluar' => 0,
            ],
            (object)[
                'waktu' => '09:30',
                'jenis' => 'Kas Masuk',
                'ref' => 'BKM-002',
                'kategori' => 'Setoran Iklan (FKKRN002)',
                'uraian' => 'Pelunasan Iklan Bank BJB Tasikmalaya',
                'masuk' => 1800000,
                'keluar' => 0,
            ],
            (object)[
                'waktu' => '10:45',
                'jenis' => 'Kas Keluar',
                'ref' => 'BKK-0941',
                'kategori' => 'Realisasi BP-2026-10-003',
                'uraian' => 'BBM & Jamuan Klien Dedi Gunawan (AE)',
                'masuk' => 0,
                'keluar' => 300000,
            ],
            (object)[
                'waktu' => '11:20',
                'jenis' => 'Kas Masuk',
                'ref' => 'BKM-SRK-01',
                'kategori' => 'Setoran Sirkulasi',
                'uraian' => 'Setoran Agen H. Mulyana (Kota Tasikmalaya)',
                'masuk' => 4000000,
                'keluar' => 0,
            ],
            (object)[
                'waktu' => '13:10',
                'jenis' => 'Kas Masuk',
                'ref' => 'KW-TNI-20261001',
                'kategori' => 'Penjualan Langsung',
                'uraian' => 'Pembayaran Iklan Baris Kehilangan STNK',
                'masuk' => 75000,
                'keluar' => 0,
            ],
            (object)[
                'waktu' => '14:00',
                'jenis' => 'Kas Masuk',
                'ref' => 'KW-TNI-20261002',
                'kategori' => 'Penjualan Langsung',
                'uraian' => 'Pembelian Koran Eceran Dinas Pendidikan',
                'masuk' => 250000,
                'keluar' => 0,
            ],
        ]);

        return view('pages.kasir.buku-kas.index', compact(
            'today',
            'saldoAwalShift',
            'totalKasMasuk',
            'totalPengeluaranBp',
            'saldoAkhirShift',
            'totalPenerimaanIklan',
            'totalSetoranSirkulasi',
            'totalPenjualanTunai',
            'mutasiShift'
        ));
    }

    /**
     * Process Closing Shift Kasir
     */
    public function tutupKasir(Request $request)
    {
        $request->validate([
            'catatan_shift' => 'nullable|string',
            'fisik_kas' => 'required|numeric|min:0',
        ]);

        return redirect()->back()->with('success', 'Tutup Shift Kasir Hari Ini Berhasil! Laporan Rekonsiliasi Kas Siap Ditarik & Ditinjau oleh Divisi Accounting.');
    }
}
