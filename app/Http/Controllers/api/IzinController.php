<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\izin;
use Illuminate\Http\Request;

class IzinController extends Controller
{
    public function createIzin(Request $request){
        $data = $request->validate([
            'date_permission'   => 'required',
            'reason'            => 'required'
        ]);

        if($request->hasFile('image')){
            $image          = $request->file('image');
            $image->storeAs('public/permissions',$image->hashName());
            $data['image']  = $image->hashName();
        }
        $data['user_id']    = $request->user()->id;
        $data['is_approval'] = "0";

        $result = izin::create($data);
        if($result){
            return response()->json([
                'message' => 'Berhasil dibuat'
            ],201);
        }else{
            return response()->json([
                'message' => 'Gagal dibuat'
            ],200);
        }
    }
}
