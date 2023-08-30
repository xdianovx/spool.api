<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
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
        return $this->hasMany(ClientTicket::class);
        
    }
    public function client_ticket()
    {
        return $this->belongsTo(ClientTicket::class,'id');
    }
}
