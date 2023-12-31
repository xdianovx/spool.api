<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    use HasFactory;

    protected $fillable = [
        'seconds_viewed',
        'video_id',
        'country_id',
        'client_id'
    ];

    public function video()
    {
        return $this->belongsTo(Video::class);
    }
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
