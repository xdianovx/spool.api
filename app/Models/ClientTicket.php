<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientTicket extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
        'price_without_commission',
        'client_id',
        'ticket_id',
        'video_id'
    ];
    public function ticket()
    {
        return $this->belongsTo(Ticket::class,'ticket_id');
    }
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
