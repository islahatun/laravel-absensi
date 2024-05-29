<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function authenticate(Request $request){
        $credentials    = $request->validate([
            'email'     => ['required','email'],
            'password'  => ['required']
        ]);

        if(Auth::attempt($credentials)){

        }
    }
}
