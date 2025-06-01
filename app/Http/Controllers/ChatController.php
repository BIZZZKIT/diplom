<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Chat;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ChatController extends Controller
{
    public function index()
    {
        $chats = Chat::with(['userOne', 'userTwo'])->where(function ($query) {
            $query->where('user_one_id', auth()->id())
                ->orWhere('user_two_id', auth()->id());
        })->get();

        return view('components.chat', compact('chats'));
    }
    public function startChat(Request $request)
    {
        $userOneId = auth()->id();
        $userTwoId = $request->input('user_id');
        if ($userOneId == $userTwoId) {
            return response()->json(['success' => false, 'message' => 'Нельзя писать самому себе']);
        }

        $chat = Chat::where(function ($query) use ($userOneId, $userTwoId) {
            $query->where('user_one_id', $userOneId)->where('user_two_id', $userTwoId);
        })->orWhere(function ($query) use ($userOneId, $userTwoId) {
            $query->where('user_one_id', $userTwoId)->where('user_two_id', $userOneId);
        })->first();

        if (!$chat) {
            $chat = Chat::create([
                'user_one_id' => $userOneId,
                'user_two_id' => $userTwoId
            ]);
        }

        $companion = $chat->user_one_id === $userOneId
            ? $chat->userTwo
            : $chat->userOne;

        return response()->json([
            'success' => true,
            'chat_id' => $chat->id,
            'companion_name' => $companion->FIO ?? 'Пользователь'
        ]);
    }


    public function getMessages(Chat $chat)
    {
        try {
            $messages = $chat->messages()->with('sender')->get();

            $messages->each(function ($msg) {
                $msg->message = Crypt::decryptString($msg->message);
            });

            return response()->json($messages);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    public function sendMessage(Request $request)
    {
        $request->validate([
            'chat_id' => 'required|exists:chats,id',
            'message' => 'required|string'
        ]);

        $encryptedMessage = Crypt::encryptString($request->message);

        $message = Message::create([
            'chat_id' => $request->chat_id,
            'sender_id' => auth()->id(),
            'message' => $encryptedMessage,
        ]);

        $message->load('sender');

        $message->message = $request->message;

        broadcast(new MessageSent($message))->toOthers();

        return response()->json([
            'success' => true,
            'message' => $request->message
        ]);
    }
}
