<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CashIn;
use App\Models\CashOut;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CashOutController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // =========================
        // 🔥 DATA PENGELUARAN
        // =========================
        $data = CashOut::where('dealer_id', $user->dealer_id)
            ->latest()
            ->get();

        // =========================
        // 💰 TOTAL MASUK
        // =========================
        $totalMasuk = CashIn::where('dealer_id', $user->dealer_id)
            ->sum('amount');

        // =========================
        // 💸 TOTAL KELUAR
        // =========================
        $totalKeluar = CashOut::where('dealer_id', $user->dealer_id)
            ->sum('amount');

        // =========================
        // 💰 SALDO
        // =========================
        $saldo = $totalMasuk - $totalKeluar;

        return view('admin.cash_out.index', compact(
            'data',
            'totalMasuk',
            'totalKeluar',
            'saldo'
        ));
    }

    public function store(Request $request)
    {
        // 🔥 VALIDASI (biar aman)
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'description' => 'required|string|max:255'
        ]);

        CashOut::create([
            'dealer_id' => Auth::user()->dealer_id,
            'amount' => $request->amount,
            'description' => $request->description
        ]);

        return back()->with('success', 'Pengeluaran ditambahkan');
    }
}