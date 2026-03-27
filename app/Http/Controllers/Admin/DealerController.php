<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dealer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DealerController extends Controller
{
    public function index()
    {
        $dealers = Dealer::all();
        return view('admin.dealer.index', compact('dealers'));
    }

    public function create()
    {
        return view('admin.dealer.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_dealer'   => 'required',
            'alamat_dealer' => 'required',
            'no_hp_dealer'  => 'required',
            'email_dealer'  => 'nullable|email',
            'logo_dealer'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $logo = null;

        if ($request->hasFile('logo_dealer')) {
            $logo = $request->file('logo_dealer')->store('dealer', 'public');
        }

        $dealer = Dealer::create([
            'nama_dealer'   => $request->nama_dealer,
            'alamat_dealer' => $request->alamat_dealer,
            'no_hp_dealer'  => $request->no_hp_dealer,
            'email_dealer'  => $request->email_dealer,
            'kota_dealer'   => $request->kota_dealer,
            'logo_dealer'   => $logo
        ]);

        return redirect()->route('admin.dealer.index')
            ->with('success', 'Dealer berhasil ditambahkan');
    }

    public function edit($id)
    {
        $dealer = Dealer::findOrFail($id);
        return view('admin.dealer.edit', compact('dealer'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_dealer' => 'required',
            'alamat_dealer' => 'required',
            'no_hp_dealer' => 'required',
            'email_dealer' => 'nullable|email',
            'logo_dealer' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $dealer = Dealer::findOrFail($id);

        $logo = $dealer->logo_dealer;

        if ($request->hasFile('logo_dealer')) {

            if ($dealer->logo_dealer) {
                Storage::disk('public')->delete($dealer->logo_dealer);
            }

            $logo = $request->file('logo_dealer')->store('dealer', 'public');
        }

        $dealer->update([
            'nama_dealer' => $request->nama_dealer,
            'alamat_dealer' => $request->alamat_dealer,
            'no_hp_dealer' => $request->no_hp_dealer,
            'email_dealer' => $request->email_dealer,
            'kota_dealer' => $request->kota_dealer,
            'logo_dealer' => $logo
        ]);

        return redirect()->route('admin.dealer.index')
            ->with('success', 'Dealer berhasil diupdate');
    }

    public function destroy($id)
    {
        $dealer = Dealer::findOrFail($id);

        if ($dealer->logo_dealer) {
            Storage::disk('public')->delete($dealer->logo_dealer);
        }

        $dealer->delete();

        return redirect()->route('admin.dealer.index')
            ->with('success', 'Dealer berhasil dihapus');
    }
}
