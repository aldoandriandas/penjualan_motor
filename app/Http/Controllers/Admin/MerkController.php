<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Merk;
use Illuminate\Http\Request;

class MerkController extends Controller
{
    public function index()
    {
        $merks = Merk::all();
        return view('admin.merk.index', compact('merks'));
    }

    public function create()
    {
        return view('admin.merk.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_merk' => 'required'
        ]);

        Merk::create([
            'nama_merk' => $request->nama_merk
        ]);

        return redirect()->route('admin.merk.index')
            ->with('success', 'Merk berhasil ditambahkan');
    }

    public function edit($id)
    {
        $merk = Merk::findOrFail($id);
        return view('admin.merk.edit', compact('merk'));
    }

    public function update(Request $request, $id)
    {
        $merk = Merk::findOrFail($id);

        $merk->update([
            'nama_merk' => $request->nama_merk
        ]);

        return redirect()->route('admin.merk.index')
            ->with('success', 'Merk berhasil diupdate');
    }

    public function destroy($id)
    {
        Merk::findOrFail($id)->delete();

        return redirect()->route('admin.merk.index')
            ->with('success', 'Merk berhasil dihapus');
    }
}
