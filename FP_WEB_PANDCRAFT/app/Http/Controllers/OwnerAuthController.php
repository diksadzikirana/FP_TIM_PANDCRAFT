<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;

class OwnerAuthController extends Controller
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

            $owner = DB::table('tb_user')
                ->where('remember_token', $token)
                ->where('role', 'pemilik')
                ->first();

            if ($owner) {

                Session::put('user', $owner->nama);
                Session::put('role', 'pemilik');

                return redirect('/owner/dashboard');
                 
            }
        }

        return view('owner.login');
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

    $owner = DB::table('tb_user')
        ->where('nama', $request->nama)
        ->where('password', $request->password)
        ->where('role', 'pemilik')
        ->first();

    if ($owner) {

        Session::put('user', $owner->nama);
        Session::put('role', 'pemilik');

        if ($request->remember) {

            $token = bin2hex(random_bytes(32));

            DB::table('tb_user')
                ->where('nama', $owner->nama)
                ->update([
                    'remember_token' => $token
                ]);

            Cookie::queue('remember_token', $token, 43200);
            Cookie::queue('remember_user', $owner->nama, 43200);

        } else {

            DB::table('tb_user')
                ->where('nama', $owner->nama)
                ->update([
                    'remember_token' => null
                ]);

            Cookie::queue(Cookie::forget('remember_token'));
            Cookie::queue(Cookie::forget('remember_user'));
        }

       return redirect('/owner/dashboard')->with('login_success', true);
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
        return view('owner.dashboard');
    }

      public function logout(Request $request)
{
    // 1. Dapatkan nama user
    $nama = Session::get('user');

    // 2. Hapus token di database supaya Auto-Login gagal
    if ($nama) {
        DB::table('tb_user')->where('nama', $nama)->update(['remember_token' => null]);
    }

    // 3. Hapus Session
    Session::forget('user');
    Session::forget('role');

    return redirect('/owner/login')->with('success', 'Anda telah berhasil logout.');
}
}