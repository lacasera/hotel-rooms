<?php

namespace App\Events;

use Illuminate\Support\Collection;

class RoomsPooled extends Event
{
    public $rooms;

    public function __construct(Collection $rooms)
    {
        $this->rooms = $rooms;
    }

    public function handle()
    {
        
    }
}
