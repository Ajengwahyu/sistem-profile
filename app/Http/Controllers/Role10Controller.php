<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Role10Controller extends Controller
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
                return view('admin.agama.agama10');
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
    public function create10()
    {
        return view('role.register10');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store10(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:150',
            'email' => 'required|string|max:150|email|unique:users',
            'password' => 'required|string|min:8'
        ]);

        $datauser = new User();
        $datauser->name = $request->name;
        $datauser->email = $request->email;
        $datauser->password = Hash::make($request->password);
        $datauser->save();

        return redirect('/login10')->with('success_message', 'Registrasi berhasil!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show10(Request $request)
    {
        $request->validate([
            'email' => 'required|string|max:150|email',
            'password' => 'required|string|min:8'
        ]);

        $result = auth()->attempt([
            'email' => $request->email,
            'password' => $request->password
        ]);

        if ($result) {
            $request->session()->regenerate();
            if (Auth::user()->role == 'Admin') {
                return view('admin.agama.agama10');
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
    public function edit10($id)
    {
        if (Auth::check()) {
            if (Auth::user()->role == 'Admin') {
                return view('role.profil');
            } else {
                if (Auth::user()->is_active == 1) {
                    return view('role.profil');
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
        if (Auth::check()) {
            Auth::logout();
        }
        return redirect('/');
    }

    public function Password10() {
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

    public function editPas10(Request $request) {
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

    public function update_Pass10(Request $request) {
        if (Auth::check()) {
            if (Auth::user()->is_active == 1) {
                $request->validate([
                    'pass_baru' => 'required',
                    'pass_confirm' => 'required'
                ]);
                if ($request->pass_baru == $request->pass_confirm) {
                    $datauser = User::find(Auth::user()->id);
                    $datauser->password = Hash::make($request->pass_baru);
                    $datauser->save();
                    return redirect('/profil10'.Auth::user()->id)->with('success_message', 'Password berhasil diubah!');
                } else {
                    return redirect('/profil10/'.Auth::user()->id)->with('error_message', 'Password gagal diubah! Pastikan password dan konfirmasi password sama!');
                }
            } else {
                return redirect('/')->with('error_message', 'Fitur tidak dapat diakses, pengguna belum aktif!');
            }
        } else {
            return redirect('/')->with('error_message', 'Silakan login kembali!');
        }
    }


    public function Foto10() {
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

    public function update_foto10(Request $request) {
        if (Auth::check()) {
            if (Auth::user()->is_active == 1) {
                $request->validate([
                    'uploadfoto' => 'required'
                ]);
                $datauser = User::find(Auth::user()->id);
                $foto = $request->file('uploadfoto');
                $folder = 'photo';
                $extension = $foto->getClientOriginalExtension();
                $namafoto = Str::uuid().".".$extension;
                $foto->move($folder, $namafoto);
                $datauser->photo = $namafoto;
                $datauser->save();
                return redirect('/profil10/'.Auth::user()->id)->with('success_message', 'Foto profil berhasil diubah!');
            } else {
                return redirect('/')->with('error_message', 'Fitur tidak dapat diakses, pengguna belum aktif!');
            }
        } else {
            return redirect('/')->with('error_message', 'Silakan login kembali!');
        }
    

    }
}
