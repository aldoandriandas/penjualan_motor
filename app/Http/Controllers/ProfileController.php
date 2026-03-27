<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileController extends Controller
{

    public function index()
    {
        $user = Auth::user();

        return view('profile.index', compact('user'));
    }


    public function update(Request $request)
    {

        $request->validate([
            'no_hp' => 'required|string|max:15',
            'alamat' => 'required|string|max:255'
        ]);

        $user = Auth::user();

        $user->update([
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat
        ]);

        return redirect()
            ->route('profile.index')
            ->with('success', 'Profil berhasil diperbarui');
    }
}
