<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;


class Admin10ClientController extends Controller
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
                $response = $client->request('GET', "{$url}/admindetail10");
                $body = $response->getBody();
                $user = json_decode($body, true);
                $data =  $user['data'];
                return view('admin.detaildata', compact('data'));
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store10(Request $request)
    {
        if (Auth::check()) {
            if (Auth::user()->role == 'Admin') {
                $client = new Client;
                $url = "http://localhost/laravel-sispro/public/api";
                $response = $client->request('POST', "{$url}/status10", [
                    'json' => [
                        'id' => $request->id
                    ]
                ]);
                $body = $response->getBody(); 

                $user = json_decode($body, true);
                $data =  $user['data'];
                return redirect('/status10')->with('success_message', 'Status user berhasil diubah!');
            } else {
                return redirect('/');
            }
        } else {
            return redirect('/')->with('error_message', 'Silakan login kembali!');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show10($id)
    {
        if (Auth::check()) {
            if (Auth::user()->role == 'Admin') {
                $client = new Client;
                $url = "http://localhost/laravel-sispro/public/api";
                $response = $client->request('GET', "{$url}/admindetail10/{$id}");
                $body = $response->getBody();
                $user = json_decode($body, true);
                $data =  $user['data'];
                return view('admin.datadetails10', compact('data'));
            } else {
                return redirect('/');
            }
        } else {
            return redirect('/')->with('error_message', 'Silakan login kembali!');
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit10($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy10($id)
    {
        //
    }

    public function status10()
    {
        if (Auth::check()) {
            if (Auth::user()->role == 'Admin') {
                $client = new Client;
                $url = "http://localhost/laravel-sispro/public/api";
                $response = $client->request('GET', "{$url}/status10");
                $body = $response->getBody();           
                $user = json_decode($body, true);
                $data =  $user['data'];
                return view('admin.status', compact('data'));
            } else {
                return redirect('/');
            }
        } else {
            return redirect('/')->with('error_message', 'Silakan login kembali!');
        }

    }
}
