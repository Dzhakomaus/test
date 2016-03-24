<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use  EntrustUserTrait;

    protected $guarded = ['password', 'remember_token'];

    /**
     * метод возвращает нового пользователя
     *
     * @param $request
     * @return \Illuminate\Http\JsonResponse|static
     */
    public static function createUser($request)
    {
        $credentials = $request->only('name', 'email', 'password');
        $credentials['password'] = Hash::make($credentials['password']);

        try {
            $user = User::create($credentials);
        } catch (Exception $e) {
            return response()->json(['error' => 'User already exists.'], 500);
        }

        // устанавливаем роль пользователя как user
        $user->attachRole(config('app.role.USER'));
        return $user;
    }

}
