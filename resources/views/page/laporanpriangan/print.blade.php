<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi Priangan TV</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: #FAFAFA;
            font: 9pt "Tahoma";
        }

        * {
            box-sizing: border-box;
        }

        .page {
            width: 297mm;
            min-height: 210mm;
            padding: 10mm;
            margin: 10mm auto;
            border: 1px #D3D3D3 solid;
            background: white;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 8pt;
        }

        th,
        td {
            border: 1px solid black;
            padding: 4px;
            vertical-align: middle;
        }

        th {
            background-color: #f0f0f0;
            text-align: center;
            font-weight: bold;
        }

        .tengah {
            text-align: center;
        }

        .kanan {
            text-align: right;
        }

        /* HEADER STYLE (Disamakan dengan Online) */
        .header-container {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            border-bottom: 3px double #333;
            padding-bottom: 15px;
        }

        .logo-wrapper img {
            height: 70px;
            width: auto;
            margin-right: 20px;
        }

        .header-text {
            text-align: left;
            color: #333;
        }

        .header-text h1 {
            font-size: 18pt;
            font-weight: bold;
            margin: 0;
            text-transform: uppercase;
        }

        .header-text p {
            margin: 2px 0;
            font-size: 10pt;
            font-weight: bold;
        }

        @media print {

            html,
            body {
                width: 297mm;
                height: 210mm;
                background-color: white;
            }

            .page {
                margin: 0;
                border: none;
                box-shadow: none;
                padding: 5mm;
            }
        }
    </style>
</head>

