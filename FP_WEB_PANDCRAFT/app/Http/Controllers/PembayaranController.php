<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembayaranController extends Controller
{
    public function index()
    {
        $data = DB::table('tb_pesanan as p')
            ->join('tb_pembeli as pb', 'p.id_pembeli', '=', 'pb.id_pembeli')
            ->join('tb_detail_pesanan as d', 'p.id_pesanan', '=', 'd.id_pesanan')
            ->join('tb_produk as pr', 'd.id_produk', '=', 'pr.id_produk')
            ->leftJoin('tb_pembayaran as pay', 'p.id_pesanan', '=', 'pay.id_pesanan')
            ->select('p.id_pesanan', 'pb.nama_pembeli', 'pr.nama_produk', 'pay.metode_bayar', 'pay.status_pembayaran', 'p.total_harga')
            ->orderBy('p.id_pesanan', 'DESC')
            ->get();

        return view('owner.kelola_pembayaran', compact('data'));
    }

    public function update(Request $request)
    {
        DB::table('tb_pembayaran')
            ->where('id_pesanan', $request->id_pesanan)
            ->update(['status_pembayaran' => $request->status_pembayaran]);

        return redirect()->back();
    }
}
