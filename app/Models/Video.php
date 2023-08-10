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
        'category_id' 
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
        return $this->belongsToMany(Tag::class);
    }
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
        
    }

}
