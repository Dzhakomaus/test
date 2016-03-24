<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessagePostRequest;
use App\Models\Message;

use App\Http\Requests;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    private $count_mes_page;

    function __construct()
    {
        /** Получам количество сообщений на страничке из конфига */
        $this->count_mes_page = config('app.count_mes_page');
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMessages()
    {
        $result = Message::getMessages($this->count_mes_page);
        return response()->json($result);
    }

    /**
     * @param MessagePostRequest $request
     */
    public function addNewMessage(MessagePostRequest $request)
    {
        Message::addNewMessage($this->getUser(), $request);
        // после добавления нового сообщения обновляем данные для вывода
        return $this->getMessages();
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function userMessage()
    {
        $result = Message::userMessages($this->getUser());
        return response()->json($result);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function filterMessages(Request $request)
    {
        $result = Message::filterMessages($request);
        return response()->json($result);
    }
}
