<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;

class ManajemenPesertaController extends Controller
{
    public function link(Request $request)
    {
        $data = User::where('role', 'user')->get();
        return Inertia::render('admin/ManajemenPeserta',[
            'data' => $data
        ]);
    }

    public function linkTambahPeserta()
    {
        return Inertia::render('admin/TambahPeserta');
    }

    public function destroy($id)
    {
        $akun = User::findOrFail($id);
        $akun->delete();

        return Redirect::route('manajemenPeserta')->with('success', 'Data berhasil dihapus');
    }

    public function getEdit($id)
    {
        $akun = User::findOrFail($id);
    
        return Inertia::render('admin/EditPeserta', [
            'akun' => $akun,
        ]);
    
    }    
    public function updatePeserta(Request $request, $id)
    {
   
        $user = User::findOrFail($id);
        $user->name = $request->name; 
        $user->email = $request->email; 
        $user->tanggal_lahir = $request->tanggal_lahir; 
        $user->jenis_kelamin = $request->jenis_kelamin; 
        $user->alamat = $request->alamat; 

        $user->save();
    
        return Redirect::route('manajemenPeserta')->with('success', 'Data berhasil dihapus');

    }    

}
