<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;


class Agama10ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index10()
    { 
        if (Auth::check()) {
            if (Auth::user()->role == 'Admin') {
                $client = new Client;
                $url = "http://localhost/laravel-sispro/public/api";
                $response = $client->request('GET', "{$url}/agama10");
                $body = $response->getBody();
                $agama = json_decode($body, true);
                $data =  $agama['data'];
                return view('admin.agama.agama10', compact('data'));
            } else {
                return redirect('/');
            }
        } else {
            return redirect('/')->with('error_message', 'Silakan login kembali!');
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create10()
    {
        if (Auth::check()) {
            if (Auth::user()->role == 'Admin') {
                return view('admin.agama.addagama');
            } else {
                return redirect('/');
            }
        } else {
            return redirect('/')->with('error_message', 'Silakan login kembali!');
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store10(Request $request)
    {
        $client = new Client;
        $url = "http://localhost/laravel-sispro/public/api";
        $response = $client->request('POST', "{$url}/agama10", [
            'json' => [
                'namaagama' => $request->namaagama
            ]
        ]);
        $body = $response->getBody();
        $agama = json_decode($body, true);
        $data =  $agama['success'];
        if ($response != true) {
            return redirect('/agama10')->with('success_message', 'Agama gagal ditambahkan!');
        }
        return redirect('/agama10')->with('success_message', 'Agama berhasil ditambahkan!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show10($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit10($id)
    {
        if (Auth::check()) {
            if (Auth::user()->role == 'Admin') {
                $client = new Client;
                $url = "http://localhost/laravel-sispro/public/api";
                $response = $client->request('GET', "{$url}/agama10/{$id}");
                $body = $response->getBody();
                $agama = json_decode($body, true);
                $data =  $agama['data'];
                return view('admin.agama.editagama', compact('data'));
            } else {
                return redirect('/');
            }
        } else {
            return redirect('/')->with('error_message', 'Silakan login kembali!');
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update10(Request $request, $id)
    {
        $client = new Client;
        $url = "http://localhost/laravel-sispro/public/api";
        $response = $client->request('PUT', "{$url}/agama10/{$request->id}", [
            'json' => [
                'id' => $request->id,
                'namaagama' => $request->namaagama
            ]
        ]);
        $body = $response->getBody();
        $agama = json_decode($body, true);
        $data =  $agama['success'];
        if ($response != true) {
            return redirect('/agama10')->with('success_message', 'Agama gagal diubah!');
        }
        return redirect('/agama10')->with('success_message', 'Agama berhasil diubah!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy10(Request $request)
    {
        $client = new Client;
        $url = "http://localhost/laravel-sispro/public/api";
        $response = $client->request('DELETE', "{$url}/agama10/{$request->id}", [
            'json' => [
                'id' => $request->id
            ]
        ]);
        $body = $response->getBody();
        $agama = json_decode($body, true);
        $data =  $agama['success'];
        if ($response != true) {
            return redirect('/agama10')->with('success_message', 'Agama gagal dihapus!');
        }
        return redirect('/agama10')->with('success_message', 'Agama berhasil dihapus!');

    }
}
