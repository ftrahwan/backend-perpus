<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class KelasModel extends Model
{
    protected $table = 'kelas';
    protected $primarykey = 'id_kelas';
    public $timestamps = false;
    public $fillable = [
        'id_kelas','nama_kelas','kelompok'
    ];
}
