<?php

namespace App\Services;

use App\Models\User;
use App\Services\Common\AuthServiceInterface;
//use Illuminate\Support\Facades\Auth;
use Auth;
use Illuminate\Support\Facades\Validator;

class AuthService implements AuthServiceInterface
{


    public function register(array $items)
    {
        $attr = Validator::make($items, [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ]);
        if ($attr->failed()) {
            return response()->json($attr->messages(),400);
        }
        $valid = $attr->validated();
        $user = User::create([
            'name' => $valid['name'],
            'password' => bcrypt($valid['password']),
            'email' => $valid['email']
        ]);
        return response()->json([
            'token' => $user->createToken('api_token')->plainTextToken
        ], 201);
    }

    public function login(array $items)
    {
        $attr = Validator::make($items, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        if ($attr->failed()) {
            return response()->json($attr->messages(), 400);
        }
        if (!Auth::attempt($attr->validated())) {
            return response()->json('Данные не совпадают', 401);
        }

        return response()->json([
            'token' => auth()->user()->createToken('api_token')->plainTextToken
        ], 201);
    }
}
