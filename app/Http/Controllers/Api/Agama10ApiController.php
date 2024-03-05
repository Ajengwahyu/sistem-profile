<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use App\Models\Agama10;
use App\Http\Resources\ApiFormat;
use Illuminate\Support\Facades\Validator;



class Agama10ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index10()
    {
        $dataagama = Agama10::all();
        return new ApiFormat(true, 'Daftar Agama', $dataagama);
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
        $validator = Validator::make($request->all(), [
            'namaagama' => 'required|string',
        ]);
        if ($validator->fails()) {
            return new ApiFormat(false, 'Validasi gagal', $validator->errors()->all());
        }

        $dataagama = Agama10::create([
            'namaagama' => $request->namaagama
        ]);
        if (!$dataagama) {
            return new ApiFormat(true, 'Agama gagal ditambahkan!', $dataagama);
        }
        return new ApiFormat(true, 'Agama berhasil ditambahkan!', $dataagama);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show10($id)
    {
        $dataagama = Agama10::find($id);
        if (!$dataagama) {
            return new ApiFormat(false, 'Agama tidak ditemukan!', null);
        }
        return new ApiFormat(true, 'Berhasil mendapatkan data agama!', $dataagama);

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
        $dataagama = Agama10::find($request->id);
        if (!$dataagama) {
            return new ApiFormat(false, 'Agama tidak ditemukan!', null);
        }

        $validator = Validator::make($request->all(), [
            'namaagama' => 'required|string|max:150',
        ]);
        if ($validator->fails()) {
            return new ApiFormat(false, 'Validasi gagal', $validator->errors()->all());
        }

        $dataagama->update([
            'namaagama' => $request->namaagama
        ]);

        return new ApiFormat(true, 'Agama berhasil diubah!', $dataagama);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy10(Request $request)
    {
        $dataagama = Agama10::find($request->id);
        if (!$dataagama) {
            return new ApiFormat(false, 'Agama tidak ditemukan!', null);
        }
        $dataagama->delete();

        return new ApiFormat(true, 'Agama berhasil dihapus!', $dataagama);

    }
}
