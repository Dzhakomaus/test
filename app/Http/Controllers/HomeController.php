<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Tymon\JWTAuth\Facades\JWTAuth;

class HomeController extends Controller
{
    public function getUser()
    {
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);

        $user->hasRole('admin');   // ������ true ���� ������������ admin ���� ����� � manager

        return response()->json([
            'data' => [
                'name' => $user->name,
                'email' => $user->email,
                'registered_at' => $user->created_at->toDateTimeString()
            ]
        ]);

    }
}
