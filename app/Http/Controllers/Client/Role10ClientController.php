<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use GuzzleHttp\Client;


class Role10ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login10()
    {
        if (Auth::check()) {
            if (Auth::user()->role == 'Admin') {
                return view('admin.dashadmin');
            } else {
                return view('user.dashuser');
            }
        } else {
            return view('role.login10');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register10()
    {
        if (Auth::check()) {
            if (Auth::user()->role == 'Admin') {
                return view('admin.dashadmin');
            } else {
                return view('user.dashuser');
            }
        }
        return view('role.register10');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function prosesregister10(Request $request)
    {
        $client = new Client;
        $url = "http://localhost/laravel-sispro/public/api";
        $response = $client->request('POST', "{$url}/register10", [
            'json' => [
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password
            ]
        ]);
        $body = $response->getBody();
        $user = json_decode($body, true);
        $data =  $user['success'];
        if ($response != true) {
            return back()->with('success_message', 'Registrasi gagal!');
        }
        return redirect('/login10')->with('success_message', 'Registrasi berhasil!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function proseslogin10(Request $request)
    {
        $request->validate([
            'email' => 'required|string|max:150|email',
            'password' => 'required|string|min:8'
        ]);

        $data = auth()->attempt([
            'email' => $request->email,
            'password' => $request->password
        ]);

        if ($data) {
            $request->session()->regenerate();
            if (Auth::user()->role == 'Admin') {
                return view('admin.dashadmin');
            } else {
                return view('user.dashuser');
            }
        } else {
            return back()->with('error_message', 'Login gagal! Silakan cek email atau password.');
        }   

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function profil10()
    {
        if (Auth::check()) {
            if (Auth::user()->role == 'Admin') {
                return view('admin.profil');
            } else {
                if (Auth::user()->is_active == 1) {
                    return view('user.profil');
                } else {
                    return redirect('/')->with('error_message', 'Fitur tidak dapat diakses, pengguna belum aktif!');
                }
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
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function logout10()
    {
        if (Auth::check()) {
            Auth::logout();
        }
        return redirect('/');
    }

    public function editPass10()
    {
        if (Auth::check()) {
            if (Auth::user()->is_active == 1) {
                return view('role.password');
            } else {
                return redirect('/')->with('error_message', 'Fitur tidak dapat diakses, pengguna belum aktif!');
            }
        } else {
            return redirect('/')->with('error_message', 'Silakan login kembali!');
        }
    }

    public function updatePass10(Request $request) {
        if (Auth::check()) {
            if (Auth::user()->is_active == 1) {
                $request->validate([
                    'pass_baru' => 'required',
                    'pass_confirm' => 'required'
                ]);
                if ($request->pass_baru == $request->pass_confirm) {
                    $client = new Client;
                    $url = "http://localhost/laravel-sispro/public/api";
                    $response = $client->request('POST', "{$url}/password10", [
                        'json' => [
                            'id' => Auth::user()->id,
                            'pass_baru' => $request->pass_baru
                        ]
                    ]);
                    $body = $response->getBody();
                    $user = json_decode($body, true);
                    $data =  $user['success'];
                    if ($response != true) {
                        return back()->with('success_message', 'Password gagal diubah!');
                    }
                    return redirect('/profil10/')->with('success_message', 'Password berhasil diubah!');
                } else {
                    return redirect('/profil10/')->with('error_message', 'Password gagal diubah! Pastikan password dan konfirmasi password sama!');
                }
            } else {
                return redirect('/')->with('error_message', 'Fitur tidak dapat diakses, pengguna belum aktif!');
            }
        } else {
            return redirect('/')->with('error_message', 'Silakan login kembali!');
        }
    }

    public function editfoto10()
    {
        if (Auth::check()) {
            if (Auth::user()->is_active == 1) {
                return view('role.profil');
            } else {
                return redirect('/')->with('error_message', 'Fitur tidak dapat diakses, pengguna belum aktif!');
            }
        } else {
            return redirect('/')->with('error_message', 'Silakan login kembali!');
        }
    }

    public function updatefoto10(Request $request) {
        if (Auth::check()) {
            if (Auth::user()->is_active == 1) {
                $request->validate([
                    'uploadfoto' => 'required'
                ]);
                $foto = $request->file('uploadfoto');
                $folder = 'photo';
                $extension = $foto->getClientOriginalExtension();
                $namafoto = Str::uuid().".".$extension;
                $foto->move($folder, $namafoto);
                
                $client = new Client;
                $url = "http://localhost/laravel-sispro/public/api";
                $response = $client->request('POST', "{$url}/foto10", [
                    'json' => [
                        'id' => Auth::user()->id,
                        'namafoto' => $namafoto
                    ]
                ]);
                $body = $response->getBody();
                $user = json_decode($body, true);
                $data =  $user['success'];
                if ($response != true) {
                    return redirect('/profil10')->with('success_message', 'Foto profil gagal diubah!');
                }
                return redirect('/profil10')->with('success_message', 'Foto profil berhasil diubah!');
            } else {
                return redirect('/')->with('error_message', 'Fitur tidak dapat diakses, pengguna belum aktif!');
            }
        } else {
            return redirect('/')->with('error_message', 'Silakan login kembali!');
        }
    }
}
