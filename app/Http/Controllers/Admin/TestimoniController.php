<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimoni;
use Illuminate\Http\Request;

class TestimoniController extends Controller
{
    public function index()
    {
        $testimonis = Testimoni::latest()->get();
        return view('admin.testimoni.index', compact('testimonis'));
    }

    public function create()
    {
        return view('admin.testimoni.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama'  => 'required',
            'email' => 'nullable|email',
            'pesan' => 'required'
        ]);

        Testimoni::create($data);

        return redirect()->route('admin.testimoni.index')
            ->with('success', 'Testimoni berhasil ditambahkan');
    }

    public function destroy($id)
    {
        Testimoni::findOrFail($id)->delete();

        return back()->with('success', 'Testimoni dihapus');
    }
}