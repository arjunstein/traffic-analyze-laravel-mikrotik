<?php

namespace App\Http\Controllers;

use App\Models\RouterosAPI;
use Illuminate\Http\Request;

class HotspotController extends Controller
{
    public function index()
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $pass = session()->get('pass');
        $API = new RouterosAPI();
        $API->debug = false;

        if ($API->connect($ip, $user, $pass)) {

            $hotspotuser = $API->comm('/ip/hotspot/user/print');
            $server = $API->comm('/ip/hotspot/print');
            $profile = $API->comm('/ip/hotspot/user/profile/print');


            $data = [
                'title' => 'Kelola Hotspot',
                'totalhotspotuser' => count($hotspotuser),
                'hotspotuser' => $hotspotuser,
                'server' => $server,
                'profile' => $profile,
            ];

            return view('hotspot.index', $data);

        } else {

            return redirect('failed');
        }
    }
}
