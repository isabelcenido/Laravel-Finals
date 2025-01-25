<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Movies;

class Genre extends Model
{
    protected $fillable = ['name'];

    public function movies()
    {
        return $this->hasMany(Movies::class);
    }
}
