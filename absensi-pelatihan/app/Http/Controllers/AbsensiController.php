<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse; 
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

use App\Models\Absensi;



class AbsensiController extends Controller
{
    
    public function link(Request $request)
    {
        $data = Absensi::where('user_id', auth()->user()->id)->get();
        return Inertia::render('user/Absensi',[
            'data' => $data
        ]);
    }

    public function postAbsensi(Request $request): RedirectResponse
    {
        $validate = $request->validate([
            'user_id' => 'required',
            'name' => 'required|string|max:255',
            'kejuruan' => 'required|string|max:255',
            'kelas' => 'required|string|max:255',
            'tanggal' => 'required|string',
            'jam_masuk' => 'nullable|string',
            'jam_keluar' => 'nullable|string',
            'keterangan' => 'required|string|max:255',
        ]);
        
        Absensi::create($validate);

        return redirect()->route('linkAbsensi');
    }

    public function updateAbsensi(Request $request,$id){
        $absensi = Absensi::find($id);
        $absensi->jam_masuk = $request->jam_masuk; 
        $absensi->jam_keluar = $request->jam_keluar; 
        $absensi->save();

    return redirect()->back()->with('success', 'Data absensi berhasil diupdate');
    }

    public function linkLaporan(Request $request)
    {
        $data = Absensi::where('user_id', auth()->user()->id)->get();
        return Inertia::render('user/LaporanAbsensi',['data' => $data]);
    }

    public function linkKelolaAbsensi(Request $request)
    {
        $data = Absensi::all();
        return Inertia::render('admin/kelolaAbsensi', [
            'data' => $data
        ]);
    }

    public function destroy(Request $request)
    {
        $kejuruan = $request->input('kejuruan');
        Absensi::where('kejuruan', $kejuruan)->delete();
        return Redirect::route('kelolaAbsensi')->with('success', 'Data berhasil dihapus');
    }
}
