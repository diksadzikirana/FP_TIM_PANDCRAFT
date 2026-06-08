<?php

namespace App\Http\Controllers; // PASTI HARUS SEPERTI INI

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pesanan; // Pastikan model ada di App\Models
use Illuminate\Support\Facades\DB;
class AdminController extends Controller
{
    public function index() {
        return view('admin.dashboard');
    }

    // GABUNGAN DARI UPDATE STATUS PESANAN & PEMBAYARAN
 public function pesanan() 
{
    // Query ini disesuaikan persis dengan SQL native kamu
    $data = DB::table('tb_pesanan as p')
        ->join('tb_pembeli as pb', 'p.id_pembeli', '=', 'pb.id_pembeli')
        ->join('tb_detail_pesanan as d', 'p.id_pesanan', '=', 'd.id_pesanan')
        ->join('tb_produk as pr', 'd.id_produk', '=', 'pr.id_produk')
        ->leftJoin('tb_pembayaran as pay', 'p.id_pesanan', '=', 'pay.id_pesanan')
        ->select(
            'p.id_pesanan', 
            'p.total_harga', 
            'p.status_pesanan', 
            'pb.nama_pembeli', 
            'pr.nama_produk', 
            'pay.status_pembayaran',
            'pay.metode_bayar'
        )
        ->orderBy('p.id_pesanan', 'desc')
        ->get();

    // Kirim data ke view
    return view('admin.pesanan', compact('data'));
}

//    

    // Statistik/Grafik
    public function grafik() 
{
    // Mengambil data produk dan menghitung total jumlah yang terjual (asumsi ada kolom jumlah di tb_detail_pesanan)
    $data = DB::table('tb_detail_pesanan as d')
        ->join('tb_produk as p', 'd.id_produk', '=', 'p.id_produk')
        ->select('p.nama_produk', DB::raw('SUM(d.jumlah) as total_terjual'))
        ->groupBy('p.nama_produk')
        ->orderBy('total_terjual', 'desc')
        ->get();


    return view('admin.grafik', compact('data'));
}

    public function updateStatus(Request $request) 
{
    // Validasi input
    $request->validate(['id' => 'required', 'status' => 'required']);

    DB::table('tb_pesanan')
        ->where('id_pesanan', $request->id)
        ->update(['status_pesanan' => $request->status]);

    return redirect()->back()->with('success', 'Status pesanan berhasil diupdate!');
}

public function updatePembayaran(Request $request) 
{
    // Pastikan nama kolom 'status_pembayaran' sesuai dengan database
    DB::table('tb_pembayaran')
        ->where('id_pesanan', $request->id)
        ->update(['status_pembayaran' => $request->status_pembayaran]);

    return redirect()->back()->with('success', 'Status pembayaran berhasil diupdate!');
}

//LIHAT PESANAN
public function lihatPesanan() 
{
    $pesanan = DB::table('tb_pesanan as p')
        ->join('tb_pembeli as pb', 'p.id_pembeli', '=', 'pb.id_pembeli')
        ->leftJoin('tb_detail_pesanan as d', 'p.id_pesanan', '=', 'd.id_pesanan')
        ->join('tb_produk as pr', 'd.id_produk', '=', 'pr.id_produk')
        ->leftJoin('tb_pembayaran as pay', 'p.id_pesanan', '=', 'pay.id_pesanan')
        ->select(
            'p.id_pesanan', 
            'p.total_harga', 
            'p.status_pesanan', 
            'pb.nama_pembeli', 
            'pr.nama_produk', 
            'd.jumlah',
            'pay.status_pembayaran'
        )
        ->orderByRaw("CASE WHEN p.status_pesanan = 'SELESAI' THEN 1 ELSE 0 END")
        ->orderBy('p.id_pesanan', 'desc')
        ->get()
        ->groupBy('id_pesanan'); // Mengelompokkan berdasarkan ID Pesanan

    return view('admin.lihat_pesananadmin', compact('pesanan'));
}

}
