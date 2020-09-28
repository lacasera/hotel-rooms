<?php

namespace App;

use App\Contracts\Advertisable;
use App\Exceptions\AdvertiserClassNotFoundException;

class AdvertisersFactory 
{
    public function make($name): Advertisable
    {
        $advertiserNamespace = "\\App\\Advertisers";

        $advertiserClass = $this->removeExtension("$advertiserNamespace\\$name");

        throw_if(
            !class_exists($advertiserClass), 
            new AdvertiserClassNotFoundException("$advertiserClass does not exist")
        );

        return app()->make($advertiserClass);
    }

    public function removeExtension($file)
    {
        return explode('.', $file)[0];
    }
}