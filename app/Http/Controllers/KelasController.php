<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KelasModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class KelasController extends Controller
{
    //LOGIN
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }
    //MENAMBAH KELAS
    public function addKelas(Request $req){
        $validator = Validator::make($req->all(),[
            'nama_kelas'=>'required',
            'kelompok'=>'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson());
        }
        $save = KelasModel::create([
            'nama_kelas' => $req->get('nama_kelas'),
            'kelompok' => $req->get('kelompok'),
        ]);
        if($save){
            return response()->json(['status'=>true, 'message'=>'Sukses menambahkan']);
        }else{
            return response()->json(['status'=>false, 'message'=>'Gagal menambahkan']);
        }
    }
    //MEMANGGIL KELAS
    public function getKelas(){
        $datakelas=KelasModel::get();
        return response()->json($datakelas);
    }
    //MENGUBAH KELAS
    public function updateKelas(Request $req, $id_kelas){
        $validator = Validator::make($req->all(),[
            'nama_kelas'=>'required',
            'kelompok'=>'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson());
        }
        $update = KelasModel::where('id_kelas',$id_kelas)->update([
            'nama_kelas' => $req->get('nama_kelas'),
            'kelompok' => $req->get('kelompok'),
        ]);
        if($update){
            return response()->json(['status'=>true, 'message'=>'Sukses mengubah']);
        }else{
            return response()->json(['status'=>false, 'message'=>'Gagal mengubah']);
        }
    }
    //MENGHAPUS KELAS   
    public function deleteKelas($id_kelas){
        $delete = KelasModel::where('id_kelas',$id_kelas)->delete();
        if($delete){
            return response()->json(['status'=>true, 'message'=>'Sukses menghapus']);
        }else{
            return response()->json(['status'=>false, 'message'=>'Gagal menghapus']);
        }
    }
}
