<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'ip' => 'required',
            'user' => 'required',
        ]);
        $ip = $request->post('ip');
        $user = $request->post('user');
        $pass = $request->post('pass');

        $data = [
            'ip' => $ip,
            'user' => $user,
            'pass' => $pass,
        ];

        // dd($data);
        $request->session()->put($data);

        return redirect()->route('dashboard')->with('sukses', 'Login berhasil');
    }
}
