<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Simpanan extends Model
{
    //

    protected $table = 'tb_simpanan';
    protected $primaryKey = 'id';
    protected $fillable = [
        'anggota_id','tanggal','jenis_transaksi', 'nominal_transaksi','id_user',
    ];
}
