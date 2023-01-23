<?php

namespace App\Helpers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthHelper
{
    static function userHasManagementAccess(Request $request)
    {
        $user = self::attemptByUserID($request);        
        if (!$user) {
            $user = self::attempt($request);
        }
        return $user;
    }

    static function attempt(Request $request)
    {
        $user = null;
        if ($request->has('username') && $request->has('password')) {
            $user = User::where('username', $request->username)->orWhere('email', $request->username)->first();
            if (!empty($user->id) && !Hash::check($request->password, $user->password)) {
                $user = null;
            } else {
                Auth::login($user, $request->rememberMe);
            }
        }        
        return $user;
    }

    static function attemptByUserID(Request $request)
    {
        $user = null;
        if ($request->has('user_id')) {
            $user = User::find($request->user_id);
            Auth::login($user);
        }        
        return $user;
    }
}