<?php

namespace App\Http\Controllers;

use App\Models\IklanPriangan;
use App\Models\TransaksiPriangan;
use Illuminate\Http\Request;

class TransaksiIklanPrianganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 1. Ambil Data Transaksi (Untuk Tabel)
        // Kita gunakan with() untuk mengambil nama jenis iklan dari relasi
        // latest() agar data terbaru muncul paling atas
        $transaksipriangan = TransaksiPriangan::with('iklanpriangan')
            ->latest()
            ->paginate(10);

        // 2. Ambil Data Master Iklan (Untuk Dropdown di Modal Edit)
        // Tanpa ini, dropdown di modal edit akan kosong/error
        $iklanpriangan = IklanPriangan::all();

        // 3. Kirim ke View
        return view('page.transaksipriangan.index', compact('transaksipriangan', 'iklanpriangan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $iklanpriangan = IklanPriangan::all();
        $nofakturpriangan = TransaksiPriangan::createCode();
        return view('page.transaksipriangan.create', compact('nofakturpriangan', 'iklanpriangan'));
    }

    public function cetak($id)
    {
        // 1. Ambil data transaksi berdasarkan ID
        // Gunakan 'with' untuk mengambil data relasi jenis iklan juga
        $transaksi = TransaksiPriangan::with('iklanpriangan')->findOrFail($id);

        // 2. Tampilkan view cetak
        // Pastikan path view sesuai dengan struktur folder Anda
        return view('page.transaksipriangan.cetak', compact('transaksi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nofakturpriangan' => 'required',
            'tanggal_transaksipriangan' => 'required',
            'nama_pemasangpriangan'   => 'required',
            'alamat_pemasangpriangan' => 'required',
            'id_iklanpriangan' => 'required', // Dropdown Kode Iklan
            'sales_iklanpriangan' => 'required', // Dropdown Kode Iklan
            'tanggal_muatiklanpriangan' => 'required|date',
            'harga_transaksipriangan' => 'required',
            'jumlahbayar_transaksipriangan' => 'required',
        ]);
        // 2. BERSIHKAN TITIK (Rupiah ke Integer)
        // Karena input harga sekarang manual "1.000.000", hapus titiknya.
        $harga_bersih   = (int) str_replace('.', '', $request->harga_transaksipriangan);
        $dibayar_bersih = (int) str_replace('.', '', $request->jumlahbayar_transaksipriangan);

        // Hitung Piutang di Server (Backup keamanan)
        $piutang_bersih = $harga_bersih - $dibayar_bersih;
        if ($piutang_bersih < 0) $piutang_bersih = 0;

        // 3. Simpan
        TransaksiPriangan::create([
            'nofakturpriangan'     => $request->nofakturpriangan,
            'tanggal_transaksipriangan' => $request->tanggal_transaksipriangan,
            'nama_pemasangpriangan'     => $request->nama_pemasangpriangan,
            'alamat_pemasangpriangan'   => $request->alamat_pemasangpriangan,
            'id_iklanpriangan'          => $request->id_iklanpriangan,
            'sales_iklanpriangan'          => $request->sales_iklanpriangan,
            'tanggal_muatiklanpriangan' => $request->tanggal_muatiklanpriangan,

            // Simpan Data Bersih
            'harga_transaksipriangan'       => $harga_bersih,
            'jumlahbayar_transaksipriangan' => $dibayar_bersih,
            'piutang_transaksipriangan'     => $piutang_bersih,
        ]);



        return redirect()->route('transaksipriangan.index')
            ->with('success', 'Transaksi Iklan Priangan created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        // 1. VALIDASI INPUT
        $request->validate([
            'tanggal_transaksipriangan'     => 'required|date',
            'nama_pemasangpriangan'         => 'required',
            'alamat_pemasangpriangan'       => 'required',
            'id_iklanpriangan'              => 'required', // Dropdown Jenis Iklan
            'sales_iklanpriangan'              => 'required',
            'tanggal_muatiklanpriangan'     => 'required|date',

            // Field uang ini string (karena ada format rupiahnya), jadi required saja
            'harga_transaksipriangan'       => 'required',
            'jumlahbayar_transaksipriangan' => 'required',
        ]);

        // 2. BERSIHKAN FORMAT RUPIAH (Hapus Titik)
        // Mengubah "1.500.000" menjadi 1500000 (Integer murni)
        $harga_bersih   = (int) str_replace('.', '', $request->harga_transaksipriangan);
        $bayar_bersih   = (int) str_replace('.', '', $request->jumlahbayar_transaksipriangan);

        // 3. HITUNG ULANG PIUTANG DI SERVER
        // Rumus: Harga - Jumlah Bayar
        $piutang_bersih = $harga_bersih - $bayar_bersih;

        // Pastikan tidak minus (kalau bayar lebih, piutang dianggap 0/lunas)
        if ($piutang_bersih < 0) $piutang_bersih = 0;

        // 4. CARI DATA DAN UPDATE
        // Pastikan Model sesuai dengan nama Model Anda
        $transaksi =TransaksiPriangan::findOrFail($id);

        $transaksi->update([
            // Note: No Faktur biasanya tidak diedit, jadi tidak dimasukkan.
            // Jika ingin bisa diedit, tambahkan: 'nofakturpriangan' => $request->nofakturpriangan,

            'tanggal_transaksipriangan'     => $request->tanggal_transaksipriangan,
            'nama_pemasangpriangan'         => $request->nama_pemasangpriangan,
            'alamat_pemasangpriangan'       => $request->alamat_pemasangpriangan,
            'id_iklanpriangan'              => $request->id_iklanpriangan,
            'sales_iklanpriangan'           => $request->sales_iklanpriangan,
            'tanggal_muatiklanpriangan'     => $request->tanggal_muatiklanpriangan,

            // Simpan angka yang sudah dibersihkan dan dihitung ulang
            'harga_transaksipriangan'       => $harga_bersih,
            'jumlahbayar_transaksipriangan' => $bayar_bersih,
            'piutang_transaksipriangan'     => $piutang_bersih,
        ]);

        // 5. REDIRECT KEMBALI KE INDEX
        return redirect()->route('transaksipriangan.index')
            ->with('success', 'Data Transaksi Berhasil Diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = TransaksiPriangan::findOrFail($id);
        $data->delete();
        return back()->with('message_delete', 'Data Paket Sudah di Hapus');
    }
}
