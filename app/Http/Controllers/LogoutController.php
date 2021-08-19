<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class LogoutController extends Controller
{
    public function logout(Request $request)
    {
        Auth::user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Successfully logged out']);
    }
}
