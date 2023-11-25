<?php

namespace App\Events;

use App\Models\Approval\Approval;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ApprovalActionCreated  implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $approval;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Approval $approval)
    {
        $this->approval=$approval;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        //channel name

        return new Channel('APPROVAL');
    }
}
