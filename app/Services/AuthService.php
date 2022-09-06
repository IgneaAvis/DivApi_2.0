<?php

namespace App\Services;

use App\Models\User;
use App\Services\Common\AuthServiceInterface;
use App\Services\Common\ServiceResult;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthService implements AuthServiceInterface
{


    public function register(array $items)
    {
        $validator = Validator::make($items, [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ]);
        if ($validator->failed()) {
            return ServiceResult::createErrorResult('Validation Error', $validator->errors()->toArray());
        }
        $valid = $validator->validated();
        $user = User::create([
            'name' => $valid['name'],
            'password' => Hash::make($valid['password']),
            'email' => $valid['email']
        ]);
        return ServiceResult::createSuccessResult($user->createToken('api_token')->plainTextToken);
    }

    public function login(array $items)
    {
        $validator = Validator::make($items, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        if ($validator->failed()) {
            return ServiceResult::createErrorResult('Validation Error', $validator->errors()->toArray());
        }
        if (!Auth::attempt($validator->validated())) {
            return ServiceResult::createErrorResult('Данные не совпадают');
        }
        return ServiceResult::createSuccessResult(auth()->user()->createToken('api_token')->plainTextToken);
    }
}
