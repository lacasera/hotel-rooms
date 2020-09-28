<?php

namespace App\Contracts;

use Illuminate\Support\Collection;

interface Advertisable 
{
    /**
     * Number of times to retry request after failure
     */
    const retryTimes = 4;

    /**
     * Number of milliseconds to retry after failure
     */
    const retryAfter = 100;

    public function pool(): Collection;
}