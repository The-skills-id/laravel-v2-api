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
use DB;
class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    public function resetPassword(Request $request)
	{
		$user = DB::table('users')
				->where('username', '=', $request->credential)
				->orWhere('email', '=', $request->credential)
				->first();
		
		if($user)
		{
			$response = $this->broker()->sendResetLink(["email" => $user->email]);
            return $response == Password::RESET_LINK_SENT
                    ? $this->sendResetResponse($request, $response)
                    : $this->sendResetFailedResponse($request, $response);
		}		
		return response()->json([
            "message" => "user tidak ada"
        ], 404);
	}

    protected function sendResetResponse(Request $request, $response)
    {
        return response()->json(['success' => ["message" => "Password reset email sent."] ], 200);
    }

    protected function sendResetFailedResponse(Request $request, $response)
    {
        return response()->json(['error' => ["message" => "Password reset failed to send"] ], 422);
    }
}
