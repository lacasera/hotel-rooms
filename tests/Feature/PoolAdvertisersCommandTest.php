<?php

use App\Advertisers\AdvertiserOne;
use App\Events\RoomsPooled;
use Illuminate\Support\Facades\{
    Artisan,
    Http,
    Event
};
use Tests\Mocks\{
    AdvertiserOneMockResponse,
    AdvertiserTwoMockResponse
};

class PoolAdvertiserCommandTest extends TestCase
{
    const ADVERTISER_ONE_ENDPOINT = 'https://f704cb9e-bf27-440c-a927-4c8e57e3bad1.mock.pstmn.io/s1/availability';

    const ADVERTISER_TWO_ENDPOINT = 'https://f704cb9e-bf27-440c-a927-4c8e57e3bad1.mock.pstmn.io/s2/availability';

   /**
    * @test
    */
    public function it_should_pool_advertisers_for_rooms()
    {
        $advertiserOneResponse = (new AdvertiserOneMockResponse)->getResponse();
        $advertiserTwoResponse = (new AdvertiserTwoMockResponse)->getResponse();
        
        Http::fake([
            self::ADVERTISER_ONE_ENDPOINT => Http::response($advertiserOneResponse, 200),
            self::ADVERTISER_TWO_ENDPOINT => Http::response($advertiserTwoResponse, 200)
        ]);

        Event::fake();

        Artisan::call('advertisers:pool');

        Event::assertDispatchedTimes(RoomsPooled::class, 2);
    }
}