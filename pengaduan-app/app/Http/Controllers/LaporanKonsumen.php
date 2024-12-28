<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\CSModel;

class LaporanKonsumen extends Controller
{
    public function index(){
        $cs = CSModel::all();
        return Inertia::render('cs/LaporanKonsumen',[
            'laporan' => $cs
        ]);
    }

    public function linkDashboard(){
        $cs = CSModel::all();
        return Inertia::render('cs/Dashboard',[
            'laporan' => $cs
        ]);
    }
    
    public function dataSektor(){
        $cs = CSModel::all();
        return Inertia::render('cs/DataSector',[
            'laporan' => $cs
        ]);
    }
    
    public function updateStatus(Request $request, $id) {
        $cs = CSModel::findOrFail($id);
        $cs->status = $request->status;
        $cs->save(); 
        
        return redirect()->back();
    }
    
    public function dataCS(){
        $cs = CSModel::where('status', 'disetujui')->get();
        $ca = CSModel::all();
        return Inertia::render('cs/DataCostumer',[
            'laporan' => $cs,
            'notif' => $ca
        ]);
    }
}
