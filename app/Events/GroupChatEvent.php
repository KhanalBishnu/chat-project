<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class GroupChatEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $chatData;
    public $src;
    public $time;
   
    public function __construct($chatData,$src,$time)
    {
        $this->chatData=$chatData;
        $this->src=$src;
        $this->time=$time;
        // dd($time);

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */

    public function broadcastAs(){
        return "groupChatData";
    }

    public function broadcastWith(){
        return ['chat'=>$this->chatData,'src'=>$this->src,'time'=>$this->time];
    }
    public function broadcastOn()
    {
        return new PrivateChannel('group-chat-channel');
    }
}
