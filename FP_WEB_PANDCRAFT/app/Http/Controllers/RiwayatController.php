<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class RiwayatController extends Controller
{
    public function index()
    {
        $data = DB::table('tb_pesanan as p')
            ->join('tb_pembeli as pb', 'p.id_pembeli', '=', 'pb.id_pembeli')
            ->join('tb_detail_pesanan as d', 'p.id_pesanan', '=', 'd.id_pesanan')
            ->join('tb_produk as pr', 'd.id_produk', '=', 'pr.id_produk')
            ->leftJoin('tb_pembayaran as pay', 'p.id_pesanan', '=', 'pay.id_pesanan')
            ->where('p.status_pesanan', 'Selesai')
            ->orderBy('p.id_pesanan', 'DESC')
            ->get();

        return view('owner.riwayat_penjualan', compact('data'));
    }
}