<body>
    <div class="book">
        <div class="page">

            {{-- HEADER LAPORAN --}}
            <div class="header-container">
                <div class="logo-wrapper">
                    {{-- Pastikan file logo ada di public/images/logo.png --}}
                    <img src="{{ asset('images/faviconremove.png') }}" alt="Logo Priangan TV">
                </div>
                <div class="header-text">
                    <h1>PRIANGAN TV</h1>
                    <p>Jl. Dr. Soekarjo Nomor 70 Kelurahan Tawangsari</p>
                    <p>Kecamatan Tawang Kota Tasikmalaya Jawa Barat (HU.
                        Kabar Priangan)</p>
                    <p>Telp: 082260030311 | Email: priangantv2024@gmail.com</p>
                    <p style="font-size: 9pt; font-weight: normal;">Dicetak pada: {{ date('d-m-Y H:i') }}</p>
                </div>
            </div>

            {{-- TABEL DATA --}}
            <div>
                <table>
                    <thead>
                        <tr>
                            <th style="width: 30px;">NO</th>
                            <th>NO FAKTUR</th>
                            <th>TANGGAL TRANSAKSI</th>
                            <th>NAMA PEMASANG</th>
                            <th>JENIS IKLAN</th>
                            <th>TANGGAL MUAT</th>
                            {{-- KOLOM PERHITUNGAN --}}
                            <th>NILAI</th>
                            <th>PPN 11%</th>
                            <th>DPP</th>
                            <th>KOMISI (20%)</th>
                            <th>INSENTIF (20%)</th>
                            <th>PEROLEHAN</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                            // Variabel Grand Total
                            $grand_nilai = 0;
                            $grand_ppn = 0;
                            $grand_dpp = 0;
                            $grand_komisi = 0;
                            $grand_insentif = 0;
                        @endphp

                        @foreach ($data as $t)
                            @php
                                // --- LOGIKA PERHITUNGAN (Disamakan dengan Online) ---

                                // 1. NILAI (Total Tagihan dari Database Priangan)
                                $nilai = $t->harga_transaksipriangan;

                                // 2. DPP (Back Calculation / Tax Inclusive)
                                // Rumus: Nilai / 1.11
                                $dpp = $nilai / 1.11;

                                // 3. PPN
                                // Rumus: Nilai - DPP
                                $ppn = $nilai - $dpp;

                                // 4. KOMISI (20% dari DPP)
                                $komisi = $dpp * 0.2;

                                // 5. INSENTIF (20% dari Sisa DPP setelah dikurangi Komisi)
                                $sisa_untuk_insentif = $dpp - $komisi;
                                $insentif = $sisa_untuk_insentif * 0.2;

                                // --- Akumulasi Grand Total ---
                                $grand_nilai += $nilai;
                                $grand_ppn += $ppn;
                                $grand_dpp += $dpp;
                                $grand_komisi += $komisi;
                                $grand_insentif += $insentif;
                            @endphp

                            <tr>
                                <td class="tengah">{{ $no++ }}</td>
                                <TD>{{ $t->nofakturpriangan }}</TD>
                                <td class="tengah">
                                    {{ \Carbon\Carbon::parse($t->tanggal_transaksipriangan)->format('d/m/Y') }}</td>
                                <td>{{ $t->nama_pemasangpriangan }}</td>
                                <td class="tengah">{{ $t->iklanpriangan->jenis_iklanpriangan }}</td>
                                <td class="tengah">
                                    {{ \Carbon\Carbon::parse($t->tanggal_muatiklanpriangan)->format('d/m/Y') }}</td>
                                {{-- NILAI --}}
                                <td class="kanan">Rp {{ number_format($nilai, 0, ',', '.') }}</td>

                                {{-- PPN --}}
                                <td class="kanan">Rp {{ number_format($ppn, 0, ',', '.') }}</td>

                                {{-- DPP --}}
                                <td class="kanan" style="background-color: #fdfdfd; font-weight:bold;">
                                    Rp {{ number_format($dpp, 0, ',', '.') }}
                                </td>

                                {{-- KOMISI --}}
                                <td class="kanan">Rp {{ number_format($komisi, 0, ',', '.') }}</td>

                                {{-- INSENTIF --}}
                                <td class="kanan">Rp {{ number_format($insentif, 0, ',', '.') }}</td>

                                <td class="tengah">{{ $t->sales_iklanpriangan }}</td>
                            </tr>
                        @endforeach

                        {{-- FOOTER TOTAL --}}
                        <tr style="font-weight: bold; background-color: #f9f9f9;">
                            <td colspan="6" class="kanan">TOTAL KESELURUHAN</td>

                            <td class="kanan">Rp {{ number_format($grand_nilai, 0, ',', '.') }}</td>
                            <td class="kanan">Rp {{ number_format($grand_ppn, 0, ',', '.') }}</td>
                            <td class="kanan">Rp {{ number_format($grand_dpp, 0, ',', '.') }}</td>
                            <td class="kanan">Rp {{ number_format($grand_komisi, 0, ',', '.') }}</td>
                            <td class="kanan">Rp {{ number_format($grand_insentif, 0, ',', '.') }}</td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- BAGIAN TANGGAL (POSISI KIRI) -->
            <div style="margin-top: 25px; text-align: left; font-size: 9pt;">
                Tasikmalaya, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
            </div>

            <!-- BAGIAN TANDA TANGAN (3 KOLOM) -->
            <div style="width: 100%; margin-top: 15px;">
                <table style="width: 100%; border-collapse: collapse; border: none;">
                    <tr>
                        <!-- Admin Iklan (Kiri) -->
                        <td style="width: 33.33%; text-align: center; border: none; vertical-align: top;">
                            <p style="margin: 0; font-weight: bold;">Admin Iklan</p>
                            <div style="height: 60px;"></div>
                            <p style="margin: 0; font-weight: bold; text-decoration: underline;">Heni</p>
                        </td>

                        <!-- Manager Iklan (Tengah) -->
                        <td style="width: 33.33%; text-align: center; border: none; vertical-align: top;">
                            <p style="margin: 0; font-weight: bold;">Manager Iklan</p>
                            <div style="height: 60px;"></div>
                            <p style="margin: 0; font-weight: bold; text-decoration: underline;">Asep Liana</p>
                        </td>

                        <!-- Senior Manager Opr & Business (Kanan) -->
                        <td style="width: 33.33%; text-align: center; border: none; vertical-align: top;">
                            <p style="margin: 0; font-weight: bold;">Senior Manager Opr & Business</p>
                            <div style="height: 60px;"></div>
                            <p style="margin: 0; font-weight: bold; text-decoration: underline;">Helma Apriyanti</p>
                        </td>
                    </tr>
                </table>
            </div>

        </div>
    </div>

    <script>
        window.print();
    </script>
</body>

</html>