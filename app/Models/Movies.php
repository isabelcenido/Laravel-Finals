<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Movies extends Model
{
    use HasFactory, Notifiable;
    
    protected $fillable=[
        'title',
        'release_date',
        'ratings',
        'duration',
        'cast',
        'description',
        'image',
        'genre_id',
    ];

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

}
