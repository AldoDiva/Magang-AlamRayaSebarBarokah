<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use PDF;

class HomeController extends Controller
{
    public function users()
    {
        return view('mahasiswa');
    }
}
