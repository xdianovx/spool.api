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
        'display_slider'
    ];

    public function partner_company()
    {
        return $this->morphMany(Partner_company::class, 'partner_companyable');
    }
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
    public function categories()
    {
        return $this->morphToMany(Category::class, 'categoryable');
        
    }
    public function tickets()
    {
        return $this->morphToMany(Ticket::class, 'ticketable');
        
    }
}
