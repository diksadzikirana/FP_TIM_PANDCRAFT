<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Traits\ActivityLogTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class ProdukController extends Controller
{
    use ActivityLogTrait;

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

        // CONSISTENCY: Validasi input
        $request->validate([
            'nama_produk'   => 'required|string|max:255',
            'harga'         => 'required|numeric|min:0',
            'status_produk' => 'required|in:Tersedia,Tidak Tersedia',
            'stok'          => 'required_if:status_produk,Tersedia|integer|min:0'
        ], [
            'harga.required'     => 'Harga produk wajib diisi.',
            'harga.numeric'      => 'Harga harus berupa angka.',
            'harga.min'          => 'Harga tidak boleh kurang dari 0.',
            'stok.required_if'   => 'Stok wajib diisi jika produk tersedia.',
            'stok.integer'       => 'Stok harus berupa angka.',
            'stok.min'           => 'Stok tidak boleh kurang dari 0.',
            'status_produk.in'   => 'Status produk harus Tersedia atau Tidak Tersedia.',
        ]);

        try {
            // ATOMICITY: Wrap dalam transaction (DB + file operations)
            DB::transaction(function () use ($request) {
                // 2. Tentukan mode EDIT atau TAMBAH
                $isEdit = !empty($request->id_produk);
                $produk = $isEdit ? Produk::lockForUpdate()->find($request->id_produk) : new Produk();

                if (!$produk && $isEdit) {
                    throw new \Exception('Produk tidak ditemukan.');
                }

                // Simpan data lama untuk logging (UPDATE)
                $oldData = $isEdit ? $produk->getAttributes() : [];

                // 3. Simpan data
                $produk->nama_produk = $request->nama_produk;
                $produk->harga = $request->harga;
                $produk->status_produk = $request->status_produk;
                $produk->stok = ($request->status_produk == 'Tidak Tersedia') ? 0 : $request->stok;

                // 4. Logika Upload Gambar (CONSISTENCY: file upload dalam transaction scope)
                $namaFile = $produk->gambar; // Default: gambar lama
                if ($request->hasFile('gambar')) {
                    // Validasi file
                    $request->validate([
                        'gambar' => 'image|mimes:jpeg,png,jpg,gif|max:5120' // Max 5MB
                    ]);

                    // Hapus gambar lama jika ada (sebelum save DB)
                    if ($isEdit && !empty($produk->gambar)) {
                        $pathLama = public_path('gambar_produk/' . $produk->gambar);
                        if (file_exists($pathLama)) {
                            @unlink($pathLama); // Gunakan @ untuk suppress error
                        }
                    }

                    // Upload gambar baru
                    $file = $request->file('gambar');
                    $namaFile = time() . '_' . $file->getClientOriginalName();
                    $file->move(public_path('gambar_produk'), $namaFile);
                    $produk->gambar = $namaFile;
                }

                // Save ke DB
                $produk->save();

                // DURABILITY: Log aktivitas (activity logs)
                if ($isEdit) {
                    $this->logUpdate('tb_produk', $produk->id_produk, $oldData, $produk->getAttributes());
                } else {
                    $this->logCreate('tb_produk', $produk->id_produk, $produk->getAttributes());
                }
            });

            return redirect()->back()->with('success', 'Data berhasil disimpan');
        } catch (\Exception $e) {
            // Jika error, transaksi otomatis rollback (ATOMICITY)
            // DURABILITY: Log error
            $this->logActivity('SAVE_FAILED', 'tb_produk', $request->id_produk ?? null, [
                'reason' => $e->getMessage(),
                'user_id' => Session::get('user_id'),
            ]);

            return redirect()->back()->withErrors(['error' => 'Gagal menyimpan produk: ' . $e->getMessage()])->withInput();
        }
    }

    public function hapus($id)
    {
        // CONSISTENCY: Proteksi - Hanya 'pemilik' yang bisa hapus
        if (Session::get('role') !== 'pemilik') {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk menghapus produk!');
        }

        try {
            DB::transaction(function () use ($id) {
                $produk = Produk::lockForUpdate()->find($id);
                if (!$produk) {
                    throw new \Exception('Produk tidak ditemukan.');
                }

                // Simpan data sebelum hapus untuk logging
                $deletedData = $produk->getAttributes();

                // Hapus gambar
                if (!empty($produk->gambar)) {
                    $path = public_path('gambar_produk/' . $produk->gambar);
                    if (File::exists($path)) {
                        File::delete($path);
                    }
                }

                // Hapus dari DB
                $produk->delete();

                // DURABILITY: Log aktivitas
                $this->logDelete('tb_produk', $id, $deletedData);
            });

            return redirect()->back()->with('success', 'Produk berhasil dihapus.');
        } catch (\Exception $e) {
            // DURABILITY: Log error
            $this->logActivity('DELETE_FAILED', 'tb_produk', $id, [
                'reason' => $e->getMessage(),
                'user_id' => Session::get('user_id'),
            ]);

            return redirect()->back()->with('error', 'Gagal menghapus produk: ' . $e->getMessage());
        }
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