<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CashIn;
use App\Models\CashOut;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CashInController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // =========================
        // 🔥 DATA PEMASUKAN
        // =========================
        $data = CashIn::where('dealer_id', $user->dealer_id)
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

        return view('admin.cash_in.index', compact(
            'data',
            'totalMasuk',
            'totalKeluar',
            'saldo'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'description' => 'required|string|max:255'
        ]);

        CashIn::create([
            'dealer_id' => Auth::user()->dealer_id,
            'amount' => $request->amount,
            'description' => $request->description,
            'transaction_id' => null // manual input
        ]);

        return back()->with('success', 'Pemasukan berhasil ditambahkan');
    }
}