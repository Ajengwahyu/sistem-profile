<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\ApiFormat; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class Role10ApiController extends Controller
{
    public function store10(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:150',
            'email' => 'required|string|max:150|email|unique:users',
            'password' => 'required|string|min:8'
        ]);
        if ($validator->fails()) {
            return new ApiFormat(false, 'Validasi gagal', $validator->errors()->all());
        }

        $datauser = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        if (!$datauser) {
            return new ApiFormat(true, 'Registrasi gagal!', $datauser);
        }
        return new ApiFormat(true, 'Registrasi berhasil!', $datauser );

    }

    public function update_Pass10(Request $request)
    {
        $datauser = User::find($request->id);
        $datauser->password = Hash::make($request->pass_baru);
        $datauser->save();
        return new ApiFormat(true, 'Password berhasil diubah!', $datauser);

    }
    public function update_Foto10(Request $request) {
        $datauser = User::find($request->id);
        if (!$datauser) {
            return new ApiFormat(false, 'Pengguna tidak ditemukan!', null);
        }

        $datauser->foto = $request->namafoto;
        $datauser->save();
        return new ApiFormat(true, 'Foto profil berhasil diubah!', $datauser);
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
}
