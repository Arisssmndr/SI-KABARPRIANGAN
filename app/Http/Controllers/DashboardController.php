<?php

namespace App\Http\Controllers;

use App\Models\TransaksiKoran;
use App\Models\TransaksiOnline;
use App\Models\TransaksiPriangan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $now = Carbon::now();
        $startOfMonth = $now->copy()->startOfMonth()->toDateString();
        $endOfMonth = $now->copy()->endOfMonth()->toDateString();
        $today = $now->toDateString();

        // 1. Data Iklan Koran
        $omzetKoran = TransaksiKoran::whereBetween('tanggal_transaksikoran', [$startOfMonth, $endOfMonth])
            ->sum('totaltagihan_transaksikoran');
        $piutangKoran = TransaksiKoran::sum('piutang_transaksikoran');
        $countKoran = TransaksiKoran::count();
        $todayKoran = TransaksiKoran::whereDate('tanggal_transaksikoran', $today)->count();

        // 2. Data Iklan Online
        $omzetOnline = TransaksiOnline::whereBetween('tanggal_transaksionline', [$startOfMonth, $endOfMonth])
            ->sum('totaltagihan_transaksionline');
        $piutangOnline = TransaksiOnline::sum('piutang_transaksionline');
        $countOnline = TransaksiOnline::count();
        $todayOnline = TransaksiOnline::whereDate('tanggal_transaksionline', $today)->count();

        // 3. Data Iklan TV (Priangan TV)
        $omzetTv = TransaksiPriangan::whereBetween('tanggal_transaksipriangan', [$startOfMonth, $endOfMonth])
            ->sum('totaltagihan_transaksipriangan');
        $piutangTv = TransaksiPriangan::sum('piutang_transaksipriangan');
        $countTv = TransaksiPriangan::count();
        $todayTv = TransaksiPriangan::whereDate('tanggal_transaksipriangan', $today)->count();

        // Total Gabungan
        $totalOmzetBulanIni = $omzetKoran + $omzetOnline + $omzetTv;
        $totalPiutang = $piutangKoran + $piutangOnline + $piutangTv;
        $totalTransaksi = $countKoran + $countOnline + $countTv;
        $totalHariIni = $todayKoran + $todayOnline + $todayTv;

        // 5 Transaksi Terbaru Masing-Masing
        $recentKoran = TransaksiKoran::with('iklankoran')->latest('id')->take(3)->get();
        $recentOnline = TransaksiOnline::with('iklanonline')->latest('id')->take(3)->get();
        $recentTv = TransaksiPriangan::with('iklanpriangan')->latest('id')->take(3)->get();

        return view('dashboard', compact(
            'totalOmzetBulanIni',
            'totalPiutang',
            'totalTransaksi',
            'totalHariIni',
            'omzetKoran',
            'omzetOnline',
            'omzetTv',
            'countKoran',
            'countOnline',
            'countTv',
            'recentKoran',
            'recentOnline',
            'recentTv'
        ));
    }
}
