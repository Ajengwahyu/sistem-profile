<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Agama10;
use Illuminate\Http\Request;

class Agama10Controller extends Controller
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
                $dataagama = Agama10::all();
                return view('admin.agama.agama10', compact('dataagama'));
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
        if (Auth::check()) {
            if (Auth::user()->role == 'Admin') {
                
                $request->validate([
                    'namaagama' => 'required|string|max:150',
                ]);
        
                $data = new Agama10();
                $data->namaagama = $request->namaagama;
                $data->save();
        
                return redirect('/agama10')->with('success_message', 'Agama berhasil ditambahkan!');

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit10(Request $request, $id)
    {
        if (Auth::check()) {
            if (Auth::user()->role == 'Admin') {
                $data = Agama10::where('id', '=', $id)->first();
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
        if (Auth::check()) {
            if (Auth::user()->role == 'Admin') {
                
                $request->validate([
                    'namaagama' => 'required|string|max:150',
                ]);
        
                $data = Agama10::find($request->id);
                $data->namaagama = $request->namaagama;
                $data->save();
        
                return redirect('/agama10')->with('success_message', 'Agama berhasil diubah!');

            } else {
                return redirect('/');
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
    public function destroy10(Request $request, $id)
    {
        if (Auth::check()) {
            if (Auth::user()->role == 'Admin') {
                
                $data = Agama10::find($request->id);
                $data->delete();
        
                return redirect('/agama10')->with('success_message', 'Agama berhasil dihapus!');

            } else {
                return redirect('/');
            }
        } else {
            return redirect('/')->with('error_message', 'Silakan login kembali!');
        }

    }
}
