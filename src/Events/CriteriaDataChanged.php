<?php

namespace Collejo\App\Events;

use Collejo\App\Foundation\Events\Event;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Queue\SerializesModels;

class CriteriaDataChanged extends Event
{
    use SerializesModels;

    public $model;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
