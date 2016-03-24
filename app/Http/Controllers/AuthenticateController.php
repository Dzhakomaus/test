<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthPostRequest;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;


class AuthenticateController extends Controller
{

    /**
     * Регистрация пользователя
     *
     * @param AuthPostRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function signup(AuthPostRequest $request)
    {
        $user = User::createUser($request);
        $token = JWTAuth::fromUser($user);
        return response()->json(compact('token'));
    }

    /**
     * Авторизация пользователя
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        return response()->json(compact('token'));
    }
}