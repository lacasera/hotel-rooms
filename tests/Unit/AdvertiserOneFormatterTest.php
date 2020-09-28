<?php

use App\Formatters\AdvertiserOneFormatter;
use Tests\Mocks\AdvertiserOneMockResponse;

class AdvertiserOneFormatterTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_return_formatted_room_for_advertiser_one()
    {
        $sample = (new AdvertiserOneMockResponse)->getResponse();

        $expected = (new AdvertiserOneFormatter)->format(collect($sample['hotels']));

        $expected->each(
            fn ($room) => collect($room)->each(
                fn ($formatted) => $this->assertHasKeysForAdvertiserOne($formatted)
            )
        );
    }

    private function assertHasKeysForAdvertiserOne($room) 
    {
        $expectedKeys = ['hotel', 'rating', 'code', 'price', 'currency', 'advertiser'];

        $this->assertEquals($expectedKeys, array_keys($room));
        $this->assertEquals('advertiser_one', $room['advertiser']);
    }
}