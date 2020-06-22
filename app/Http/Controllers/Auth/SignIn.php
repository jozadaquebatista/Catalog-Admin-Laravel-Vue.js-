<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SignIn extends Controller
{
    public function entry(Request $request)
    {
        $token = auth()->attempt($request->only('email','password'));

        if(!$token)
        {
            return response(null, 401);
        }

        return response()->json(compact('token'));
    }
}
