<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function authenticate(Request $request){
        $credentials    = $request->validate([
            'email'     => ['required','email'],
            'password'  => ['required']
        ]);

        $user = User::where('name', $request->name)->first();

        if(Auth::attempt($credentials)){

            $user   = Auth::user();

            $success['token']   = $user->createToken('auth_token')->plainTextToken;
            $success['name']    = Auth::user()->name;
            $success['data']    = $user;

            return response()->json([
                'success'   => true,
                'message'   => 'Berhasil login',
                'data'     => $success
            ],200);
        }else{
            return response()->json([
                'success'   => false,
                'message'   => 'Gagal Login',
            ],401);
        }
    }

    public function updateProfile(Request $request){
        $request->validate([
            "image_url"     => 'required|image|mimes:jpeg,png,jpg|max:2048',
            "face_embedded" => 'required'
        ]);

        $image  = $request->file("image_url");
        $data["face_embedded"] = $request->face_embedded;

        $image->storeAs("public/images",$image->hashName());
        $data["image_url"] = $image->hashName();
        $result = User::where('id',$request->user()->id)->update($data);

        if($result){
            return response()->json([
                'message' => 'Berhasil Upload Foto'
            ],200);
        }else{
            return response()->json([
                'message' => 'Gagal Upload Foto'
            ],200);
        }

    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Berhasil logout'
        ],200);
    }
}
