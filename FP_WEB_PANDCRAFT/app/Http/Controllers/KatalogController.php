<?php

namespace App\Http\Controllers;

use App\Models\Produk; // <--- INI YANG WAJIB ADA
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KatalogController extends Controller
{
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
    // Definisikan variabel di luar agar bisa diakses di bawah
    $id_pesanan = null; 
    //ATOMICITY
    DB::transaction(function () use ($request, &$id_pesanan) {
        $produk = Produk::findOrFail($request->id_produk);
        
        // 1. Simpan Pembeli
        $id_pembeli = DB::table('tb_pembeli')->insertGetId([
            'nama_pembeli' => $request->nama,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat
        ]);

        // 2. Simpan Pesanan dan assign ke variabel $id_pesanan
        $total_bayar = ($produk->harga * $request->jumlah) + 10000;
        $id_pesanan = DB::table('tb_pesanan')->insertGetId([
            'id_pembeli' => $id_pembeli,
            'tgl_pesanan' => now(),
            'total_harga' => $total_bayar,
            'jumlah_pesanan' => $request->jumlah,
            'status_pesanan' => 'Menunggu'
        ]);

        // 3. Simpan Detail
        DB::table('tb_detail_pesanan')->insert([
            'id_pesanan' => $id_pesanan,
            'id_produk' => $request->id_produk,
            'jumlah' => $request->jumlah,
            'harga_satuan' => $produk->harga
        ]);

        // 4. Simpan Pembayaran
        DB::table('tb_pembayaran')->insert([
            'id_pesanan' => $id_pesanan,
            'metode_bayar' => $request->metode,
            'status_pembayaran' => ($request->metode == 'COD' ? 'Belum Bayar' : 'Menunggu Pembayaran'),
            'tgl_bayar' => now()
        ]);

        // 5. Update Stok
        $produk->decrement('stok', $request->jumlah);
    });

    // Sekarang $id_pesanan sudah memiliki nilai dan siap digunakan untuk redirect
    return redirect('/riwayat/' . $id_pesanan)->with('success', 'Pesanan berhasil dibuat!');
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