<?php

namespace App\Http\Controllers;

use App\Models\RouterosAPI;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $pass = session()->get('pass');
        $API = new RouterosAPI();
        $API->debug('false');

        if ($API->connect($ip,$user,$pass)) {

            $identity = $API->comm('/system/identity/print');
            $routerModel = $API->comm('/system/routerboard/print');
            $hotspotuser = $API->comm('/ip/hotspot/user/print');
            $secret = $API->comm('/ppp/secret/print');

        } else {

          return 'Koneksi gagal';
       
        }

        // dd($identity);
        $data = [
            'title' => 'Dashboard',
            'totalhotspotuser' => count($hotspotuser),
            'identity' => $identity[0]['name'],
            'routerModel' => $routerModel[0]['model'],
            'totalSecret' => count($secret)
        ];

        return view('dashboard', $data);
    }
}
