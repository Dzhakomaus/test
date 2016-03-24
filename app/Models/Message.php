<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Message extends Model
{
    protected $table = 'message';

    protected $guarded = ['password'];

    /**
     * Использовал paginate, вернет $count_mes_page количество сообщений
     *
     * @param $count_mes_page
     * @return mixed
     */
    public static function getMessages($count_mes_page)
    {
        return DB::table('message')
            ->join('users', 'message.user', '=', 'users.id')
            ->select('users.name', 'message.*')
            ->paginate($count_mes_page);
    }

    /**
     * @param $user
     * @param $request
     */
    public static function addNewMessage($user, $request)
    {
        Message::create([
            'user' => $user->id,
            'description' => $request->text
        ]);
    }

    /**
     * @param $user
     * @return mixed
     */
    public static function userMessages($user)
    {
        return DB::table('message')
            ->join('users', 'message.user', '=', 'users.id')
            ->select('users.name', 'message.*')
            ->where('message.user', '=', $user->id)
            ->get();
    }

    /**
     * @param $request
     * @return mixed
     */
    public static function filterMessages($request)
    {
        return Message::where('description', 'LIKE', '%' . $request->filterText . '%')
            ->orWhere('created_at', 'LIKE', '%' . $request->filterText . '%')
            ->get();
    }

}
