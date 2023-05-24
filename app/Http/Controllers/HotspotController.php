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

    public function store(Request $request)
    {
        $request->validate([
            'user' => 'required',
            'password' => 'required',
        ]);

        $ip = session()->get('ip');
        $user = session()->get('user');
        $pass = session()->get('pass');
        $API = new RouterosAPI();
        $API->debug = false;

        if ($API->connect($ip, $user, $pass)) {
            if ($request['timelimit'] == '') {
                $timelimit = '0';
            } else {
                $timelimit = $request['timelimit'];
            }

            $API->comm('/ip/hotspot/user/add', [
                'name' => $request['user'],
                'password' => $request['password'],
                'server' => $request['server'],
                'profile' => $request['profile'],
                'limit-uptime' => $timelimit,
                'comment' => $request['comment'],
            ]);

            return redirect('hotspot')->with('sukses', 'User Hotspot Berhasil Ditambahkan');
        } else {
            return redirect('failed');
        }
        // dd($request->all);
    }

    public function edit($id)
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $pass = session()->get('pass');
        $API = new RouterosAPI();
        $API->debug = false;

        if ($API->connect($ip, $user, $pass)) {
            $getuser = $API->comm('/ip/hotspot/user/print', [
                '?.id' => '*' . $id,
            ]);

            $server = $API->comm('/ip/hotspot/print');
            $profile = $API->comm('/ip/hotspot/user/profile/print');

            $data = [
                'title' => 'User Hotspot Edit',
                'user' => $getuser[0],
                'server' => $server,
                'profile' => $profile,
            ];

            // dd($data);

            return view('hotspot.edit', $data);
        } else {
            return 'Gagal';
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'user' => 'required',
            'password' => 'required',
        ]);

        $ip = session()->get('ip');
        $user = session()->get('user');
        $pass = session()->get('pass');
        $API = new RouterosAPI();
        $API->debug = false;

        if ($API->connect($ip, $user, $pass)) {
            if ($request['timelimit'] == '') {
                $timelimit = '0';
            } else {
                $timelimit = $request['timelimit'];
            }

            $API->comm('/ip/hotspot/user/set', [
                '.id' => $request['id'],
                'name' => $request['user'] == '' ? $request['user'] : $request['user'],
                'password' => $request['password'] == '' ? $request['password'] : $request['password'],
                'server' => $request['server'] == '' ? $request['server'] : $request['server'],
                'profile' => $request['profile'] == '' ? $request['profile'] : $request['profile'],
                'limit-uptime' => $timelimit,
                'disabled' => $request['disabled'] == '' ? $request['disabled'] : $request['disabled'],
                'comment' => $request['comment'] == '' ? $request['comment'] : $request['comment'],
            ]);

            return redirect('hotspot')->with('sukses', 'Hotspot user berhasil diperbarui');

        } else {

            return 'Gagal';

        }
    }
}
