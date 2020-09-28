<?php

use App\Formatters\AdvertiserTwoFormatter;
use Tests\Mocks\AdvertiserTwoMockResponse;

class AdvertiserTwoFormatterTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_return_formatted_room_for_advertiser_two()
    {
        $sample = (new AdvertiserTwoMockResponse)->getResponse();

        $expected = (new AdvertiserTwoFormatter)->format(collect($sample['hotels']));

        $expected->each(
            fn ($room) => collect($room)->each(
                fn ($formatted) => $this->assertHasKeysForAdvertiserTwo($formatted)
            )
        );
    }

    private function assertHasKeysForAdvertiserTwo($room) 
    {
        $expectedKeys = ['hotel', 'rating', 'code', 'price', 'currency', 'advertiser'];

        $this->assertEquals($expectedKeys, array_keys($room));
        $this->assertEquals('advertiser_two', $room['advertiser']);
    }
}