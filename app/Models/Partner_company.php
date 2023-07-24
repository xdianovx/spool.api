<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner_company extends Model
{
    use HasFactory;
    protected $fillable = ['number','addition','description'];
    
    public function partner_companyable()
    {
        return $this->morphTo();
    }
}
