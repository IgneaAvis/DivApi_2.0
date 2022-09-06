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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|min:6'
        ])->validated();
        $user = User::create([
            'name' => $attr['name'],
            'password' => bcrypt($attr['password']),
            'email' => $attr['email']
        ]);
        return response()->json([
            'token' => $user->createToken('tokens')->plainTextToken
        ]);
    }

    public function login(array $items)
    {
        $attr = Validator::make($items, [
            'email' => 'required|string|email|',
            'password' => 'required|string|min:6'
        ])->validated();

        if (!Auth::attempt($attr)) {
            return response()->json('Данные не совпадают', 401);
        }

        return response()->json([
            'token' => auth()->user()->createToken('API Token')->plainTextToken
        ]);
    }
}
