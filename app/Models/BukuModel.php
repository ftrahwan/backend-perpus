<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class BukuModel extends Model
{
    protected $table = 'buku';
    protected $primarykey = 'id_buku';
    public $timestamps = false;
    public $fillable = [
        'nama_buku','pengarang','deskripsi','foto'
    ];
}
