<?php

namespace App\Listeners;

use App\Events\RoomsPooled;
use App\Repositories\RoomsRepository\RoomsRepositoryInterface;

class SaveRooms
{
   
    protected $roomsRepositoryInterface;

    public function __construct(RoomsRepositoryInterface $roomsRepositoryInterface)
    {
        $this->roomsRepositoryInterface = $roomsRepositoryInterface;
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\RoomsPooled  $event
     * @return void
     */
    public function handle(RoomsPooled $event)
    {
        $event->rooms->each(fn($room) => 
            $this->roomsRepositoryInterface->save($room)        
        );
    }
}
