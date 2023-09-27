<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Category extends Model
{
  use Sluggable;
  use HasFactory;
  private $descendants = [];
  protected $fillable = [
    'name',
    'image',
    'sort',
    'slug',
    'parent_id',
    'video_availability'
  ];
  public function sluggable(): array
  {
    return ['slug' => ['source' => 'name']];
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
  public function children()
  {
    return $this->childrenCategories()->with('children');
  }
  public function hasChildren()
  {
    if ($this->children->count()) {
      return true;
    }

    return false;
  }
  public function findDescendants(Category $category)
  {
    $this->descendants[] = $category->id;

    if ($category->hasChildren()) {
      foreach ($category->children as $child) {
        $this->findDescendants($child);
      }
    }
  }

  public function getDescendants(Category $category)
  {
    $this->findDescendants($category);
    return $this->descendants;
  }
}
