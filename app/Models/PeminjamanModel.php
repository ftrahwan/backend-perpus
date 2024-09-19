<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class PeminjamanModel extends Model
{
    protected $table = 'peminjaman';
    protected $primarykey = 'id_peminjaman';
    public $timestamps = false;
    public $fillable = [
        'id_siswa','tanggal_pinjam','tanggal_kembali'
    ];
}
