<?php

namespace App\Http\Controllers;

use App\Helpers\AuthHelper;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    function login(Request $request)
    {
        $user = AuthHelper::attempt($request);
        if (!$user) {
            return response()->json(['Incorrect Username or Password.'], 401);
        }
        return $user;
    }
}
