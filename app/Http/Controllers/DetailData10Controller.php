<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use App\Models\Agama10;
use App\Models\DetailData10;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class DetailData10Controller extends Controller
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
                $detaildata = DB::table('detail_data10s')
                    ->join('agama10s', function ($join) {
                        $join->on('detail_data10s.agama_id', '=', 'agama10s.id')
                            ->where('detail_data10s.user_id', '=', Auth::user()->id);
                    })
                    ->select('detail_data10s.*', DB::raw('agama10s.namaagama AS agama'))
                    ->get()->first();
                if ($detaildata == null) {
                    $status = 0;
                } else {
                    $status = 1;
                }
                return view('user.index', compact('status', 'detaildata'));
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
                $dataagama = Agama::all();
                return view('user.adddetail', compact('dataagama'));
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
        if (Auth::check()) {
            if (Auth::user()->is_active == 1) {
                $request->validate([
                    'tempat_lahir' => 'required|string|max:150',
                    'tanggal_lahir' => 'required',
                    'agama' => 'required',
                    'alamat' => 'required',
                    'foto_ktp' => 'required'
                ]);

                $tgl = new DateTime("$request->tanggal_lahir");
                $tgl_now = new DateTime('today');
                $umur = $tgl->diff($tgl_now)->y;

                //foto ktp
                $foto = $request->file('foto_ktp');
                $folder = 'photo';
                $extension = $foto->getClientOriginalExtension();
                $namafoto = Str::uuid().".".$extension;
                $foto->move($folder, $namafoto);

                $detaildata = new DetailData10();
                $detaildata->user_id = Auth::user()->id;
                $detaildata->alamat = $request->alamat;
                $detaildata->tempat_lahir = $request->tempat_lahir;
                $detaildata->tanggal_lahir = $request->tanggal_lahir;
                $detaildata->agama_id = $request->agama;
                $detaildata->foto_ktp = $namafoto;
                $detaildata->umur = $umur;
                $detaildata->save();

                return redirect('/detail10')->with('success_message', 'Detail data berhasil ditambahkan!');
            } else {
                return redirect('/')->with('error_message', 'Fitur tidak dapat diakses, pengguna belum aktif!');
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
    public function show($id)
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
                $dataagama = Agama10::all();
                $detaildata = DetailData10::where('id', '=', $id)->first();
                return view('user.editdetail', compact('dataagama', 'detaildata'));
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
        if (Auth::check()) {
            if (Auth::user()->is_active == 1) {
                $request->validate([
                    'tempat_lahir' => 'required|string|max:150',
                    'tanggal_lahir' => 'required',
                    'agama' => 'required',
                    'alamat' => 'required'
                ]);

                //count age
                $tgl = new DateTime("$request->birthdate");
                $tgl_now = new DateTime('today');
                $umur = $tgl->diff($now)->y;

                //foto ktp
                $foto = $request->file('foto-ktp');
                if ($foto != null) {
                    $folder = 'photo';
                    $extension = $foto->getClientOriginalExtension();
                    $namafoto = Str::uuid().".".$extension;
                    $foto->move($folder, $namafoto);
                }

                $detail = DetailData10::find($request->id);
                $detail->user_id = Auth::user()->id;
                $detail->alamat = $request->alamat;
                $detail->tempat_lahir = $request->tempat_lahir;
                $detail->tanggal_lahir = $request->tanggal_lahir;
                $detail->agama_id = $request->agama;
                $detail->umur = $umur;
                if ($foto != null) {
                    $detail->foto_ktp = $namafoto;
                }
                $detail->save();

                return redirect('/detail10')->with('success_message', 'Detail data berhasil diubah!');
            } else {
                return redirect('/')->with('error_message', 'Fitur tidak dapat diakses, pengguna belum aktif!');
            }
        } else {
            return redirect('/')->with('error_message', 'Silakan login kembali!');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if (Auth::check()) {
            if (Auth::user()->is_active == 1) {
                
                $detaildata = DetailData10::find($request->id);
                $detaildata->delete();
        
                return redirect('/detail10')->with('success_message', 'Detail data berhasil dihapus!');

            } else {
                return redirect('/');
            }
        } else {
            return redirect('/');
        }

    }
}
