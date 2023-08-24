<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
        'discounted_price',
        'video_id'
    ];

    public function video()
    {
        return $this->belongsTo(Video::class);
    }
    public function tickets_store()
    {
        return $this->hasOne(ClientTicket::class);
        
    }
}
