<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $fields = $request->all();
        $errors = Validator::make($fields, [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($errors->fails()) {
            return response($errors->errors()->all(), 422);
        }

        User::create([
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
            'isValidEmail' => User::IS_INVALID_EMAIL,
            'remember_token' => $this->generateRememberToken(),
        ]);

        return response(['message' => 'user created'], 200);
    }

    public function generateRememberToken(): string
    {
        $code = Str::random(10) . time();
        return $code;
    }
}
