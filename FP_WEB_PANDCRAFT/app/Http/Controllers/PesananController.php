<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    public function index()
    {
        // Logika SQL yang sebelumnya di PHP Native
        $pesan_masuk = DB::table('tb_pesanan as p')
            ->join('tb_pembeli as pb', 'p.id_pembeli', '=', 'pb.id_pembeli')
            ->join('tb_detail_pesanan as d', 'p.id_pesanan', '=', 'd.id_pesanan')
            ->join('tb_produk as pr', 'd.id_produk', '=', 'pr.id_produk')
            ->where('p.status_pesanan', 'Menunggu')
            ->orderBy('p.id_pesanan', 'DESC')
            ->get();

        $semua = DB::table('tb_pesanan as p')
            ->join('tb_pembeli as pb', 'p.id_pembeli', '=', 'pb.id_pembeli')
            ->join('tb_detail_pesanan as d', 'p.id_pesanan', '=', 'd.id_pesanan')
            ->join('tb_produk as pr', 'd.id_produk', '=', 'pr.id_produk')
            ->orderBy('p.id_pesanan', 'DESC')
            ->get();

        return view('owner.kelola_pesanan', compact('pesan_masuk', 'semua'));
    }

    public function detail($id)
    {
        $data = DB::table('tb_pesanan as p')
            ->join('tb_pembeli as pb', 'p.id_pembeli', '=', 'pb.id_pembeli')
            ->join('tb_detail_pesanan as d', 'p.id_pesanan', '=', 'd.id_pesanan')
            ->join('tb_produk as pr', 'd.id_produk', '=', 'pr.id_produk')
            ->leftJoin('tb_pembayaran as pay', 'p.id_pesanan', '=', 'pay.id_pesanan')
            ->where('p.id_pesanan', $id)
            ->first();

        if (!$data) {
            return abort(404, 'Data tidak ditemukan');
        }

        return view('owner.detail_pesanan', compact('data'));
    }
}
