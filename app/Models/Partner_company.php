<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner_company extends Model
{
    use HasFactory;
    protected $fillable = ['number','addition','description'];
    
    public function clients()
    {
        return $this->hasMany(User::class);
    }
    public function videos()
    {
        return $this->hasMany(Video::class);
    }
}
