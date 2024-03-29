<?php

namespace App\Events;

use App\Models\UsdtPurchase;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UsdtOrderEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var UsdtPurchase
     */
    public $order;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(UsdtPurchase $order)
    {
        $this->order = $order;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return [
            // new PrivateChannel('UsdtOrder'.$this->order->id),
            new Channel('UsdtOrder.'.$this->order->id)
        ];
    }

    // public function broadcastAs()
    // {
    //     return 'UsdtOrderUpdate';
    // }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith()
    {
        return [
            'order' => $this->order
        ];
    }
}
