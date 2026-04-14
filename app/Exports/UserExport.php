<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class UserExport implements FromView
{
    public function view(): View
    {
        $users = User::with('dealer')
            ->where('role', '!=', 'super_admin') // ❌ tidak ikut export
            ->orderByRaw("
                CASE 
                    WHEN role = 'admin' THEN 1
                    ELSE 2
                END
            ")
            ->get();

        return view('admin.user.excel', [
            'users'   => $users,
            'tanggal' => now()->format('d-m-Y'),
            'jam'     => now()->format('H:i:s'),
        ]);
    }
}