<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientCard extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'card_mask',
        'bank',
        'rebill_id',
        'expiration_date'
    ];
    public function client()
    {
        return $this->belongsTo(Client::class);
        
    }
}
