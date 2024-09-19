<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SiswaModel;
use Illuminate\Support\Facades\Validator;
// use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{
    //LOGIN
    // public function __construct()
    // {
    //     $this->middleware('auth:api', ['except' => ['login', 'register']]);
    // }
    //MENAMBAH SISWA
    public function addSiswa(Request $req){
        $validator = Validator::make($req->all(),[
            'nama_siswa'=>'required',
            'tanggal_lahir'=>'required',
            'gender'=>'required',
            'alamat'=>'required',
            'id_kelas'=>'required'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson());
        }
        $save = SiswaModel::create([
            'nama_siswa' => $req->get('nama_siswa'),
            'tanggal_lahir' => $req->get('tanggal_lahir'),
            'gender' => $req->get('gender'),
            'alamat' => $req->get('alamat'),
            'id_kelas' => $req->get('id_kelas'),
        ]);
        if($save){
            return response()->json(['status'=>true, 'message'=>'Sukses menambahkan']);
        }else{
            return response()->json(['status'=>false, 'message'=>'Gagal menambahkan']);
        }
    }
    //MEMANGGIL SISWA
    public function getSiswa(){
        $datasiswa=SiswaModel::get();
        return response()->json($datasiswa);
    }
    //MENGUBAH SISWA
    public function updateSiswa(Request $req, $id_siswa){
        $validator = Validator::make($req->all(),[
            'nama_siswa'=>'required',
            'tanggal_lahir'=>'required',
            'gender'=>'required',
            'alamat'=>'required',
            'id_kelas'=>'required'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson());
        }
        $update = SiswaModel::where('id_siswa',$id_siswa)->update([
            'nama_siswa' => $req->get('nama_siswa'),
            'tanggal_lahir' => $req->get('tanggal_lahir'),
            'gender' => $req->get('gender'),
            'alamat' => $req->get('alamat'),
            'id_kelas' => $req->get('id_kelas'),
        ]);
        if($update){
            return response()->json(['status'=>true, 'message'=>'Sukses mengubah']);
        }else{
            return response()->json(['status'=>false, 'message'=>'Gagal mengubah']);
        }
    }
    //MENGHAPUS SISWA
    public function deleteSiswa(Request $req){
        $id_siswa = $req->get('id_siswa');
        $delete = SiswaModel::where('id_siswa',$id_siswa)->delete();
        if($delete){
            return response()->json(['status'=>true, 'message'=>'Sukses menghapus']);
        }else{
            return response()->json(['status'=>false, 'message'=>'Gagal menghapus']);
        }
    }
}
