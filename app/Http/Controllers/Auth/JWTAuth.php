<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JWTAuth extends Controller
{
    public function signIn(Request $request)
    {
        $token = auth()->attempt($request->only('email','password'));

        if(!$token)
        {
            return response(null, 401);
        }

        return response()->json(compact('token'));
    }

    public function signOut()
    {
        auth()->logout();
    }
}
