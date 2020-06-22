<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SignOut extends Controller
{
    public function entry()
    {
        auth()->logout();        
    }
}
