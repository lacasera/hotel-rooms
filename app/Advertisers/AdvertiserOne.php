<?php

namespace App\Advertisers;

use App\Formatters\AdvertiserOneFormatter;
use App\Contracts\Advertisable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class AdvertiserOne  implements Advertisable
{
    private $endpoint = "https://f704cb9e-bf27-440c-a927-4c8e57e3bad1.mock.pstmn.io/s1/availability";

    private $advertiserOneFormatter;

    public function __construct(AdvertiserOneFormatter $advertiserOneFormatter)
    {
        $this->advertiserOneFormatter = $advertiserOneFormatter;
    }

    public function pool(): Collection
    {
        $response = Http::retry(
            self::retryTimes, 
            self::retryAfter
        )->asJson()->get($this->endpoint);

        $hotels =  $response->successful() 
            ? collect($response->json()['hotels'])
            : collect([]);
        return $this->advertiserOneFormatter->format($hotels);
    }
}

