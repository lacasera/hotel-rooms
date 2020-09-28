<?php
namespace App\Repositories\RoomsRepository;

use Illuminate\Database\Eloquent\Collection;

interface RoomsRepositoryInterface
{
    public function save(array $rooms);

    public function findAll(): Collection;
}
