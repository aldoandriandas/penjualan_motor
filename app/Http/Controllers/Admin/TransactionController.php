<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dealer;
use App\Models\Merk;
use App\Models\ModelMotor;
use App\Models\Motor;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    // Semua role bisa lihat transaksi
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

    // Hanya admin bisa membuat transaksi
public function create()
{
    $this->authorizeAdmin();

    $merks = Merk::all();
    $models = ModelMotor::all();

    // 🔥 GABUNGKAN: hanya ambil motor yang stok > 0
    $motors = Motor::with(['model', 'merk'])
        ->where('stock', '>', 0)
        ->get();

    // Dealer hanya sesuai admin login
    $dealers = Dealer::where('id', Auth::user()->dealer_id)->get();

    return view('admin.transaction.create', compact('merks', 'models', 'motors', 'dealers'));
}

public function store(Request $request)
{
    $this->authorizeAdmin();

    $request->validate([
        'motor_id' => 'required|exists:motors,id',
        'dealer_id' => 'required|exists:dealers,id',
        'payment_method' => 'required|in:transfer,cash'
    ]);

    if ($request->dealer_id != Auth::user()->dealer_id) {
        abort(403, 'Dealer tidak sesuai dengan admin yang login.');
    }

    $motor = Motor::findOrFail($request->motor_id);

    // 🔥 CEK STOCK
    if ($motor->stock <= 0) {
        return back()->with('error', 'Stock motor habis!');
    }

    // 🔥 KURANGI STOCK
    $motor->decrement('stock');

    // 🔥 SIMPAN TRANSAKSI
    Transaction::create([
        'motor_id' => $motor->id,
        'user_id' => Auth::id(),
        'dealer_id' => $request->dealer_id,
        'invoice' => 'INV-' . strtoupper(Str::random(8)),
        'total_price' => $motor->harga,
        'status' => 'pending',
        'payment_method' => $request->payment_method
    ]);

    return redirect()->route('admin.transaction.index')
        ->with('success', 'Transaksi berhasil dibuat');
}

    // Hanya admin bisa update status
    public function updateStatus(Request $request, $id)
    {
        $this->authorizeAdmin();

        $request->validate(['status' => 'required']);

        $transaction = Transaction::findOrFail($id);
        $transaction->update(['status' => $request->status]);

        return redirect()->route('admin.transaction.index')
            ->with('success', 'Status transaksi berhasil diupdate');
    }

public function destroy($id)
{
    $this->authorizeAdmin();

    $transaction = Transaction::with('motor')->findOrFail($id);

    // 🔥 KEMBALIKAN STOCK
    if ($transaction->motor) {
        $transaction->motor->increment('stock');
    }

    // 🔥 HAPUS TRANSAKSI
    $transaction->delete();

    return back()->with('success', 'Transaksi dihapus & stok dikembalikan');
}

    // Fungsi private untuk cek role admin
    private function authorizeAdmin()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }
    }
}