<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieActor extends Model
{
    use HasFactory;
    protected $fillable = ['movie_id', 'actor_id', 'character_name'];
    public $timestamps = false;

    public function movies()
    {
        return $this->hasMany(Movie::class, 'id', 'movie_id');
    }
    public function actors()
    {
        return $this->hasMany(Actor::class, 'id', 'actor_id');
    }
}
