<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use App\User;
class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    public function resetPassword(Request $request)
	{
		$user = User::where('email', '=', $request->credential)->first();
		if($user)
		{
			$response = $this->broker()->sendResetLink(["email" => $user->email]);
            
            return $response == Password::RESET_LINK_SENT
                    ? $this->sendResetResponse($request, $response)
                    : $this->sendResetFailedResponse($request, $response);
		}		
		return response()->json([
            "status" => "error",
            "message" => "user tidak ada"
        ], 404);
	}

    protected function sendResetResponse(Request $request, $response)
    {
        return response()->json([
            'status' => 'success',
            "message" => trans($response)
        ], 200);
    }

    protected function sendResetFailedResponse(Request $request, $response)
    {
        return response()->json([
            'status' => 'error',
            "message" => trans($response),
        ], 422);
    }
}
