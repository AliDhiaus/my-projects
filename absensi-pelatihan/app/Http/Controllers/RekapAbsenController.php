<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Absensi;


class RekapAbsenController extends Controller
{
    public function link(Request $request)
    {
        $data = Absensi::all();
        return Inertia::render('admin/RekapAbsensi', ['data' => $data]);
    }

}
