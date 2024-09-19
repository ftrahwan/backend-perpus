<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class SiswaModel extends Model
{
    protected $table = 'siswa';
    protected $primarykey = 'id_siswa';
    public $timestamps = false;
    public $fillable = [
        'nama_siswa','tanggal_lahir','gender',
        'alamat','username','password','id_kelas'
    ];
}
