<?php

namespace App\Advertisers;

use App\Contracts\Advertisable;
use App\Formatters\AdvertiserTwoFormatter;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class AdvertiserTwo implements Advertisable
{
    private $endpoint = "https://f704cb9e-bf27-440c-a927-4c8e57e3bad1.mock.pstmn.io/s2/availability";

    protected $advertiserTwoFormatter;

    public function __construct(AdvertiserTwoFormatter $advertiserTwoFormatter)
    {
      $this->advertiserTwoFormatter = $advertiserTwoFormatter;
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
        return $this->advertiserTwoFormatter->format($hotels);
    }
}
