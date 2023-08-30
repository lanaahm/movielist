<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\MovieActor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Movie = Movie::latest();
        
        if (request('search')) {
            $Movie->where('name', 'like', '%'.request('search').'%');
        }

        return view('movie.main', [
            'title' => 'Movie',
            'Movie' => $Movie->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('movie.add', [
            'title' => 'Movie add',
            'genres' => Genre::all(),
            'actors' => Actor::all()
        ]);
    }

    
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'title'=> 'required|min:2|max:50',
            'description'=> 'required|min:8',
            'genre_id'=> 'required',
            'director'=> 'required|min:3',
            'release_date'=> 'required',
            'thumbnail'=> 'required|mimes:jpg,png,webp,gif',
            'background'=> 'required|mimes:jpg,png,webp,gif',
            'actor.*.actor' => 'required',
            'actor.*.character' => 'required'
        ]);
        

        $thumbnail = $request->file('thumbnail')->getClientOriginalName();
        $thumbnailName = time().'-'.$thumbnail;
        $paththumbnail = $request->file('thumbnail')->storeAs('images/movie', $thumbnailName);
        $validateData['thumbnail'] = $thumbnailName;
        
        $background = $request->file('background')->getClientOriginalName();
        $backgroundName = time().'-'.$background;
        $pathbackground = $request->file('background')->storeAs('images/movie', $backgroundName);
        $validateData['background'] = $backgroundName;
        $validateData['slug'] = Str::slug(time().'-'.$validateData['title']);

        $movieId = DB::table('movies')->insertGetId([
            "title" => $request->title,
            "description" => $request->description,
            "genre_id" => $request->genre_id,
            "director" => $request->director,
            "release_date" => $request->release_date,
            "thumbnail" => $thumbnailName,
            "background" => $backgroundName,
            "slug" => $validateData['slug'],
            "created_at" => now(),
            "updated_at" => now(),
        ]); 
        
        foreach ($request->actor as $key => $value) {
            MovieActor::create(['movie_id' => $movieId, 'actor_id' => $value['actor'], 'character_name' => $value['character']]);
        }


        return redirect('/movie_add')->with('addMovie_success', 'Data movie has been added');
    }

    public function edit(Movie $Movie)
    {
        return view('movie.edit', [
            'title' => 'Movie',
            'movie' => $Movie,
            'genres' => Genre::all(),
            'actors' => Actor::all()
        ]);
    }

    public function update(Request $request, Movie $movie)
    {
        $rules = [
            'title'=> 'required|min:2|max:50',
            'description'=> 'required|min:8',
            'genre_id'=> 'required',
            'director'=> 'required|min:3',
            'release_date'=> 'required',
            'actor.*.actor' => 'required',
            'actor.*.character' => 'required'
        ];

        if ($request->name != $movie->name) {
            $request['slug'] = Str::slug(time().'-'.$request->name);
            $rules['slug'] = 'required|unique:Movies';
        }
        $validateData = $request->validate($rules);
        
        if ($request->file('thumbnail')) {
            $rules = [
                'thumbnail'=> 'required|mimes:jpg,png,webp,gif',
            ];
            $validateData = $request->validate($rules);
            if ($request->oldThumbnail) {
                Storage::delete('/images/movie/'.$request->oldThumbnail); 
            }
            $thumbnail = $request->file('thumbnail')->getClientOriginalName();
            $thumbnailName = time().'-'.$thumbnail;
            $path = $request->file('thumbnail')->storeAs('images/Movie', $thumbnailName);
            $validateData['thumbnail'] = $thumbnailName;
        }
        
        if ($request->file('background')) {
            $rules = [
                'background'=> 'required|mimes:jpg,png,webp,gif',
            ];
            $validateData = $request->validate($rules);
            if ($request->oldBackground) {
                Storage::delete('/images/movie/'.$request->oldBackground); 
            }
            $background = $request->file('background')->getClientOriginalName();
            $backgroundName = time().'-'.$background;
            $path = $request->file('background')->storeAs('images/movie', $backgroundName);
            $validateData['background'] = $backgroundName;
        }

        unset($validateData['actor']);
        Movie::where('id', $movie->id)->update($validateData);
        foreach ($request->actor as $key => $value) {
            $movieActor = MovieActor::where([
                ['movie_id',  $movie->id],
                ['actor_id',  $value['oldActor']??null],
                ['character_name',  $value['oldCharacter']??null]
            ])->first();
            
            if ($movieActor) {
                DB::table('movie_actors')->where([
                    ['movie_id',  $movie->id],
                    ['actor_id',  $value['oldActor']],
                    ['character_name',  $value['oldCharacter']]
                ])->update([
                    'movie_id' => $movie->id,
                    'actor_id' => $value['actor'],
                    'character_name' => $value['character'],
                ]);
            }else{
                $movieActor = new MovieActor;
                $movieActor->movie_id = $movie->id;
                $movieActor->actor_id = $value['actor'];
                $movieActor->character_name = $value['character'];
                $movieActor->save();
            }
        }

        return redirect('/movie/'.$request['slug'])->with('editMovie_success', 'Data movie has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Movie  $Movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        if ($movie->thumbnail) {
            Storage::delete('/images/movie/'.$movie->thumbnail); 
        }
        if ($movie->background) {
            Storage::delete('/images/movie/'.$movie->background); 
        }

        Movie::destroy($movie->id);        
        return redirect('/movie')->with('deleteMovie_success', 'Movie has been deleted.');
    }
}
