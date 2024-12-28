<?php

namespace App\Http\Controllers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\CSModel;

class CSController extends Controller
{
    public function link(Request $request) {
        return Inertia::render('user/FormCS');   
    }

    public function postCS(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string',
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
            'no_kontrak' => 'required|string|max:50',
            'keluhan' => 'required|string',
            'user_id' => 'required',
        ]);
    
        CSModel::create($validatedData);
    
        return Redirect()->route('postCS.user')->with('success', 'Data CS berhasil ditambahkan');
    }

    public function dataKeluhan(){
        $data = CSModel::where('user_id', auth()->user()->id)->get();
        return Inertia::render('user/Keluhan', [
            'data' => $data
        ]);
    }
   
}
