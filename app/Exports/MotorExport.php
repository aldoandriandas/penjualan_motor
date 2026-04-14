<?php

namespace App\Exports;

use App\Models\Motor;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class MotorExport implements FromView
{
    public function view(): View
    {
        $motors = Motor::with('dealer') // kalau ada relasi
            ->orderBy('merk_id', 'asc')
            ->get();

        return view('admin.motor.excel', [
            'motors'  => $motors,
            'tanggal' => now()->format('d-m-Y'),
            'jam'     => now()->format('H:i:s'),
        ]);
    }
}