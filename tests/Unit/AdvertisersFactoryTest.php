<?php

use App\AdvertisersFactory;
use App\Contracts\Advertisable;
use App\Exceptions\AdvertiserClassNotFoundException;

class AdvertisersFactoryTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_make_an_instance_of_an_advertiser_class()
    {
        $factory = (new AdvertisersFactory)->make('AdvertiserOne.php');

        $this->assertInstanceOf(Advertisable::class, $factory);
    }

    /**
     * @test
     */
    public function advertiser_class_should_exist()
    {
        $factory = (new AdvertisersFactory)->make('AdvertiserOne.php');

        $this->assertTrue(class_exists(get_class($factory)));
    }

    /**
     * @test
     */
    public function throws_exception_if_advertiser_class_does_not_exist()
    {
        try {
            (new AdvertisersFactory)->make('NotARealAdvertiser.php');
        } catch(Throwable $exception) {
            $this->assertInstanceOf(AdvertiserClassNotFoundException::class, $exception);
            $this->assertEquals('\App\Advertisers\NotARealAdvertiser does not exist', $exception->getMessage());
        }
    }
}