<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dealer;
use App\Models\Merk;
use App\Models\ModelMotor;
use App\Models\Motor;
use App\Models\CashIn;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    // 🔍 Semua role bisa lihat transaksi
    public function index()
    {
        $transactions = Transaction::with([
            'motor.model',
            'motor.merk',
            'dealer',
            'user'
        ])->latest()->get();

        return view('admin.transaction.index', compact('transactions'));
    }

    public function show($id)
    {
        $transaction = Transaction::with([
            'motor.merk',
            'motor.model',
            'dealer',
            'user'
        ])->findOrFail($id);

        return view('admin.transaction.show', compact('transaction'));
    }

    // 🔐 Hanya admin
    public function create()
    {
        $this->authorizeAdmin();

        $merks = Merk::all();
        $models = ModelMotor::all();

        $motors = Motor::with(['model', 'merk'])
            ->where('stock', '>', 0)
            ->get();

        // Dealer sesuai user login
        $dealers = Dealer::where('id', Auth::user()->dealer_id)->get();

        return view('admin.transaction.create', compact('merks', 'models', 'motors', 'dealers'));
    }

    public function store(Request $request)
    {
        $this->authorizeAdmin();

        $request->validate([
            'motor_id' => 'required|exists:motors,id',
            'payment_method' => 'required|in:transfer,cash'
        ]);

        $motor = Motor::findOrFail($request->motor_id);

        // ❗ CEK STOCK
        if ($motor->stock <= 0) {
            return back()->with('error', 'Stock motor habis!');
        }

        // ❗ KURANGI STOCK
        $motor->decrement('stock');

        // ✅ SIMPAN TRANSAKSI (FIX dealer_id)
        Transaction::create([
            'motor_id' => $motor->id,
            'user_id' => Auth::id(),
            'dealer_id' => Auth::user()->dealer_id, // 🔥 FIX
            'invoice' => 'INV-' . strtoupper(Str::random(8)),
            'total_price' => $motor->harga,
            'status' => 'pending',
            'payment_method' => $request->payment_method
        ]);

        return redirect()->route('admin.transaction.index')
            ->with('success', 'Transaksi berhasil dibuat');
    }

    // 🔄 UPDATE STATUS
    public function updateStatus(Request $request, $id)
    {
        $this->authorizeAdmin();

        $request->validate([
            'status' => 'required'
        ]);

        $transaction = Transaction::findOrFail($id);

        // 🔥 NORMALISASI
        $status = strtolower(trim($request->status));

        $transaction->status = $status;
        $transaction->save();

        // =========================
        // 🔥 JIKA SELESAI
        // =========================
        if ($status === 'selesai') {

            CashIn::updateOrCreate(
                ['transaction_id' => $transaction->id], // 🔥 kunci utama
                [
                    'dealer_id'   => $transaction->dealer_id,
                    'amount'      => $transaction->total_price,
                    'description' => 'Penjualan Motor - ' . $transaction->invoice
                ]
            );
        }

        // =========================
        // ❌ JIKA DIBATALKAN
        // =========================
        if (in_array($status, ['pending', 'dibatalkan'])) {

    CashIn::where('transaction_id', $transaction->id)->delete();
}

        return back()->with('success', 'Status berhasil diupdate');
    }

    // ❌ HAPUS
    public function destroy($id)
    {
        $this->authorizeAdmin();

        $transaction = Transaction::with('motor')->findOrFail($id);

        // 🔄 BALIKIN STOCK
        if ($transaction->motor) {
            $transaction->motor->increment('stock');
        }

        $transaction->delete();

        return back()->with('success', 'Transaksi dihapus & stok dikembalikan');
    }

    // 🔐 CEK ROLE
    private function authorizeAdmin()
    {
        if (!in_array(Auth::user()->role, ['admin', 'super_admin'])) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }
    }
}
