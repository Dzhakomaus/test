<?php

namespace App\Http\Controllers;
use Validator;
use App\User;
use Exception;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Hash;

use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;


class AuthenticateController extends Controller
{

    const ADMIN = 1;
    const MANAGER = 2;
    const USER = 3;

    public function __construct()
    {
        // Apply the jwt.auth middleware to all methods in this controller
        // except for the authenticate method. We don't want to prevent
        // the user from retrieving their token if they don't already have it
        //$this->middleware('jwt.auth', ['except' => ['signup','authenticate']]);
    }

    public function index()
    {

    }

    // регистрация пользователя 
    public function signup(Request $request)
    {
        $credentials = $request->only('name','email', 'password');
        $credentials['password'] = Hash::make($credentials['password']);

        $this->validate($request, [
            'name' => 'required|min:3|max:40',
            'email' => 'required|email|min:5|max:40',
            'password' => 'required|min:5|max:40',
        ]);

        try {
            $user = User::create($credentials);
        } catch (Exception $e) {
            return response()->json(['error' => 'User already exists.'], 500);
        }

        $user->attachRole(AuthenticateController::USER);

        $token = JWTAuth::fromUser($user);

        return response()->json(compact('token'));
    }

    // аутентификация пользователя
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $this->validate($request, [
            'email' => 'required|email|min:5|max:40',
            'password' => 'required|min:5|max:40',
        ]);

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
