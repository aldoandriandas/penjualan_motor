<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ModelMotor;
use App\Models\Merk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModelMotorController extends Controller
{
    // Tampilkan semua model (bisa diakses semua role)
    public function index()
    {
        $models = ModelMotor::with('merk')->get();
        return view('admin.model.index', compact('models'));
    }

    // Form tambah model (hanya admin)
    public function create()
    {
        $this->authorizeAdmin();

        $merks = Merk::all();
        return view('admin.model.create', compact('merks'));
    }

    // Simpan model baru (hanya admin)
    public function store(Request $request)
    {
        $this->authorizeAdmin();

        $request->validate([
            'merk_id' => 'required|exists:merks,id',
            'nama_model' => 'required|max:255',
        ]);

        ModelMotor::create([
            'merk_id' => $request->merk_id,
            'nama_model' => $request->nama_model,
        ]);

        return redirect()->route('admin.model.index')
            ->with('success', 'Model berhasil ditambahkan');
    }

    // Form edit model (hanya admin)
    public function edit($id)
    {
        $this->authorizeAdmin();

        $model = ModelMotor::findOrFail($id);
        $merks = Merk::all();

        return view('admin.model.edit', compact('model', 'merks'));
    }

    // Update model (hanya admin)
    public function update(Request $request, $id)
    {
        $this->authorizeAdmin();

        $request->validate([
            'merk_id' => 'required|exists:merks,id',
            'nama_model' => 'required|max:255',
        ]);

        $model = ModelMotor::findOrFail($id);
        $model->update([
            'merk_id' => $request->merk_id,
            'nama_model' => $request->nama_model
        ]);

        return redirect()->route('admin.model.index')
            ->with('success', 'Model berhasil diupdate');
    }

    // Hapus model (hanya admin)
    public function destroy($id)
    {
        $this->authorizeAdmin();

        $model = ModelMotor::findOrFail($id);

        if ($model->motors()->count() > 0) {
            return redirect()->route('admin.model.index')
                ->with('error', 'Model tidak bisa dihapus karena masih digunakan.');
        }

        $model->delete();

        return redirect()->route('admin.model.index')
            ->with('success', 'Model berhasil dihapus');
    }

    // Fungsi private untuk cek role admin
    private function authorizeAdmin()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }
    }
}