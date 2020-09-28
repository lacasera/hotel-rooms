<?php

use App\Models\Room;
use App\Repositories\RoomsRepository\RoomsRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class RoomsRepositoryTest extends TestCase
{
    protected $roomsRepository;

    public function setUp(): void
    {
        parent::setUp();
        $this->roomsRepository = app()->make(RoomsRepositoryInterface::class);
    }
    /**
     * @test
     */
    public function it_should_save_a_room()
    {
        $room = factory(Room::class)->raw();
        
        $this->roomsRepository->save($room);

       $this->seeInDatabase('rooms', $room);
    }

    /**
     * @test
     */
    public function it_should_return_rooms_in_the_right_order()
    {
        $data = [
            [
                'code' => 'code-1',
                'hotel' => 'Hotel A',
                'price' => '10.0',
                'advertiser' => 'advertiser_one',
                'currency' => 'EUR',
                'rating' => '3'
            ],
            [
                'code' => 'code-2',
                'hotel' => 'Hotel B',
                'price' => '9.0',
                'advertiser' => 'advertiser_one',
                'currency' => 'EUR',
                'rating' => '4'
            ]
        ];

        $this->roomsRepository->save($data);

        $rooms = $this->roomsRepository->findAll()->toArray();

        $firstRoom = $rooms[0];

        $secondRoom = $rooms[1];

        $this->assertEquals([
            'code' => $firstRoom['code'],
            'hotel' => $firstRoom['hotel'],
            'price' => $firstRoom['price'],
            'advertiser' => $firstRoom['advertiser'],
            'currency' => $firstRoom['currency'],
            'rating' => $firstRoom['rating']
        ], $data[1]);

          $this->assertEquals([
            'code' => $secondRoom['code'],
            'hotel' => $secondRoom['hotel'],
            'price' => $secondRoom['price'],
            'advertiser' => $secondRoom['advertiser'],
            'currency' => $secondRoom['currency'],
            'rating' => $secondRoom['rating']
        ], $data[0]);

    }


    /**
     * @test 
     */
    public function it_should_return_unique_rooms()
    {
        $data = [
            [
                'code' => 'code-1',
                'hotel' => 'Hotel A',
                'price' => 10.0,
                'advertiser' => 'advertiser_one',
                'currency' => 'EUR',
                'rating' => 3
            ],
            [
                'code' => 'code-1',
                'hotel' => 'Hotel B',
                'price' => 9.0,
                'advertiser' => 'advertiser_one',
                'currency' => 'EUR',
                'rating' => 4
            ]
        ];

        $this->roomsRepository->save($data);

        $rooms = $this->roomsRepository->findAll();
        $expected = $rooms->first();
        
        $this->assertEquals(9.0, $expected->price);
        $this->assertEquals(1, $rooms->count());
    }

    /**
     * @test
     */
    public function it_returns_an_instance_of_eloquent_collections()
    {
        factory(Room::class)->create();

        $expected = $this->roomsRepository->findAll();

        $this->assertInstanceOf(Collection::class, $expected);
    }
}