<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PublicMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct() {}

    /**
     * Get the channels the event should broadcast on.
     * El canal donde se emitirá el evento.
     * Channel: indica que se usara un canal publico
     */
    public function broadcastOn(): Channel|array
    {
        return new Channel('public-message-channel');
    }

    /**
     * The event's broadcast name.
     * El nombre del evento que se va a emitir
     */
    public function broadcastAs(): string
    {
        return 'MessageEvent';
    }

    /**
     * The event's broadcast name.
     */
    public function broadcastWith(): array
    {
        return ['message' => 'This notification is a public message'];
    }
}
