<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BukuModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class BukuController extends Controller
{
    //LOGIN
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }
    //MENAMBAH BUKU
    public function addBuku(Request $req){
        $validator = Validator::make($req->all(),[
            'nama_buku'=>'required',
            'pengarang'=>'required',
            'deskripsi'=>'required',
            'foto'=>'required|image',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson());
        }
    //PROSES FOTO
        if ($req->hasFile('foto')) {
            $file = $req->file('foto');
            $filename = $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
    //MENYIMPAN BUKU
        $save = BukuModel::create([
            'nama_buku' => $req->get('nama_buku'),
            'pengarang' => $req->get('pengarang'),
            'deskripsi' => $req->get('deskripsi'),
            'foto' => $filename,
        ]);
        if($save){
            return response()->json(['status'=>true, 'message'=>'Sukses menambahkan']);
        }else{
            return response()->json(['status'=>false, 'message'=>'Gagal menambahkan']);
        }
    }
}
    //MEMANGGIL BUKU
    public function getBuku(){
        $databuku=BukuModel::get();
        return response()->json($databuku);
    }
    //MENGUBAH BUKU
    public function updateBuku(Request $req, $id_buku){
        $validator = Validator::make($req->all(),[
            'nama_buku'=>'required',
            'pengarang'=>'required',
            'deskripsi'=>'required',
            'foto'=>'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson());
        }
        $update = BukuModel::where('id_buku',$id_buku)->update([
            'nama_buku' => $req->get('nama_buku'),
            'pengarang' => $req->get('pengarang'),
            'deskripsi' => $req->get('deskripsi'),
            'foto' => $req->get('foto'),
        ]);
        if($update){
            return response()->json(['status'=>true, 'message'=>'Sukses mengubah']);
        }else{
            return response()->json(['status'=>false, 'message'=>'Gagal mengubah']);
        }
    }
    //MENGHAPUS BUKU
    public function deleteBuku(Request $id_buku){
        $delete = BukuModel::where('id_buku',$id_buku)->delete();
        if($delete){
            return response()->json(['status'=>true, 'message'=>'Sukses menghapus']);
        }else{
            return response()->json(['status'=>false, 'message'=>'Gagal menghapus']);
        }
    }
}
