<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use GuzzleHttp\Client;
use DateTime;

class DetailData10ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index10()
    {
        if (Auth::check()) {
            if (Auth::user()->is_active == 1) {
                $id = Auth::user()->id;
                $client = new Client;
                $url = "http://localhost/laravel-sispro/public/api";
                $response = $client->request('GET', "{$url}/detail10/{$id}");
                $body = $response->getBody();
                $detail = json_decode($body, true)['data'];
                $status =  $detail['status'];
                $data =  $detail['detail'];
                return view('user.index', compact('status', 'data'));
            } else {
                return redirect('/')->with('error_message', 'Fitur tidak dapat diakses, pengguna belum aktif!');
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
            if (Auth::user()->is_active == 1) {
                $client = new Client;
                $url = "http://localhost/laravel-sispro/public/api";
                $response = $client->request('GET', "{$url}/agama10");
                $body = $response->getBody();
                
                $detail = json_decode($body, true);
                $data =  $detail['data'];
                return view('user.adddetail', compact('data'));
            } else {
                return redirect('/')->with('error_message', 'Fitur tidak dapat diakses, pengguna belum aktif!');
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
        $validator = Validator::make($request->all(), [
            'tempat_lahir' => 'required|string|max:150',
            'tanggal_lahir' => 'required',
            'agama' => 'required',
            'alamat' => 'required',
            'foto_ktp' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        if ($validator->fails()) {
            return redirect('/detail10')->with('success_message', 'Detail data gagal ditambahkan!');
        }

        $tgl = new DateTime("$request->tanggal_lahir");
        $tgl_now = new DateTime('today');
        $umur = $tgl->diff($tgl_now)->y;

        $foto = $request->file('foto_ktp');
        $folder = 'photo';
        $extension = $foto->getClientOriginalExtension();
        $namafoto = Str::uuid().".".$extension;
        $foto->move($folder, $namafoto);
        
        $client = new Client;
        $url = "http://localhost/laravel-sispro/public/api";
        $response = $client->request('POST', "{$url}/detail10", [
            'json' => [
                'id' => $request->id,
                'user_id' => Auth::user()->id,
                'alamat' => $request->alamat,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'agama' => $request->agama,
                'umur' => $umur,
                'foto_ktp' => $namafoto
            ]
        ]);
        $body = $response->getBody();
        $detail = json_decode($body, true);
        $data =  $detail['success'];
        if ($response != true) {
            return redirect('/detail10')->with('success_message', 'Detail data gagal ditambahkan!');
        }
        return redirect('/detail10')->with('success_message', 'Detail data berhasil ditambahkan!');

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
            if (Auth::user()->is_active == 1) {
                $client = new Client;
                $url = "http://localhost/laravel-sispro/public/api";
                $respons_agama = $client->request('GET', "{$url}/agama10");
                $body_agama = $respons_agama->getBody();
                $agama = json_decode($body_agama, true);
                $dataagama =  $agama['data'];
                
                $respons_detail = $client->request('GET', "{$url}/detail10/{$id}/show");
                $body_detail = $respons_detail->getBody();
                $detail = json_decode($body_detail, true);
                $datadetail =  $detail['data'];

                return view('user.editdetail', compact('dataagama', 'datadetail'));
            } else {
                return redirect('/')->with('error_message', 'Fitur tidak dapat diakses, pengguna belum aktif!');
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
        $validator = Validator::make($request->all(), [
            'tempat_lahir' => 'required|string|max:150',
            'tanggal_lahir' => 'required',
            'agama' => 'required',
            'alamat' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect('/detail10')->with('success_message', 'Detail data gagal diubah!');
        }

        $tgl = new DateTime("$request->tanggal_lahir");
        $tgl_now = new DateTime('today');
        $umur = $tgl->diff($tgl_now)->y;

        //foto ktp
        $foto = $request->file('foto_ktp');
        $namafoto = null;
        if ($foto != null) {
            $folder = 'photo';
            $extension = $foto->getClientOriginalExtension();
            $namafoto = Str::uuid().".".$extension;
            $foto->move($folder, $namafoto);
        }

        $client = new Client;
        $url = "http://localhost/laravel-sispro/public/api";
        $response = $client->request('POST', "{$url}/detail10/{$request->id}/edit", [
            'json' => [
                'id' => $request->id,
                'user_id' => Auth::user()->id,
                'alamat' => $request->alamat,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'agama' => $request->agama,
                'umur' => $umur,
                'foto_ktp' => $namafoto
            ]
        ]);
        $body = $response->getBody();
        $detail = json_decode($body, true);
        $data =  $detail['success'];
        if ($response != true) {
            return redirect('/detail10')->with('success_message', 'Detail data gagal diubah!');
        }
        return redirect('/detail10')->with('success_message', 'Detail data berhasil diubah!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy10(Request $request, $id)
    {
        if (Auth::check()) {
            if (Auth::user()->is_active == 1) {
                
                $client = new Client;
                $url = "http://localhost/laravel-sispro/public/api";
                $response = $client->request('DELETE', "{$url}/detail10/{$request->id}");
                $body = $response->getBody();
                $detail = json_decode($body, true);
                $data =  $detail['success'];
                if ($response != true) {
                    return redirect('/detail10')->with('success_message', 'Detail data gagal diubah!');
                }
                return redirect('/detail10')->with('success_message', 'Detail data berhasil dihapus!');

            } else {
                return redirect('/');
            }
        } else {
            return redirect('/');
        }

    }
}
