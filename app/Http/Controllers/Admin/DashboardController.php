<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CashIn;
use App\Models\CashOut;
use App\Models\Motor;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // 🔐 Role check
        if (!in_array(Auth::user()->role, ['admin', 'super_admin'])) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        $user = Auth::user();
        $title = "Dashboard";

        // =========================
        // 🔥 BASE QUERY
        // =========================
        $cashInQuery      = CashIn::query();
        $cashOutQuery     = CashOut::query();
        $transactionQuery = Transaction::whereRaw("LOWER(TRIM(status)) = 'selesai'");

        // 🔐 FILTER DEALER
        if ($user->role === 'admin') {
            $cashInQuery->where('dealer_id', $user->dealer_id);
            $cashOutQuery->where('dealer_id', $user->dealer_id);
            $transactionQuery->where('dealer_id', $user->dealer_id);
        }

        // =========================
        // 💰 TOTAL MASUK (GABUNG)
        // =========================

        // 🔥 MANUAL (exclude transaksi)
        $manualMasuk = (clone $cashInQuery)
            ->where('description', 'NOT LIKE', 'Penjualan Motor%')
            ->sum('amount');

        // 🔥 TRANSAKSI
        $transaksiMasuk = (clone $transactionQuery)
            ->sum('total_price');

        // 🔥 TOTAL MASUK
        $totalMasuk = $manualMasuk + $transaksiMasuk;

        // =========================
        // 💸 TOTAL KELUAR
        // =========================
        $totalKeluar = (clone $cashOutQuery)->sum('amount');

        // =========================
        // 💰 SALDO
        // =========================
        $saldo = $totalMasuk - $totalKeluar;

        // =========================
        // 💰 PENDAPATAN (GABUNG)
        // =========================

        // 🔥 TAHUNAN
        $pendapatanTahunan =
            (clone $cashInQuery)
                ->where('description', 'NOT LIKE', 'Penjualan Motor%')
                ->whereYear('created_at', now()->year)
                ->sum('amount')
            +
            (clone $transactionQuery)
                ->whereYear('created_at', now()->year)
                ->sum('total_price');

        // 🔥 BULANAN
        $pendapatanBulanan =
            (clone $cashInQuery)
                ->where('description', 'NOT LIKE', 'Penjualan Motor%')
                ->whereYear('created_at', now()->year)
                ->whereMonth('created_at', now()->month)
                ->sum('amount')
            +
            (clone $transactionQuery)
                ->whereYear('created_at', now()->year)
                ->whereMonth('created_at', now()->month)
                ->sum('total_price');

        // 🔥 HARIAN
        $pendapatanHarian =
            (clone $cashInQuery)
                ->where('description', 'NOT LIKE', 'Penjualan Motor%')
                ->whereDate('created_at', now()->toDateString())
                ->sum('amount')
            +
            (clone $transactionQuery)
                ->whereDate('created_at', now()->toDateString())
                ->sum('total_price');

        // =========================
        // 👤 USER
        // =========================
        $totalAdmin = User::where('role', 'admin')->count();
        $totalUser  = User::where('role', 'user')->count();

        // =========================
        // 📦 STOCK
        // =========================
        $totalStockMotor = $user->role === 'admin'
            ? Motor::where('dealer_id', $user->dealer_id)->sum('stock')
            : Motor::sum('stock');

        return view('admin.dashboard', compact(
            'title',
            'totalMasuk',
            'totalKeluar',
            'saldo',
            'pendapatanTahunan',
            'pendapatanBulanan',
            'pendapatanHarian',
            'totalAdmin',
            'totalUser',
            'totalStockMotor'
        ));
    }
}