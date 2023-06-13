<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
 
class MessageEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $chatData,$image,$pdf,$video,$user_image;
    public function __construct($chatData,$image,$pdf,$video,$user_image)
    {
        $this->chatData=$chatData;
        $this->image=$image;
        $this->pdf=$pdf;
        $this->video=$video;
        $this->user_image=$user_image;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastAs()
    {
        return 'getChatMessage';
    }
    public function broadcastWith(){
        return ['chat'=>$this->chatData,'image'=>$this->image,'pdf'=>$this->pdf,'video'=>$this->video,'user'=>$this->user_image];
    }
    public function broadcastOn()
    {
        return new PrivateChannel('chat-data');
    }
}
