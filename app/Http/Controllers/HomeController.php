<?php

namespace App\Http\Controllers;

use App\Models\Motor;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $motors = Motor::with('model')->latest()->get();

        return view('home', compact('motors'));
    }
}
