<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
class Category extends Model
{
    use Sluggable;
    use HasFactory;
    protected $fillable = [
        'name',
        'image',
        'sort',
        'slug',
        'parent_id'
    ];
    public function sluggable(): array { 
        return [ 'slug' => [ 'source' => 'name' ] ];
     }
    public function childrenCategories()
    {
      return $this->hasMany(self::class, 'parent_id');
    }
    public function parent()
    {
      return $this->belongsTo(Category::class, 'parent_id');
    }
    public function videos()
    {
        return $this->hasMany(Video::class);
    }
}

