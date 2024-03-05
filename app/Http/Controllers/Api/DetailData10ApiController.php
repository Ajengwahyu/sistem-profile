<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DateTime; 
use App\Models\DetailData10;
use App\Http\Resources\ApiFormat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class DetailData10ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index10($id)
    {
        $this->id = $id;
        $detaildata = DB::table('detail_data10s')
                ->join('agama10s', function ($join) {
                    $join->on('detail_data10s.agama_id', '=', 'agama10s.id')
                        ->where('detail_data10s.user_id', '=', $this->id);
                    })
                ->select('detail_data10s.*', DB::raw('agama10s.namaagama AS agama'))
                ->get()->first();
        if ($detaildata == null) {
            $status = 0;
        } else {
            $status = 1;
        }
        $data = [
            'detail' => $detaildata,
            'status' => $status
        ];
        return new ApiFormat(true, 'Detail Data', $data);

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
        $detaildata = new DetailData10();
        $detaildata->user_id = $request->user_id;
        $detaildata->alamat = $request->alamat;
        $detaildata->tempat_lahir = $request->tempat_lahir;
        $detaildata->tanggal_lahir = $request->tanggal_lahir;
        $detaildata->agama_id = $request->agama;
        $detaildata->foto_ktp = $request->foto_ktp;
        $detaildata->umur = $request->umur;
        $detaildata->save();
        
        return new ApiFormat(true, 'Detail data berhasil ditambahkan!', $detaildata);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show10($id)
    {
        $detaildata = DetailData10::where('id', '=', $id)->first();
        if (!$detaildata) {
            return new ApiFormat(false, 'Detail data tidak ditemukan!', null);
        }
        return new ApiFormat(true, 'Berhasil mendapatkan detail data!', $detaildata);

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
        $detaildata = DetailData10::find($request->id);
        if (!$detaildata) {
            return new ApiFormat(false, 'Detail data tidak ditemukan!', null);
        }
        
        $detaildata->user_id = $request->user_id;
        $detaildata->alamat = $request->alamat;
        $detaildata->tempat_lahir = $request->tempat_lahir;
        $detaildata->tanggal_lahir = $request->tanggal_lahir;
        $detaildata->agama_id = $request->agama;
        $detaildata->umur = $request->umur;
        if ($request->foto_ktp != null) {
            $detaildata->foto_ktp = $request->foto_ktp;
        }
        $detaildata->save();
        
        return new ApiFormat(true, 'Detail data berhasil diubah!', $detaildata);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy10($id)
    {
        $detaildata = DetailData10::find($id);
        if (!$detaildata) {
            return new ApiFormat(false, 'Detail data tidak ditemukan!', null);
        }
        $detaildata->delete();
        return new ApiFormat(true, 'Detail data berhasil dihapus!', $detaildata);

    }
}
