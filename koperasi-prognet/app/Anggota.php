<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    public $incrementing = false;
	protected $table = 'tb_anggota';
    protected $primaryKey = 'id';
    protected $fillable = [
        'no_anggota','nama','alamat', 'telepon','noktp','kelamin_id', 'status_aktif','user_id',
    ];

}
