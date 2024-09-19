<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PeminjamanModel;
use App\Models\DetailModel;
use App\Models\PengembalianModel;
use Carbon\Carbon;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    //LOGIN
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }
    //PEMINJAMAN BUKU
    public function rentBuku(Request $req){
        $validator = Validator::make($req->all(),[
            'id_siswa'=>'required',
            'tanggal_pinjam'=>'required',
            'tanggal_kembali'=>'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors());
        }
        $save = PeminjamanModel::create([
            'id_siswa' => $req->get('id_siswa'),
            'tanggal_pinjam' => $req->get('tanggal_pinjam'),
            'tanggal_kembali' => $req->get('tanggal_kembali'),
        ]);
        if($save){
            return response()->json(['status'=>1, 'message'=>'Sukses meminjam']);
        }else{
            return response()->json(['status'=>0, 'message'=>'Gagal meminjam']);
        }
    }

    //TAMBAH ITEM
    public function addItem(Request $req, $id){
        $validator = Validator::make($req->all(),[
            'id_buku'=>'required',
            'qty'=>'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors());
        }
        $save = DetailModel::create([
            'id_peminjaman' => $id,
            'id_buku' => $req->get('id_buku'),
            'qty' => $req->get('qty'),
        ]);
        if($save){
            return response()->json(['status'=>1, 'message'=>'Sukses menambahkan']);
        }else{
            return response()->json(['status'=>0, 'message'=>'Gagal menambahkan']);
        }
    }
    
    //PENGEMBALIAN BUKU
    public function returnBuku(Request $req){
        $validator = Validator::make($req->all(),[
            'id_peminjaman'=>'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors());
        }
        $cek = PengembalianModel::where('id_peminjaman',$req->id_peminjaman);
        if($cek->count() == 0){
            $data_kembali = PeminjamanModel::where('id_peminjaman',$req->id_peminjaman)->first();
            $tanggal_sekarang = Carbon::now()->format('Y-m-d');
            $tanggal_kembali = new Carbon($data_kembali->tanggal_kembali);
            $denda = 1500;
            if(strtotime($tanggal_sekarang) > strtotime($tanggal_kembali)){
                $jumlah_hari = $tanggal_kembali->diff($tanggal_sekarang)->days;
                $jumlah_denda = $jumlah_hari*$denda;
            }else{
                $jumlah_denda = 0;
            }
        $save = PengembalianModel::create([
            'id_peminjaman' => $req->id_peminjaman,
            'tanggal_pengembalian' => $tanggal_sekarang,
            'denda' => $jumlah_denda
        ]);
        if($save){
            $data['status'] = 1;
            $data['message'] = 'Berhasil dikembalikan';
        }else{
            $data['status'] = 0;
            $data['message'] = 'Gagal dikembalikan';
        }
    }else{
        $data = ['status'=>0,'message'=>'sudah pernah dikembalikan'];
    }return response()->json($data);
}
}