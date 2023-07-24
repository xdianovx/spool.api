<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
        'discounted_price'
    ];
    public function videos()
    {
        return $this->morphedByMany(Video::class, 'ticketable');
    }
}
