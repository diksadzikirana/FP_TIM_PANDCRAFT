<?php

namespace App\Http\Controllers;

use App\Models\Produk; // <--- INI YANG WAJIB ADA
use App\Traits\ActivityLogTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class KatalogController extends Controller
{
    use ActivityLogTrait;

    public function index(Request $request)
{
    // Ambil kata kunci dari input search
    $search = $request->input('search');

    // Query dasar: ambil yang tersedia
    $query = Produk::where('status_produk', 'Tersedia');

    // Jika ada kata kunci, tambahkan filter pencarian
    if ($search) {
        $query->where('nama_produk', 'LIKE', '%' . $search . '%');
    }

    $data = $query->get();

    return view('pembeli.katalog', compact('data'));
}
public function detail($id)
{
    // Mengambil data produk berdasarkan ID
    $produk = Produk::where('id_produk', $id)->firstOrFail();
    
    return view('pembeli.detail_produk', compact('produk'));
}
public function checkout(Request $request)
{
    $produk = Produk::findOrFail($request->id_produk);
    $jumlah = $request->jumlah;
    $total = $produk->harga * $jumlah;

    return view('pembeli.checkout', compact('produk', 'jumlah', 'total'));
}

public function prosesPesanan(Request $request)
{
    // CONSISTENCY: Validasi input sebelum proses
    $validator = Validator::make($request->all(), [
        'id_produk' => 'required|integer|min:1',
        'nama' => 'required|string|max:255',
        'no_hp' => 'required|string|max:20',
        'alamat' => 'required|string|max:500',
        'jumlah' => 'required|integer|min:1|max:1000',
        'metode' => 'required|in:COD,Transfer',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Definisikan variabel di luar agar bisa diakses di bawah
    $id_pesanan = null;

    try {
        // ATOMICITY + ISOLATION: Wrap dalam transaction dengan lock
        DB::transaction(function () use ($request, &$id_pesanan) {
            // Gunakan lockForUpdate() untuk pessimistic locking (Isolation)
            $produk = Produk::where('id_produk', $request->id_produk)
                ->lockForUpdate()
                ->firstOrFail();

            // CONSISTENCY: Cek stok sebelum decrement
            if ($produk->stok < $request->jumlah) {
                throw new \Exception('Stok tidak mencukupi. Tersedia: ' . $produk->stok . ', Diminta: ' . $request->jumlah);
            }

            // CONSISTENCY: Cek status produk
            if ($produk->status_produk !== 'Tersedia') {
                throw new \Exception('Produk tidak tersedia untuk pembelian.');
            }

            // 1. Simpan Pembeli
            $id_pembeli = DB::table('tb_pembeli')->insertGetId([
                'nama_pembeli' => $request->nama,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            // 2. Simpan Pesanan dan assign ke variabel $id_pesanan
            $total_bayar = ($produk->harga * $request->jumlah) + 10000;
            $id_pesanan = DB::table('tb_pesanan')->insertGetId([
                'id_pembeli' => $id_pembeli,
                'tgl_pesanan' => now(),
                'total_harga' => $total_bayar,
                'jumlah_pesanan' => $request->jumlah,
                'status_pesanan' => 'Menunggu',
                'created_at' => now(),
                'updated_at' => now()
            ]);

            // 3. Simpan Detail Pesanan
            DB::table('tb_detail_pesanan')->insert([
                'id_pesanan' => $id_pesanan,
                'id_produk' => $request->id_produk,
                'jumlah' => $request->jumlah,
                'harga_satuan' => $produk->harga,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            // 4. Simpan Pembayaran
            DB::table('tb_pembayaran')->insert([
                'id_pesanan' => $id_pesanan,
                'metode_bayar' => $request->metode,
                'status_pembayaran' => ($request->metode == 'COD' ? 'Belum Bayar' : 'Menunggu Pembayaran'),
                'tgl_bayar' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ]);

            // 5. Update Stok (ATOMICITY: decrement dalam transaksi yang sama)
            $produk->decrement('stok', $request->jumlah);

            // DURABILITY: Log aktivitas (activity logs)
            $this->logProcess('tb_pesanan', $id_pesanan, 'ORDER_CREATED', [
                'id_pembeli' => $id_pembeli,
                'id_produk' => $request->id_produk,
                'jumlah' => $request->jumlah,
                'total_harga' => $total_bayar,
                'metode_bayar' => $request->metode,
                'stok_awal' => $produk->stok + $request->jumlah,
                'stok_akhir' => $produk->stok
            ]);
        });

        return redirect('/riwayat/' . $id_pesanan)->with('success', 'Pesanan berhasil dibuat!');
    } catch (\Exception $e) {
        // Jika error, transaksi otomatis rollback (ATOMICITY)
        // DURABILITY: Log error
        $this->logActivity('PROCESS_FAILED', 'tb_pesanan', null, [
            'reason' => $e->getMessage(),
            'user_id' => Session::get('user_id'),
        ]);

        return redirect()->back()->withErrors(['error' => 'Gagal membuat pesanan: ' . $e->getMessage()])->withInput();
    }
}
public function riwayat($id)
{
    $pesanan = DB::table('tb_pesanan as p')
        ->join('tb_detail_pesanan as d', 'p.id_pesanan', '=', 'd.id_pesanan')
        ->join('tb_produk as pr', 'd.id_produk', '=', 'pr.id_produk')
        ->join('tb_pembayaran as pb', 'p.id_pesanan', '=', 'pb.id_pesanan')
        ->where('p.id_pesanan', $id)
        ->select('p.*', 'd.jumlah', 'pr.nama_produk', 'pr.gambar', 'pb.metode_bayar', 'pb.status_pembayaran')
        ->first();

    // TAMBAHKAN INI UNTUK CEK:
    if (!$pesanan) {
        dd("Data dengan ID $id tidak ditemukan di database. Cek apakah JOIN sudah benar.");
    }

    return view('pembeli.riwayat', compact('pesanan'));
}
public function lihatPesanan()
{
    // Mengambil data pesanan dengan JOIN
    $pesanan = DB::table('tb_pesanan as p')
        ->join('tb_detail_pesanan as d', 'p.id_pesanan', '=', 'd.id_pesanan')
        ->join('tb_produk as pr', 'd.id_produk', '=', 'pr.id_produk')
        ->select('p.*', 'd.jumlah', 'pr.nama_produk', 'pr.gambar')
        ->orderBy('p.id_pesanan', 'DESC')
        ->get();

    return view('pembeli.lihat_pesanan', compact('pesanan'));
}
}