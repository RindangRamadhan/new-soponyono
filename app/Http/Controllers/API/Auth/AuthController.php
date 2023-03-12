<?php

namespace App\Http\Controllers\API\Auth;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'user_name' => 'required',
            'password' => 'required',
        ]);

        if (!Auth::attempt($request->only(['user_name', 'password']))) {
            return Helper::ResponseWriter('Username or Password does not match with our record', null, 401);
        }

        $user = User::where('user_name', $request->user_name)->first();

        return Helper::ResponseWriter(
            'Log in successfull',
            [
                'user' => [
                    "name" => $user->name,
                    "photo" => ($user->photo != "") ? "https://pratulonline.com/images/upload/$user->photo" : null,
                ],
                '_token' => $user->createToken("API TOKEN")->plainTextToken,
            ],
        );
    }

    public function logout()
    {
        Auth::user()->tokens()->delete();
        return Helper::ResponseWriter('Logged out successfull');
    }
}
