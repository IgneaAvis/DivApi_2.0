<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends BaseController
{
    public $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * @OA\Post(
     *     path="/api/v1/register",
     *     summary="Регистрация",
     *     tags={"Авторизация"},
     *     @OA\Parameter(
     *          in="query",
     *          name="name",
     *          description="Имя пользователя",
     *          example="User"
     *     ),
     *     @OA\Parameter(
     *          in="query",
     *          name="email",
     *          description="Email пользователя",
     *          example="test@email.com"
     *     ),
     *     @OA\Parameter(
     *          in="query",
     *          name="password",
     *          description="Пароль пользователя",
     *          example="password"
     *     ),
     *     @OA\Response(
     *          response=201,
     *          description="successful operation"
     *     ),
     *     @OA\Response(
     *          response=401,
     *          description="Invalid data"
     *     )
     * )
     */

    public function register(Request $request)
    {
        return $this->authService->register($request->all());
    }

    /**
     * @OA\Post(
     *     path="/api/v1/login",
     *     summary="Авторизация",
     *     tags={"Авторизация"},
     *     @OA\Parameter(
     *          in="query",
     *          name="email",
     *          description="Email пользователя",
     *          example="test@email.com"
     *     ),
     *     @OA\Parameter(
     *          in="query",
     *          name="password",
     *          description="Пароль пользователя",
     *          example="password"
     *     ),
     *     @OA\Response(
     *          response=201,
     *          description="successful operation"
     *     ),
     *     @OA\Response(
     *          response=401,
     *          description="Invalid data"
     *     )
     * )
     */

    public function login(Request $request)
    {
        return $this->authService->login($request->all());
    }

}
