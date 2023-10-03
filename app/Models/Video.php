<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'image_banner',
        'video',
        'description',
        'duration',
        'event_date',
        'minimum_age',
        'display_slider',
        'partners_company_id',
        'category_id',
        'tickets_count',
        'views_count',
        'ticket_availability',
    ];

    public function partner_company()
    {
        return $this->belongsTo(Partners_company::class,'partners_company_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
        
    }
    public function tags()
    {
        return $this->hasMany(Tag::class);
    }
    public function ticket()
    {
        return $this->hasOne(Ticket::class);
        
    }
    public function clientTickets()
    {
        return $this->hasMany(ClientTicket::class);
        
    }
    public function views()
    {
        return $this->hasMany(View::class);
        
    }
}
