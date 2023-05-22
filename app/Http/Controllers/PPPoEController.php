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

    public function store(Request $request)
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $pass = session()->get('pass');
        $API = new RouterosAPI();
        $API->debug = false;

        if ($API->connect($ip,$user,$pass)) {
            $API->comm('/ppp/secret/add', [
				'name' => $request['user'],
				'password' => $request['password'],
				'service' => $request['service'] == '' ? 'any' : $request['service'],
				'profile' => $request['profile'] == '' ? 'default' : $request['profile'],
				'local-address' => $request['localaddress'] == '' ? '0.0.0.0' : $request['localaddress'],
				'remote-address' => $request['remoteaddress'] == '' ? '0.0.0.0' : $request['remoteaddress'],
				'comment' => $request['comment'] == '' ? '' : $request['comment'],
			]);

            return redirect('pppoe/secret')->with('sukses','Data berhasil ditambahkan');
    
        } else {
            return 'Koneksi gagal';
        }
    }

    public function edit(Request $request)
    {
        # code...
        return view('pppoe.edit');
    }
}
