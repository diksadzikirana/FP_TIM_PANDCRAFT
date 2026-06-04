<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AdminAuthController extends Controller
{
    public function showLoginForm(Request $request)
    {
        $rememberedUser = $request->cookie('remember_user') ?? "";
        return view('admin.login', compact('rememberedUser'));
    }

    public function login(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'password' => 'required',
        ]);

        $user = DB::table('tb_user')
            ->where('nama', $request->nama)
            ->where('password', $request->password) // Catatan: Sebaiknya gunakan Hash::check()
            ->where('role', 'admin')
            ->first();

        if ($user) {
            Session::put('user', $user->nama);
            Session::put('role', 'admin');

            // Handle Remember Me
            if ($request->has('remember')) {
                cookie()->queue('remember_user', $request->nama, 60 * 24 * 30);
            } else {
                cookie()->forget('remember_user');
            }

            return redirect('/admin/dashboard')->with('success', 'Login admin berhasil!');
        }

        return back()->with('error', 'Login gagal!');
    }
    public function logout() {
    Session::flush(); // Menghapus semua session
    return redirect('/admin/login')->with('success', 'Anda telah logout.');
}
}
