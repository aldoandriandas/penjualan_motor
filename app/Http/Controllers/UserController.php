<?php

namespace App\Http\Controllers;

use App\Models\Dealer;
use App\Models\User;
use App\Models\UserVerify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class UserController extends Controller
{
public function index()
{
    $user = Auth::user();

    // Semua user yang login boleh melihat data
    if (!$user) {
        abort(403, 'Anda harus login terlebih dahulu.');
    }

    $users = User::with('dealer')
        ->orderByRaw("
            CASE 
                WHEN role = 'super_admin' THEN 1
                WHEN role = 'admin' THEN 2
                WHEN role = 'user' THEN 3
                ELSE 4
            END
        ")
        ->get();

    // Hitung jumlah berdasarkan role
    $totalAdmin = User::where('role', 'admin')->count();
    $totalUser = User::where('role', 'user')->count();

    return view('admin.user.index', [
        'title' => 'Halaman User',
        'users' => $users,
        'totalAdmin' => $totalAdmin,
        'totalUser' => $totalUser
    ]);
}

public function create()
{
    $user = Auth::user();

    // jika bukan super_admin atau admin tidak boleh akses
    if(!in_array($user->role, ['super_admin','admin'])){
        abort(403, 'Anda tidak memiliki akses');
    }

    $data = [
        'title' => 'Tambah Data User'
    ];

    // hanya super admin yang perlu memilih dealer
    if($user->role == 'super_admin'){
        $data['dealers'] = Dealer::orderBy('nama_dealer','asc')->get();
    }

    return view('admin.user.create', $data);
}


    public function store(Request $request)
{
    $loginUser = Auth::user();

    // ================= VALIDASI =================
    $request->validate([
        'name'                  => 'required|string|max:255',
        'email'                 => 'required|email|unique:users,email',
        'password'              => 'required|min:6|confirmed',
        'no_hp'                 => 'nullable|string|max:15',
        'alamat'                => 'nullable|string',
        'role'                  => 'required|in:admin,user,sales',
        'dealer_id'             => 'nullable|exists:dealers,id'
    ]);


    // ================= CEK ROLE =================
    if ($loginUser->role == 'super_admin') {

        // super admin hanya boleh membuat admin dealer
        if ($request->role != 'admin') {
            abort(403, 'Super Admin hanya boleh membuat Admin Dealer');
        }

        $dealer_id = $request->dealer_id;

    } elseif ($loginUser->role == 'admin') {

        // admin dealer hanya boleh membuat sales / user
        if (!in_array($request->role, ['sales', 'user'])) {
            abort(403, 'Admin hanya boleh membuat Sales atau User');
        }

        // dealer mengikuti admin
        $dealer_id = $loginUser->dealer_id;

    } else {

        abort(403, 'Anda tidak memiliki akses');

    }


    // ================= SIMPAN USER =================
    $user = User::create([
        'name'      => $request->name,
        'email'     => $request->email,
        'password'  => Hash::make($request->password),
        'no_hp'     => $request->no_hp,
        'alamat'    => $request->alamat,
        'role'      => $request->role,
        'dealer_id' => $dealer_id
    ]);


    // ================= HAPUS TOKEN LAMA =================
    $cekToken = UserVerify::where('email', $request->email)->first();

    if ($cekToken) {
        UserVerify::where('email', $request->email)->delete();
    }


    // ================= BUAT TOKEN BARU =================
    $token = Str::uuid();

    UserVerify::create([
        'email' => $request->email,
        'token' => $token
    ]);


    // ================= KIRIM EMAIL =================
    try {

        Mail::send(
            'auth.email_verification',
            [
                'token' => $token,
                'email' => $request->email,
                'password' => $request->password
            ],
            function ($message) use ($request) {

                $message->to($request->email);
                $message->subject('Penjualan Motor - Verifikasi Email');

            }
        );

    } catch (\Exception $e) {

        return $e->getMessage();

    }


    // ================= REDIRECT =================
    return redirect()
        ->route('admin.user.index')
        ->with('success', 'User berhasil dibuat');
}

    public function edit($id)
    {
        $loginUser = Auth::user();

        $user = User::findOrFail($id);

        // Jika admin dealer, hanya boleh edit user dalam dealer yang sama
        if ($loginUser->role == 'admin') {

            if ($user->dealer_id != $loginUser->dealer_id) {
                abort(403, 'Anda tidak memiliki akses ke user ini');
            }

            $dealers = Dealer::where('id', $loginUser->dealer_id)->get();
        } else {

            // Super admin bisa lihat semua dealer
            $dealers = Dealer::all();
        }

        return view('admin.user.edit', [
            'title'   => 'Edit Data User',
            'user'    => $user,
            'dealers' => $dealers
        ]);
    }

    public function update(Request $request, $id)
{
    $loginUser = Auth::user();

    $user = User::findOrFail($id);

    /*
    |--------------------------------------------------------------------------
    | SUPER ADMIN HANYA BOLEH EDIT ADMIN
    |--------------------------------------------------------------------------
    */

    if ($loginUser->role == 'super_admin' && $user->role != 'admin') {

        return redirect()->route('admin.user.index')
            ->with('error', 'Super Admin hanya boleh mengubah Admin Dealer.');
    }

    /*
    |--------------------------------------------------------------------------
    | VALIDASI
    |--------------------------------------------------------------------------
    */

    $request->validate(
        [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $id,
            'role'     => 'required|in:super_admin,admin,user,sales',
            'no_hp'    => 'nullable|string|max:15',
            'alamat'   => 'nullable|string',
            'password' => 'nullable|confirmed|min:8',
        ],
        [
            'name.required'      => 'Nama tidak boleh kosong',
            'email.required'     => 'Email tidak boleh kosong',
            'email.unique'       => 'Email sudah ada',
            'role.required'      => 'Role harus dipilih',
            'password.confirmed' => 'Password konfirmasi tidak sama',
            'password.min'       => 'Password minimal 8 karakter',
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | CEK ADMIN TERAKHIR
    |--------------------------------------------------------------------------
    */

    $adminCount = User::where('role', 'admin')->count();

    if (
        $user->role == 'admin' &&
        $adminCount == 1 &&
        $request->role != 'admin'
    ) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Admin terakhir tidak boleh diubah rolenya.');
    }

    $oldEmail = $user->email;


    /*
    |--------------------------------------------------------------------------
    | UPDATE DATA USER
    |--------------------------------------------------------------------------
    */

    $user->name   = $request->name;
    $user->email  = $request->email;
    $user->role   = $request->role;
    $user->no_hp  = $request->no_hp;
    $user->alamat = $request->alamat;


    /*
    |--------------------------------------------------------------------------
    | DEALER
    |--------------------------------------------------------------------------
    */

    if ($request->role == 'super_admin') {

        $user->dealer_id = null;

    } else {

        if ($loginUser->role == 'super_admin') {

            $user->dealer_id = $request->dealer_id;

        } else {

            $user->dealer_id = $loginUser->dealer_id;

        }

    }


    /*
    |--------------------------------------------------------------------------
    | PASSWORD
    |--------------------------------------------------------------------------
    */

    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    $user->save();


    /*
    |--------------------------------------------------------------------------
    | VERIFIKASI EMAIL JIKA BERUBAH
    |--------------------------------------------------------------------------
    */

    if ($oldEmail != $request->email) {

        UserVerify::where('email', $request->email)->delete();

        $token = Str::uuid();

        UserVerify::create([
            'email' => $request->email,
            'token' => $token
        ]);

        try {

            Mail::send(
                'auth.email_verification',
                [
                    'token' => $token,
                    'email' => $request->email
                ],
                function ($message) use ($request) {

                    $message->to($request->email);
                    $message->subject('Penjualan Motor - Verifikasi Email');

                }
            );

        } catch (\Exception $e) {

            return back()->with('error', 'Email verifikasi gagal dikirim.');
        }

    }

    return redirect()->route('admin.user.index')
        ->with('success', 'Data user berhasil diperbarui');
}

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if (Auth::id() == $user->id) {
            return redirect()->route('user')
                ->with('error', 'Anda tidak bisa menghapus akun sendiri!');
        }

        if ($user->role === 'admin') {

            $totalAdmin = User::where('role', 'admin')->count();

            if ($totalAdmin <= 1) {
                return redirect()->route('user')
                    ->with('error', 'Minimal harus ada 1 Admin!');
            }
        }

        $user->delete();

        return redirect()->route('admin.user.index')
            ->with('success', 'Data user berhasil dihapus');
    }
}
