<?php
namespace App\Formatters;

use App\Contracts\Formattable;
use Illuminate\Support\Collection;

class AdvertiserOneFormatter implements Formattable
{

    public function format(Collection $hotels): Collection
    {
        return $hotels->map(fn($hotel) => $this->formatHotel($hotel));
    }

    private function formatHotel($hotel)
    {
        $hotelInfo =  [
            'hotel' => $hotel['name'],
            'rating' => $hotel['stars'] 
        ];

        $output = [];

        foreach($hotel['rooms'] as $room) {
            array_push($output, array_merge($hotelInfo, [
                'code' => $room['code'],
                'price' => $room['total'],
                'currency' => $room['taxes']['currency'],
                'advertiser' => 'advertiser_one'
            ]));
        }

       return $output;
    }
}
