<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\dataUsers;
use App\Models\AnswerQuest;
use App\Models\kelurahanAkses;

class dataUsersController extends Controller
{
    public function getData(){
        $data = dataUsers::all();
        if($data->isEmpty()){
            return Inertia::render('Demografi', [
                'data' => [],
                'message' => ''
            ]);
            
        }else{
            return Inertia::render('Demografi', [
                'data' => $data,
                'message' => ''
            ]);
            
        }
    }
    public function home(){
        $kelurahanAkses = kelurahanAkses::all();
        return Inertia::render('Home', [
            'kelurahanAkses' => $kelurahanAkses
        ]);
    }

    public function updateIpwl(Request $request){
        $validated = $request->validate([
            'ipwl' => 'nullable'
        ]);

        $user = dataUsers::findOrFail($request['nikUser']);
        $user->ipwl = $request['ipwl'];
        $user->save();
        
        return response()->json([
            'success' => 'Data Berhasil Di Simpan',
            'data' => $user
        ]);
    }
  
    public function insert(Request $request){
        $validated = $request->validate([
            'nik' => 'required|string|max:255|unique:data_users,nik',
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'gender' => 'required|string|max:10',
            'academy' => 'required|string|max:255',
            'religion' => 'required|string|max:255',
            'status' => 'required|string|max:50',
            'job' => 'required|string|max:255',
            'dateOfBirth' => 'required|date',
            'old' => 'required'
        ]);

        // Buat record baru di tabel data_users
        dataUsers::create([
            'nik' => $validated['nik'],
            'name' => $validated['name'],
            'date' => $validated['date'],
            'gender' => $validated['gender'],
            'academy' => $validated['academy'],
            'religion' => $validated['religion'],
            'status' => $validated['status'],
            'job' => $validated['job'],
            'old' => $validated['old'],
            'date_of_birth' => $validated['dateOfBirth'],
        ]);

        return;
    
    }

    public function destroy($nik)
    {
        $data = dataUsers::find($nik);
        $data->delete();
        return Redirect::route('demografi');
    }

    public function detailData($nik)
    {
        $auth = dataUsers::find($nik);
        $data = dataUsers::where('nik', $auth->nik)->get();
        $dataQuiz = AnswerQuest::where('nik', $auth->nik)->get();
        $kelurahan = null;
    if ($auth->ipwl) {
        $kelurahan = kelurahanAkses::find($auth->ipwl);
    }

        return Inertia::render('Detail', [
            'data' => $data,
            'dataQuiz' => $dataQuiz,
            'kelurahan' => $kelurahan
        ]);
    }
    
}
