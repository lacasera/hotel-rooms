<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    public $timestamps = true;

    protected $fillable = [
        'code', 'hotel', 'advertiser', 'price', 'currency', 'rating', 'created_at'
    ];

    public function setCreatedAtAttribute()
    {
        $this->attributes['created_at'] = date('Y-m-d h:i:s');
    }
}