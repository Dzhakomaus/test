<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;

use App\Http\Requests;
use Tymon\JWTAuth\Facades\JWTAuth;

class HomeController extends Controller
{

    private $count_mes_page = 5;

    public function getMessages()
    {
        $messages = Message::paginate($this->count_mes_page);
        return response()->json($messages);
    }

    public function setMessage(Request $request)
    {
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);

        $this->validate($request, [
            'text' => 'required|min:3|max:255',
        ]);

        Message::create([
            'id_user' => $user->id,
            'name_user' => $user->name,
            'date' => date('H:i d-m-Y'),
            'text' => $request->text
        ]);

        $messages = Message::paginate($this->count_mes_page);
        return response()->json($messages);

    }

    public function myMessages()
    {
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);

        $result = Message::where('id_user', '=', $user->id)->get();
        return response()->json($result);
    }

}
