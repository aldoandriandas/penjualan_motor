<?php

namespace App\Http\Controllers;

use App\Models\Motor;
use App\Models\Testimoni;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $motors = Motor::with('model')->latest()->get();
         $testimonis = Testimoni::latest()->take(6)->get();
         $totalMotor = Motor::count();
         

        return view('home', compact('motors','testimonis','totalMotor',));
    }
}
