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


class AnswerUserController extends Controller
{
    public function insertQuiz(Request $request){
        {
            $request->validate([
                'answers' => 'required|array',
                'nik' => 'required|string',
            ]);
    
            $answers = $request->input('answers');
            $nik = $request->input('nik');
    
            AnswerQuest::updateOrCreate(
                ['nik' => $nik], 
                ['answer' => json_encode($answers)] 
            );
    
            return '';
        }
    }
}
