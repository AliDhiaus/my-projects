<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\kelurahanAkses as Kelurahan;

class kelurahanAksesController extends Controller
{
    public function getDataKelurahan(){
        $data = Kelurahan::all();
        if($data->isEmpty()){
            return Inertia::render('Kelurahan', [
                'data' => $data,
                'message' => 'Data Not Found'
            ]);
        } else {
            return Inertia::render('Kelurahan', [
                'data' => $data,
                'message' => ''
            ]);
        }
    }

    public function kelurahanAddPage(){
        return Inertia::render('tambahKelurahan');
    }

    public function postDataKelurahan(Request $request){
        $validatedData = $request->validate([
            'provinsi' => 'required|string|max:255',
            'kota' => 'required|string|max:255',
            'upk' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kelurahan' => 'required|string|max:255',
        ]);

        Kelurahan::create($validatedData);
        return Redirect::route('kelurahan');
    }
    
    public function destroyKelurahan($id){
        Kelurahan::findOrFail($id)->delete();
        return redirect()->back();
    }
}
