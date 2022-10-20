<?php

namespace App\Events;

use App\Models\Complaint;   //nama model
use App\Models\User;   //nama model
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UpdatePositionEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $account_detail;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($account_detail)
    {
        $this->account_detail = $account_detail;

        $complaint = Complaint::where('id',$account_detail['id'])->first();
        $complaint->coordinate_officer = $account_detail['coordinate_officer'];
    	$complaint->save();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
