<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserVerify;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{

    // Register
    public function register()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }

        // session()->forget('allow_login');

        return view('auth.register');
    }

    public function registerProses(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',

        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ];

        User::create($data);
        $cekToken = UserVerify::where('email', $request->input('email'))->first();
        if ($cekToken) {
            UserVerify::where('email', $request->input('email'))->delete();
        }

        $token = Str::uuid();
        $verifyData = [
            'email' => $request->input('email'),
            'token' => $token
        ];
        UserVerify::create($verifyData);
        try {
            Mail::send(
                'auth.email_verification',
                [
                    'token' => $token,
                    'email' => $request->input('email'),
                    'password' => $request->input('password')
                ],
                function ($message) use ($request) {

                    $message->to($request->input('email'));
                    $message->subject('Penjualan Motor - Verifikasi Email');
                }

            );
        } catch (\Exception $e) {
            return $e->getMessage();
        }


        return redirect()->route('login');
    }


    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }

        // hapus session token agar sekali pakai
        session()->forget('allow_login');

        return view('auth.login');
    }


    public function loginProses(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // redirect berdasarkan role
            $user = Auth::user();

            if ($user->role === 'super_admin') {
                if (is_null($user->email_verified_at)) {
                    Auth::logout();
                    return redirect()->route('login')
                        ->with('error', 'Email belum terverifikasi, silahkan cek email anda kembali')
                        ->withInput();
                }
                return redirect()->route('admin.dashboard');
            } else if ($user->role === 'admin') {
                if (is_null($user->email_verified_at)) {
                    Auth::logout();
                    return redirect()->route('login')
                        ->with('error', 'Email belum terverifikasi, silahkan cek email anda kembali')
                        ->withInput();
                }
                return redirect()->route('admin.dashboard');
            } else if ($user->role === 'sales') {
                if (is_null($user->email_verified_at)) {
                    Auth::logout();
                    return redirect()->route('login')
                        ->with('error', 'Email belum terverifikasi, silahkan cek email anda kembali')
                        ->withInput();
                }
                return redirect()->route('sales.index');
            } else if ($user->role === 'user') {
                if (is_null($user->email_verified_at)) {
                    Auth::logout();
                    return redirect()->route('login')
                        ->with('error', 'Email belum terverifikasi, silahkan cek email anda kembali')
                        ->withInput();
                }
                return redirect()->route('home');
            }
        }



        return back()->withErrors([
            'email' => 'Email atau Password salah',
        ]);
    }


    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerate();
        return redirect('/login');
    }

    public function verifyAccount($token)
    {
        $checkUser = UserVerify::where('token', $token)->first();
        if (!is_null($checkUser)) {
            $email = $checkUser->email;
            $dataUser = User::where('email', $email)->first();
            if ($dataUser->email_verified_at) {
                $message = "Akun anda sudah terverifikasi sebelumnya";
            } else {
                $data = [
                    'email_verified_at' => Carbon::now()
                ];
                User::where('email', $email)->update($data);
                UserVerify::where('email', $email)->delete();
                $message = "Akun berhasil diverifikasi, silahkan login";
            }
            return redirect()->route('login')->with($message);
        } else {
            return redirect()->route('login')->with('link token tidka valid!');
        }
    }
}
