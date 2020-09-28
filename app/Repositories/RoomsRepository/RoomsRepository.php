<?php
namespace App\Repositories\RoomsRepository;

use App\Models\Room;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

class RoomsRepository implements RoomsRepositoryInterface
{

    protected $model;
    
    public function __construct(Room $model)
    {
        $this->model = $model;
    }

    public function save(array $rooms)
    {
        return $this->model->insert($rooms);
    }

    public function findAll(): EloquentCollection
    {
        return Room::orderBy('price')->get()->unique('code');
    }
}