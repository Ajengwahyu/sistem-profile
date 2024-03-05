<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DetailData10;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class Admin10Controller extends Controller
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
                $datadetail = DB::table('detail_data10s')
                        ->join('users', function ($join) {
                            $join->on('detail_data10s.user_id', '=', 'users.id');
                            })
                        ->select(
                            DB::raw('detail_data10s.id AS id'), 
                            DB::raw('users.name AS name'), 
                            DB::raw('users.email AS email'), 
                            DB::raw('users.is_active AS status'), 
                            DB::raw('users.foto AS foto'),
                            DB::raw('detail_data10s.tempat_lahir AS tempat_lahir'), 
                            DB::raw('detail_data10s.umur AS umur'))
                        ->get();
                return view('admin.detaildata', compact('datadetail'));
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
                $datauser = User::where('role', '=', 'User')->get();
                return view('admin.status', compact('datauser'));
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
        if (Auth::check()) {
            if (Auth::user()->role == 'Admin') {
                $status = User::where('id', '=', $request->id)->value('is_active');;
                $datauser = User::find($request->id);
                if ($status == 1) {
                    $datauser->is_active = 0;
                    $datauser->save();
                } else {
                    $datauser->is_active = 1;
                    $datauser->save();
                }

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
    public function show($id)
    {
        if (Auth::check()) {
            if (Auth::user()->role == 'Admin') {
                $datadetail = DB::table('detail_data10s')
                        ->leftJoin('users', 'detail_data10s.user_id', '=', 'users.id')
                        ->leftJoin('agama10s', 'detail_data10s.agama_id', '=', 'agama10s.id')
                        ->where('detail_data10s.id', '=', $id)
                        ->select(
                            DB::raw('detail_data10s.id AS id'), 
                            DB::raw('users.name AS name'), 
                            DB::raw('users.email AS email'), 
                            DB::raw('users.is_active AS status'), 
                            DB::raw('users.foto AS foto'),
                            DB::raw('detail_data10s.alamat AS alamat'),
                            DB::raw('detail_data10s.tempat_lahir AS tempat_lahir'), 
                            DB::raw('detail_data10s.tanggal_lahir AS tanggal_lahir'), 
                            DB::raw('agama10s.namaagama AS agama'),
                            DB::raw('detail_data10s.foto_ktp AS ktp'),
                            DB::raw('detail_data10s.umur AS umur'))
                        ->get()->first();
                return view('admin.datadetail', compact('datadetail'));
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
    public function edit($id)
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
