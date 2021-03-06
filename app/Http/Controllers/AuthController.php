<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\HasApiTokens;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'company' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'password' => 'required|string|min:8'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'company' => $request->company,
            'phone' => $request->phone,
            'type' => 'app',
            'password' => Hash::make($request->password)
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()
            ->json(['data' => $user,'access_token' => $token, 'token_type' => 'Bearer', ]);
    }

    public function login(Request $request)
    {
        $tempUser = User::where('email', $request['email'])->first();

        if($tempUser['type'] === 'admin') {

            if (!Auth::attempt($request->only('email', 'password'))) {
                return response()
                    ->json(['message' => 'Unauthorized'], 401);
            }

            $user = User::where('email', $request['email'])->firstOrFail();

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()
                ->json(['message' => 'Hi '.$user->name.', welcome to home','access_token' => $token, 'token_type' => 'Bearer', ]);
        } else {
            return response()
                ->json(['message' => 'Unauthorized'], 401);
        }
    }

    public function loginApp(Request $request)
    {
        $tempUser = User::where('email', $request['email'])->first();

        if(!empty($tempUser)) {
            if($tempUser->type !== 'admin') {
                if (!Auth::attempt($request->only('email', 'password'))) {
                    return response()
                        ->json(['message' => 'Unauthorized'], 401);
                }

                $user = User::where('email', $request['email'])->firstOrFail();

                $token = $user->createToken('auth_token')->plainTextToken;

                return response()
                    ->json(['message' => 'Hi '.$user->name.', welcome to home','access_token' => $token, 'token_type' => 'Bearer', ]);
            } else {
                return response()
                    ->json(['message' => 'Het is niet mogelijk om met een admin account in te loggen op de app.'], 401);
            }
        } else {
            return response()
                ->json(['message' => 'Unauthorized'], 401);
        }

    }

    // method for user logout and delete token
    public function logout()
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'You have successfully logged out and the token was successfully deleted'
        ];
    }
}
