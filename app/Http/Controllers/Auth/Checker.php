<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Checker extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api']);
    }

    public function check(Request $request)
    {
        return $request->user();
    }
}
