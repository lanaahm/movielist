<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

class MainConteoller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Genre $genre)
    {
        $movieb = Movie::latest()->skip(0)->take(3);
        $moviep = Movie::latest()->skip(0)->take(10);
        $movies = Movie::latest();
        $genres = Genre::all();
        
        if (request('sorted')) {
            if (request('sorted') == 'A-Z') {
                $movies->orderBy('title', 'asc');
            }
            elseif (request('sorted') == 'Z-A') {
                $movies->orderBy('title', 'desc');
            }
            elseif (request('sorted') == 'latest') {
                $movies->orderBy('created_at', 'desc');
            }
        }elseif (request('genre')) {
            $movies = $movies->where('genre_id', '=', $genre->id);
        }elseif (request('search')) {
            $movies->where('title', 'like', '%'.request('search').'%');
        }else{
            $movies = $movies->skip(10)->take(30);
        }
        
        return view(Route::current()->uri() == '/' ? 'welcome' : 'movie.movie', [
            'title' => 'Home',
            'movieb' => $movieb->get(),
            'pmovie' => $moviep->get(),
            'genres' => $genres,
            'movies' => $movies->get()
        ]);
    }

    public function show(Movie $movie)
    {
        $moviep = Movie::latest()->skip(10)->take(10);

        return view('movie.detail', [
            'title' => 'Movie',
            'pmovie' => $moviep->get(),
            'movie' => Movie::with('watchlist')->find($movie->id),
        ]);
    }
}