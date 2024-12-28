<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\user;
use App\Models\das;
use App\Models\IsiDas;
use App\Models\jadwal;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('authToken')->plainTextToken;

            return response()->json([
                'token' => $token,
                'level' => $user->level,
            ]);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    public function forgot(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
        ]);

        $email = user::where('email', $request->input('email'))->first();

        if($email){
            $token = $email->createToken('authToken')->plainTextToken;
            return response()->json(['success' => true, 'message' => 'Login successful', 'token' => $token, 'email' => $email], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Invalid credentials'], 401);
        }
    }

    public function manageAccount(Request $request)
    {
        if ($request->isMethod('get')) {
            $user = Auth::user();
            return response()->json($user);
        } 
        
        if ($request->isMethod('post')) {
            $request->validate([
                'password' => 'required|string|confirmed|min:8',
            ]);
    
            $user = Auth::user();
            $user->password = Hash::make($request->input('password'));
            $user->save();
    
            return response()->json(['message' => 'Password reset successful'], 200);
        }
    }

    public function getDas(){
        $das = Das::all();

        return response()->json([
            'message' => 'Data Berhasil di ambil',
            'das' => $das,
        ], 200);
    }

    public function manageDas(Request $request)
    {  
        if ($request->isMethod('get')) 
        {
            $user = Auth::user();
            $das = Das::where('account_id', $user->id)->get();
            return response()->json($das);
        }
    
        
        if($request->isMethod('post')){
            $request->validate([
                'judul' => 'required|string',
                'tanggal' => 'required|date',
                'petugas' => 'required|string',
            ]);

            $user = Auth::user();

            $das = Das::create([
                'account_id' => $user->id,
                'judul' => $request->input('judul'),
                'tanggal' => $request->input('tanggal'),
                'petugas' => $request->input('petugas'),
            ]);
            return response()->json(['message' => 'Password reset successful'], 200);
        }
    }

    public function isiDas(Request $request, $das_id)
    {
        $request->validate([
            'waktu' => 'required|string',
            'program' => 'required|string',
            'frame' => 'required|string',
            'durasi' => 'required|string',
            'keterangan' => 'required|string',
        ]);

        $das = IsiDas::create([
            'das_id' => $das_id,
            'waktu' => $request->input('waktu'),
            'program' => $request->input('program'),
            'frame' => $request->input('frame'),
            'durasi' => $request->input('durasi'),
            'keterangan' => $request->input('keterangan'),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data saved successfully',
            'data' => $das
        ], 200);
    }

    public function getIsiDas($id){
        $das = Das::findOrFail($id);
        $isiDas = $das->isiDas;
        return response()->json($isiDas);
    }

    public function deleteDas($id){
        $das = Das::find($id);
        $das->delete();
        return response()->json(['message' => 'Data successfully deleted']);
    }

    public function updateIsiDas($id, Request $request){
        $isiDas = IsiDas::where('id', $id)->update([
            'waktu' => $request->waktu,
            'program' => $request->program,
            'frame' => $request->frame,
            'durasi' => $request->durasi,
            'keterangan' => $request->keterangan
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data successfully deleted',
            'data' => $isiDas
        ]);
    }
    
    public function deleteIsiDas($id){
        $idisi = IsiDas::findOrFail($id);
        $idisi->delete();
        return response()->json(['message' => 'Data successfully deleted']);
    }

    public function manageJadwal(Request $request)
    {  
        if ($request->isMethod('get')) 
        {
            $user = jadwal::all();
            return response()->json($user);
        }
    
        
        if($request->isMethod('post')){
            $request->validate([
                'nama' => 'required|string',
                'waktu' => 'required|string',
                'hariTanggal' => 'required|string',
                'shift' => 'required|string',
                'tempat' => 'required|string'
            ]);

            $das = jadwal::create([
                'nama' => $request->input('nama'),
                'waktu' => $request->input('waktu'),
                'hariTanggal' => $request->input('hariTanggal'),
                'shift' => $request->input('shift'),
                'tempat' => $request->input('tempat')
            ]);
            return response()->json(['message' => 'Password reset successful'], 200);
        }
    }

    public function updateJadwal(Request $request, $id)
    {
        $jadwal = jadwal::findOrFail($id);
        $jadwal->update($request->all());

        return response()->json([
            'success' => true,
            'data' => $jadwal
        ]);
    }

    public function deleteJadwal($id){
        $jadwal = jadwal::find($id);
        $jadwal->delete();

        return response()->json(['message' => 'delete jadwal successful'], 200);

    }

    public function managePenyiar(Request $request)
    {  
       $account = user::all();
       return response()->json($account);
    }

}
