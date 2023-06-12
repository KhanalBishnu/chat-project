<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FileAddGroupChatEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $sender_id;
    public $groupChat;
    public $src;
    public function __construct($sender_id,$groupChat,$src)
    {
        $this->sender_id =$sender_id;
        $this->groupChat= $groupChat;
        $this->src= $src;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */

     
    public function broadcastAs(){
        return "fileAddedGroupChat";
    }

    public function broadcastOn()
    {
        return new PrivateChannel('fileAdd-group-chat');
    }
}
