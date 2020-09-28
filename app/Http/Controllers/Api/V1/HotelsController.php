<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Repositories\RoomsRepository\RoomsRepositoryInterface;

class HotelsController extends Controller
{
    protected $roomsRepository;

    public function __construct(RoomsRepositoryInterface $roomsRepository)
    {
       $this->roomsRepository = $roomsRepository;
    }
    
    public function __invoke()
    {
        return $this->roomsRepository->findAll()->all();
    }   
}