<?php

namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Crypt;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    public function __construct(Message $message)
    {
        $this->message = $message->load('sender');
    }

    public function broadcastOn()
    {
        return new PrivateChannel('chat.' . $this->message->chat_id);
    }

    public function broadcastAs()
    {
        return 'MessageSent';
    }

    public function broadcastWith()
    {
        $decryptedMessage = Crypt::decryptString($this->message->message);

        return [
            'message' => [
                'id' => $this->message->id,
                'chat_id' => $this->message->chat_id,
                'sender' => [
                    'id' => $this->message->sender->id,
                    'name' => $this->message->sender->FIO,
                ],
                'message' => $decryptedMessage,
                'created_at' => $this->message->created_at->toDateTimeString(),
            ]
        ];
    }
}
