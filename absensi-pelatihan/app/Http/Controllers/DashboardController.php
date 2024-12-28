<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\User;

class DashboardController extends Controller
{
    public function getDashboard(Request $request)
    {
        $data = User::all();
        return Inertia::render('admin/Dashboard', [
            'data' => $data,
        ]);    
    }

}
