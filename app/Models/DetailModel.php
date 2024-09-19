<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class DetailModel extends Model
{
    protected $table = 'detail';
    protected $primarykey = 'id_detail_peminjaman';
    public $timestamps = false;
    public $fillable = [
        'id_peminjaman','id_buku','qty'
    ];
}
