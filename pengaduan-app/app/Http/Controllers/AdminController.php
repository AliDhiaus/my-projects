<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\CSModel;

class AdminController extends Controller
{
    public function linkDashboard(){
        $cs = CSModel::where('status', 'disetujui')->get();
        return Inertia::render('admin/Dashboard',[
            'laporan' => $cs
        ]);
    }

    public function dataCS(){
        $cs = CSModel::where('status', 'disetujui')->get();
        return Inertia::render('admin/DataCostumer',[
            'laporan' => $cs
        ]);
    }
    
    public function getDataCS($id){
        $data = CSModel::where('id', $id)->get();
        return Inertia::render('admin/FormSektor', [
            'laporan' => $data
        ]);
    }
   
    public function updateDataCS(Request $request, $id)
    {
        $cs = CSModel::findOrFail($id);
        $cs->tanggapan = $request->tanggapan;
        $cs->save(); 
        
        return redirect()->back();
    }

    public function dataSektor(){
        $data = CSModel::all();
        $cs = CSModel::where('status', 'disetujui')->get();
        return Inertia::render('admin/DataSektor', [
            'data' => $data,
            'laporan' => $cs
        ]);
    }

}
