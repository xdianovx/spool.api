<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Smscod extends Model
{
    use HasFactory;
    protected $fillable = ['code'];

    public function smscodable()
    {
        return $this->morphTo();
    }
}
