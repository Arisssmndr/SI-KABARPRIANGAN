<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi Iklan Koran - Kabar Priangan</title>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', Arial, sans-serif;
            font-size: 11px;
            color: #1e293b;
            margin: 0;
            padding: 20px;
            background: #fff;
        }
        .page {
            width: 100%;
            max-width: 1100px;
            margin: 0 auto;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #0A72AC;
            padding-bottom: 12px;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 18px;
            color: #0A72AC;
            text-transform: uppercase;
            font-weight: 800;
        }
        .header h2 {
            margin: 4px 0;
            font-size: 14px;
            color: #1e293b;
        }
        .header p {
            margin: 2px 0;
            font-size: 11px;
            color: #64748b;
        }
        .report-meta {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            font-size: 11px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10px;
        }
        th, td {
            border: 1px solid #cbd5e1;
            padding: 6px 8px;
        }
        th {
            background-color: #f1f5f9;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 9px;
            text-align: center;
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; font-variant-numeric: tabular-nums; }
        .total-row td {
            font-weight: 800;
            background-color: #f8fafc;
            border-top: 2px solid #0A72AC;
        }
        .signature-section {
            display: flex;
            justify-content: flex-end;
            margin-top: 35px;
            text-align: center;
        }
        .signature-box {
            width: 220px;
            font-size: 11px;
        }
        .signature-line {
            border-bottom: 1px solid #333;
            margin-top: 55px;
            margin-bottom: 4px;
        }
        .no-print {
            margin-bottom: 15px;
            text-align: right;
        }
        .btn-print {
            background: #0A72AC;
            color: white;
            border: none;
            padding: 7px 16px;
            font-size: 11px;
            font-weight: 700;
            border-radius: 6px;
            cursor: pointer;
        }
        @media print {
            body { padding: 0; }
            .no-print { display: none; }
        }
    </style>
</head>
<body>
    <div class="page">
        <div class="no-print">
            <button class="btn-print" onclick="window.print()">Cetak Laporan</button>
        </div>

        <div class="header">
            <h1>Harian Umum Kabar Priangan</h1>
            <h2>Laporan Rekapitulasi Transaksi Iklan Koran</h2>
            <p>Jl. Dr. Soekardjo No. 70, Tasikmalaya · Jawa Barat · Telp: (0265) 335300</p>
        </div>

        <div class="report-meta">
            <div>
                <strong>Periode:</strong> 
                {{ $dari ? \Carbon\Carbon::parse($dari)->format('d/m/Y') : 'Awal' }} s/d {{ $sampai ? \Carbon\Carbon::parse($sampai)->format('d/m/Y') : 'Sekarang' }}
            </div>
            <div>
                <strong>Filter Status:</strong> {{ $status === 'all' || !$status ? 'Semua Status' : $status }}
            </div>
            <div>
                <strong>Dicetak:</strong> {{ date('d/m/Y H:i') }}
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th width="30">No</th>
                    <th>No Faktur</th>
                    <th>Tanggal</th>
                    <th>Pemasang</th>
                    <th>Sales</th>
                    <th>Kategori Iklan</th>
                    <th>Penempatan</th>
                    <th>Warna</th>
                    <th>Tgl Terbit</th>
                    <th>Qty</th>
                    <th>Total Tagihan</th>
                    <th>Dibayar</th>
                    <th>Piutang</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $sumTagihan = 0;
                    $sumBayar = 0;
                    $sumPiutang = 0;
                @endphp
                @forelse($data as $i => $row)
                    @php
                        $sumTagihan += $row->totaltagihan_transaksikoran;
                        $sumBayar += $row->jumlahbayar_transaksikoran;
                        $sumPiutang += $row->piutang_transaksikoran;
                    @endphp
                    <tr>
                        <td class="text-center">{{ $i + 1 }}</td>
                        <td><strong>{{ $row->nofakturkoran }}</strong></td>
                        <td class="text-center">{{ $row->tanggal_transaksikoran }}</td>
                        <td>{{ $row->nama_pemasangkoran }}</td>
                        <td>{{ $row->sales_iklankoran }}</td>
                        <td>{{ $row->iklankoran->jenis_iklankoran ?? '-' }}</td>
                        <td>{{ $row->halaman_iklan }}</td>
                        <td>{{ $row->warna_iklan }}</td>
                        <td class="text-center">{{ $row->tanggal_muatkoran }}</td>
                        <td class="text-center">{{ $row->total_muatkoran }}x</td>
                        <td class="text-right">Rp {{ number_format($row->totaltagihan_transaksikoran, 0, ',', '.') }}</td>
                        <td class="text-right">Rp {{ number_format($row->jumlahbayar_transaksikoran, 0, ',', '.') }}</td>
                        <td class="text-right" style="color: {{ $row->piutang_transaksikoran > 0 ? '#b91c1c' : 'inherit' }}; font-weight: {{ $row->piutang_transaksikoran > 0 ? 'bold' : 'normal' }};">
                            Rp {{ number_format($row->piutang_transaksikoran, 0, ',', '.') }}
                        </td>
                        <td class="text-center">
                            {{ $row->piutang_transaksikoran <= 0 ? 'LUNAS' : 'BELUM LUNAS' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="14" class="text-center" style="padding: 20px; color: #64748b;">
                            Tidak ada data transaksi iklan koran pada periode ini.
                        </td>
                    </tr>
                @endforelse
            </tbody>
            @if(count($data) > 0)
                <tfoot>
                    <tr class="total-row">
                        <td colspan="10" class="text-right">TOTAL KESELURUHAN:</td>
                        <td class="text-right">Rp {{ number_format($sumTagihan, 0, ',', '.') }}</td>
                        <td class="text-right" style="color: #166534;">Rp {{ number_format($sumBayar, 0, ',', '.') }}</td>
                        <td class="text-right" style="color: #b91c1c;">Rp {{ number_format($sumPiutang, 0, ',', '.') }}</td>
                        <td></td>
                    </tr>
                </tfoot>
            @endif
        </table>

        <div class="signature-section">
            <div class="signature-box">
                <p>Tasikmalaya, {{ date('d F Y') }}</p>
                <p>Bagian Kasir / Keuangan</p>
                <div class="signature-line"></div>
                <p><strong>{{ Auth::user()->name ?? 'Kasir Kabar Priangan' }}</strong></p>
            </div>
        </div>
    </div>
</body>
</html>
