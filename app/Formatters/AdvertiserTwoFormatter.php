<?php
namespace App\Formatters;

use App\Contracts\Formattable;
use App\Models\Room;
use Illuminate\Support\Collection;

class AdvertiserTwoFormatter implements Formattable
{
    public function format(Collection $hotels): Collection
    {
        return $hotels->map(fn ($hotel) => $this->formatHotel($hotel));
    }

    private function formatHotel($hotel)
    {
        $hotelInfo =  [
            'hotel' => $hotel['name'],
            'rating' => $hotel['stars']
        ];

        $output = [];

        foreach ($hotel['rooms'] as $room) {
            array_push($output, (array_merge($hotelInfo, [
                'code' => $room['code'],
                'price' => $room['totalPrice'],
                'currency' => $room['taxes'][0]['currency'],
                'advertiser' => 'advertiser_two'
            ])));
        }

        return (array) $output;
    }
}
