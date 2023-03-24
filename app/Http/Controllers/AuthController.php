<?php

namespace App\Http\Controllers;

use App\Models\MyUser;
use App\Models\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function auth(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $user = MyUser::where('email', $request->email)->first();
        $isCheckedPassword = Hash::check($request->password, $user->password);
        if (!$user && $isCheckedPassword) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }

        $token = Auth::login($user);
        $tokenLifeTime = \DateInterval::createFromDateString('10 minutes');
        $userToken = Token::where('user_id', $user->id)->first();
        if ($userToken) {
            $tokenExpiredDate = new \DateTime($userToken->expired_date);
            $userToken->updateOrFail([
                'expired_date' => $tokenExpiredDate->add($tokenLifeTime),
            ]);
        } else {
            $now = new \DateTime();
            Token::create([
                'user_id' => $user->id,
                'token' => $token,
                'expired_date' => $now->add($tokenLifeTime),
            ]);
        }

        return response()->json([
            'status' => 'success',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }
}
