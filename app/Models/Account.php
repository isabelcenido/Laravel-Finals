<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Account extends Authenticatable
{
    use HasFactory, Notifiable;
    
    protected $fillable=[
        'firstname',
        'lastname',
        'username',
        'email',
        'password',
        'role',
    ];

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

}
