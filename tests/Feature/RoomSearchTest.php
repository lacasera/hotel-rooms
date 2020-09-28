<?php

use App\Models\Room;

class RoomSearchTest extends TestCase
{

    /**
     * @test
     */
    public function it_get_a_list_of_rooms()
    {
        factory(Room::class, 1)->create();

        $response = $this->get('v1/rooms');

        $this->assertResponseOk();
        
        $this->assertEquals(
            1,
            count($this->response->getOriginalContent())
        );
    }
}