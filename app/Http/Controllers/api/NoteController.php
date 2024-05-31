<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function store(Request $request){
        $validate = $request->validate([
            'title' => 'required',
            'note'  => 'required'
        ]);
        $validate['user_id'] = $request->user()->id;

        $result = note::create($validate);
        if($result){
            return response()->json([
                'message' => 'Berhasil disimpan'
            ],201);
        }else{
            return response()->json([
                'message' => 'Gagal disimpan'
            ],200);
        }
     }
}
