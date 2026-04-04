<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dealer;
use App\Models\Merk;
use App\Models\ModelMotor;
use App\Models\Motor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MotorController extends Controller
{
    // 🔐 BLOCK SUPER ADMIN (NO CRUD)
    private function blockSuperAdmin()
    {
        if (Auth::check() && Auth::user()->role === 'super_admin') {
            abort(403, 'Super Admin hanya bisa melihat data');
        }
    }

    // 📄 INDEX
    public function index(Request $request)
{
    $query = Motor::query();

    // 🔹 FILTER
    if ($request->merk_id) {
        $query->where('merk_id', $request->merk_id);
    }

    if ($request->model_id) {
        $query->where('model_id', $request->model_id);
    }

    if ($request->tahun) {
        $query->where('tahun', $request->tahun);
    }

    // 🔥 FILTER HARGA (MIN & MAX)
    if ($request->harga_min && $request->harga_max) {
        $query->whereBetween('harga', [$request->harga_min, $request->harga_max]);
    } elseif ($request->harga_min) {
        $query->where('harga', '>=', $request->harga_min);
    } elseif ($request->harga_max) {
        $query->where('harga', '<=', $request->harga_max);
    }

    // 🔹 FILTER TAMBAHAN
    if ($request->jarak_tempuh) {
        $query->where('jarak_tempuh', '<=', $request->jarak_tempuh);
    }

    if ($request->kondisi) {
        $query->where('kondisi', $request->kondisi);
    }

    if ($request->warna) {
        $query->where('warna', $request->warna);
    }

    // 🔐 KHUSUS ADMIN
    if (Auth::check() && Auth::user()->role === 'admin') {
        $query->where('dealer_id', Auth::user()->dealer_id);
    }

    $motors = $query->latest()->get();

    // 🔥 AMBIL YEAR DARI TABEL MOTORS
    $years = Motor::select('tahun')
        ->distinct()
        ->orderBy('tahun', 'desc')
        ->pluck('tahun');

    $merks  = Merk::all();
    $models = ModelMotor::all();

    return view(
        Auth::check() && in_array(Auth::user()->role, ['admin', 'super_admin'])
            ? 'admin.motor.index'
            : 'home',
        compact('motors', 'merks', 'models', 'years')
    );
}

    // ➕ CREATE
    public function create()
    {
        $this->blockSuperAdmin();

        return view('admin.motor.create', [
            'merks' => Merk::all(),
            'models' => ModelMotor::all(),
            'dealers' => Dealer::all()
        ]);
    }

    // 💾 STORE
    public function store(Request $request)
    {
        $this->blockSuperAdmin();

        $data = $request->validate([
            'merk_id' => 'required',
            'model_id' => 'required',
            'dealer_id' => 'required',
            'tahun' => 'required',
            'harga' => 'required|numeric',
            'jarak_tempuh' => 'required|numeric',
            'kondisi' => 'required',
            'warna' => 'required',
            'deskripsi' => 'nullable',
            'stock' => 'required|numeric|min:0',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'gambar2' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'gambar3' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data['user_id'] = Auth::id();

        foreach (['gambar','gambar2','gambar3'] as $field) {
            if ($request->hasFile($field)) {
                $data[$field] = $request->file($field)->store('motor', 'public');
            }
        }

        Motor::create($data);

        return redirect()->route('admin.motor.index')->with('success','Motor berhasil ditambahkan');
    }

    // ✏️ EDIT
    public function edit($id)
    {
        $this->blockSuperAdmin();

        $motor = Motor::findOrFail($id);
        return view('admin.motor.edit', [
            'motor' => $motor,
            'merks' => Merk::all(),
            'models' => ModelMotor::all(),
            'dealers' => Dealer::all()
        ]);
    }

    // 🔄 UPDATE
    public function update(Request $request, $id)
    {
        $this->blockSuperAdmin();

        $motor = Motor::findOrFail($id);

        $data = $request->validate([
            'merk_id' => 'required',
            'model_id' => 'required',
            'dealer_id' => 'required',
            'tahun' => 'required',
            'harga' => 'required|numeric',
            'jarak_tempuh' => 'required|numeric',
            'kondisi' => 'required',
            'warna' => 'required',
            'deskripsi' => 'nullable',
            'stock' => 'required|numeric|min:0',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'gambar2' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'gambar3' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        foreach (['gambar','gambar2','gambar3'] as $field) {
            if ($request->hasFile($field)) {
                if ($motor->$field && Storage::disk('public')->exists($motor->$field)) {
                    Storage::disk('public')->delete($motor->$field);
                }
                $data[$field] = $request->file($field)->store('motor','public');
            }
        }

        $motor->update($data);

        return redirect()->route('admin.motor.index')->with('success','Motor berhasil diupdate');
    }

    // 🗑️ DELETE
    public function destroy($id)
    {
        $this->blockSuperAdmin();

        $motor = Motor::findOrFail($id);

        foreach (['gambar','gambar2','gambar3'] as $field) {
            if ($motor->$field && Storage::disk('public')->exists($motor->$field)) {
                Storage::disk('public')->delete($motor->$field);
            }
        }

        $motor->delete();

        return redirect()->route('admin.motor.index')->with('success','Motor berhasil dihapus');
    }

    // 👁️ SHOW
    public function show($id)
    {
        $motor = Motor::with('merk','model','dealer')->findOrFail($id);

        $transaction = \App\Models\Transaction::where('motor_id',$motor->id)->latest()->first();
        $invoice = $transaction ? $transaction->invoice : null;

        $otherMotors = Motor::where('id','!=',$motor->id)->inRandomOrder()->take(6)->get();

        return view('show', compact('motor','otherMotors','transaction','invoice'));
    }
    public function searchs(Request $request)
{
    $query = Motor::query();

    // 🔹 FILTER MERK
    if ($request->merk) {
        $query->where('merk_id', $request->merk);
    }

    // 🔹 FILTER MODEL
    if ($request->model) {
        $query->where('model_id', $request->model);
    }

    // 🔹 FILTER TAHUN
    if ($request->tahun) {
        $query->where('tahun', $request->tahun);
    }

    // 🔥 FILTER PRICE RANGE (sesuai select kamu)
    if ($request->price_range) {
        switch ($request->price_range) {
            case 'under_10':
                $query->where('harga', '<', 10000000);
                break;

            case '10_20':
                $query->whereBetween('harga', [10000000, 20000000]);
                break;

            case '20_30':
                $query->whereBetween('harga', [20000000, 30000000]);
                break;

            case 'above_30':
                $query->where('harga', '>', 30000000);
                break;
        }
    }

    // 🔐 kalau admin
    if (Auth::check() && Auth::user()->role === 'admin') {
        $query->where('dealer_id', Auth::user()->dealer_id);
    }

    // 🔥 ambil data motor
    $motors = $query->with('merk','model','dealer')->latest()->get();

    // 🔥 ambil YEAR dari tabel motors
    $years = Motor::select('tahun')
        ->distinct()
        ->orderBy('tahun', 'desc')
        ->pluck('tahun');

    $merks  = Merk::all();
    $models = ModelMotor::all();

    return view('produk', compact('motors','merks','models','years'));
}
}