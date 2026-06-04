<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

class ProdukController extends Controller
{
    // Cek apakah user sudah login
    private function checkLogin()
    {
        return Session::has('user');
    }

    private function getRole()
    {
        return Session::get('role', 'owner');
    }

    private function getLoginRoute(Request $request)
    {
        return $request->is('admin/*') || $request->is('admin') ? '/admin/login' : '/owner/login';
    }

    private function getViewByRole()
    {
        return $this->getRole() === 'admin' ? 'admin.kelola_produk' : 'owner.kelola_produk';
    }

    public function index(Request $request)
    {
        if (!$this->checkLogin()) {
            return redirect($this->getLoginRoute($request));
        }

        $data = Produk::all();
        $edit = null;

        return view($this->getViewByRole(), compact('data', 'edit'));
    }

    public function simpan(Request $request)
    {
        if (!$this->checkLogin()) {
            return redirect('/owner/login');
        }

        // 1. Validasi
        //CONSISTENCY
        $request->validate([
            'nama_produk'   => 'required',
            'harga'         => 'required|numeric',
            'status_produk' => 'required',
            'stok'          => 'required_if:status_produk,Tersedia|integer|min:0'
        ], [
            'harga.required'     => 'Harga produk wajib diisi.',
            'stok.required_if'   => 'Stok wajib diisi jika produk tersedia.',
            'stok.integer'       => 'Stok harus berupa angka.',
            'stok.min'           => 'Stok tidak boleh kurang dari 0.',
        ]);

        // 2. Tentukan mode EDIT atau TAMBAH
        $isEdit = !empty($request->id_produk);
        $produk = $isEdit ? Produk::find($request->id_produk) : new Produk();

        // 3. Simpan data
        $produk->nama_produk = $request->nama_produk;
        $produk->harga = $request->harga;
        $produk->status_produk = $request->status_produk;
        $produk->stok = ($request->status_produk == 'Tidak Tersedia') ? 0 : $request->stok;

        // 4. Logika Upload Gambar
        if ($request->hasFile('gambar')) {
            if ($isEdit && !empty($produk->gambar)) {
                $pathLama = public_path('gambar_produk/' . $produk->gambar);
                if (file_exists($pathLama)) {
                    unlink($pathLama);
                }
            }
            $file = $request->file('gambar');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('gambar_produk'), $namaFile);
            $produk->gambar = $namaFile;
        }

        $produk->save();

        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    public function hapus($id)
    {
        // Proteksi: Hanya 'pemilik' yang bisa hapus
        if (Session::get('role') !== 'pemilik') {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk menghapus produk!');
        }

        $produk = Produk::find($id);
        if ($produk) {
            $path = public_path('gambar_produk/' . $produk->gambar);
            if (File::exists($path)) {
                File::delete($path);
            }
            $produk->delete();
            return redirect()->back()->with('success', 'Produk berhasil dihapus.');
        }
        return redirect()->back()->with('error', 'Produk tidak ditemukan.');
    }

    public function edit($id)
    {
        if (!$this->checkLogin()) {
            return redirect($this->getLoginRoute(request()));
        }

        $data = Produk::all();
        $edit = Produk::findOrFail($id);

        return view($this->getViewByRole(), compact('data', 'edit'));
    }
}