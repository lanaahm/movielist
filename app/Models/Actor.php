<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Actor extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function movie_actors()
    {
        return $this->hasMany(MovieActor::class, 'actor_id', 'id')->with('movies');
    }
}
