<?php 
namespace App\Contracts;

use Illuminate\Support\Collection;

interface Formattable 
{
    public function format(Collection $collection): Collection;
}