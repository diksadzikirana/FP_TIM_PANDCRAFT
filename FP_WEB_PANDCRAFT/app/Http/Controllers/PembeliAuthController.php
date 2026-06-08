<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;

class PembeliAuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | TAMPILKAN HALAMAN LOGIN
    |--------------------------------------------------------------------------
    */

    public function showLogin(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | AUTO LOGIN DARI COOKIE
        |--------------------------------------------------------------------------
        */

        if (!Session::has('user') && $request->cookie('remember_token')) {

            $token = $request->cookie('remember_token');

            $pembeli = DB::table('tb_user')
                ->where('remember_token', $token)
                ->where('role', 'pembeli')
                ->first();

            if ($pembeli) {

                Session::put('user', $pembeli->nama);
                Session::put('role', 'pembeli');

                return redirect('/pembeli/katalog');
                 
            }
        }

        return view('pembeli.login');
    }

    /*
    |--------------------------------------------------------------------------
    | PROSES LOGIN
    |--------------------------------------------------------------------------
    */

  public function login(Request $request)
{
    $request->validate([
        'nama' => 'required|string|max:100',
        'password' => 'required|string'
    ], [
        'nama.required' => 'Nama pengguna wajib diisi.',
        'password.required' => 'Kata sandi wajib diisi.'
    ]);

    // 1. Ambil data user dan simpan ke variabel $user
    $user = DB::table('tb_user')
        ->whereRaw('BINARY nama = ?', [$request->nama])
        ->whereRaw('BINARY password = ?', [$request->password])
        ->where('role', 'pembeli')
        ->first();

    // 2. Gunakan variabel $user yang sudah terdefinisi
    if ($user) {
        Session::put('user', $user->nama);
        Session::put('role', 'pembeli');

        if ($request->remember) {
            $token = bin2hex(random_bytes(32));

            DB::table('tb_user')
                ->whereRaw('BINARY nama = ?', [$user->nama])
                ->update([
                    'remember_token' => $token
                ]);

            Cookie::queue('remember_token', $token, 43200);
            Cookie::queue('remember_user', $user->nama, 43200);
        } else {
            DB::table('tb_user')
                ->whereRaw('BINARY nama = ?', [$user->nama])
                ->update([
                    'remember_token' => null
                ]);

            Cookie::queue(Cookie::forget('remember_token'));
            Cookie::queue(Cookie::forget('remember_user'));
        }

        // 3. Arahkan ke dashboard pembeli yang benar (bukan /owner/katalog)
        return redirect('/pembeli/katalog')->with('login_success', true);
    }

    return back()->with('error', 'Login gagal! Nama atau Kata Sandi salah.');
}
    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

    public function dashboard()
    {
        return view('pembeli.katalog');
    }

   public function logout(Request $request)
{
    // 1. Dapatkan nama user
    $nama = Session::get('user');

    // 2. Hapus token di database supaya Auto-Login gagal
    if ($nama) {
        DB::table('tb_user')->whereRaw('BINARY nama = ?', [$nama])->update(['remember_token' => null]);
    }

    // 3. Hapus Session
    Session::forget('user');
    Session::forget('role');

    return redirect('/pembeli/login')->with('success', 'Anda telah berhasil logout.');
}
}
