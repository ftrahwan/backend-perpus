<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class PengembalianModel extends Model
{
    protected $table = 'pengembalian';
    protected $primarykey = 'id_pengembalian';
    public $timestamps = false;
    public $fillable = [
        'id_peminjaman','tanggal_pengembalian','denda'
    ];
}
