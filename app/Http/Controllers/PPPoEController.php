<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PPPoEController extends Controller
{
    public function index()
    {
        # code...
        return view('pppoe.secret');
    }
}
