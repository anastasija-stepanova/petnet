<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAuthRequest;
use App\Models\MyUser;
use App\Models\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function auth(UserAuthRequest $request): string
    {
        $request->validated();

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
        $now = new \DateTime();
        if ($userToken) {
            $userToken->updateOrFail([
                'expired_date' => $now->add($tokenLifeTime),
                'token' => $token,
            ]);
        } else {
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
