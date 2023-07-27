<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientsTemporaryPassword extends Model
{
    use HasFactory;
    protected $fillable = [
        'password',
        'clients_temporary_password_id'
    ];
    public function client()
    {
        return $this->belongsTo(Client::class);
        
    }
}
