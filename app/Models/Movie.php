<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function genres()
    {
        return $this->belongsTo(Genre::class, 'genre_id', 'id');
    }

    public function movie_actors()
    {
        return $this->hasMany(MovieActor::class, 'movie_id', 'id')->with('actors');
    }

    public function watchlist()
    {
        return $this->hasMany(Watchlist::class, 'movie_id', 'id');
    }

}
