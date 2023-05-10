<?php

namespace App\Http\Controllers;

use App\Models\RouterosAPI;
use Illuminate\Http\Request;


class PPPoEController extends Controller
{
    public function index()
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $pass = session()->get('pass');
        $API = new RouterosAPI();
        $API->debug('false');

        if ($API->connect($ip,$user,$pass)) {

            $secret = $API->comm('/ppp/secret/print');
            $profile = $API->comm('/ppp/profile/print');

        } else {

          return 'Koneksi gagal';
       
        }

        $data = [
            'title' => 'PPPoE Secret',
            'totalSecret' => count($secret),
            'secret' => $secret,
            'profile' => $profile
        ];

        // dd($data);

        return view('pppoe.secret', $data);
    }

    public function edit(Request $request)
    {
        # code...
        return view('pppoe.edit');
    }
}
