<?php

namespace App\Http\Controllers\Front\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if($request->isMethod('POST')) {
            return $request->all();
        }

        return view('front/auth/signin');
    }

}
