<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model {
    protected $table = 'tb_pesanan';
    protected $primaryKey = 'id_pesanan';
    public $timestamps = false; 
}
