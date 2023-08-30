<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ActorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $actor = Actor::latest();
        
        if (request('search')) {
            $actor->where('name', 'like', '%'.request('search').'%');
        }

        return view('actor.main', [
            'title' => 'Actor',
            'actor' => $actor->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('actor.add', ['title' => 'Actor add']);
    }

    
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name'=> 'required|min:3',
            'gender'=> 'required',
            'biography'=> 'required|min:10',
            'date_of_birth'=> 'required',
            'place_of_birth'=> 'required',
            'photo'=> 'required|mimes:jpg,png,webp,gif',
            'popularity'=> 'required',
        ]);

        $file = $request->file('photo')->getClientOriginalName();
        $fileName = time().'-'.$file;
        $path = $request->file('photo')->storeAs('images/actor', $fileName);
        $validateData['slug'] = Str::slug(time().'-'.$validateData['name']);
        $validateData['photo'] = $fileName;
        Actor::create($validateData);
        return redirect('/actor.add')->with('addMovie_success', 'Data actor has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Actor  $actor
     * @return \Illuminate\Http\Response
     */
    public function show(Actor $actor)
    {
        return view('actor.detail', [
            'title' => 'Actor',
            'actor' => $actor,
        ]);
    }

    public function edit(Actor $actor)
    {
        return view('actor.edit', [
            'title' => 'Actor',
            'actor' => $actor,
        ]);
    }

    public function update(Request $request, Actor $actor)
    {
        $rules = [
            'name'=> 'required|min:3',
            'gender'=> 'required',
            'biography'=> 'required|min:10',
            'date_of_birth'=> 'required',
            'place_of_birth'=> 'required',
            'popularity'=> 'required',
        ];

        if ($request->name != $actor->name) {
            $request['slug'] = Str::slug(time().'-'.$request->name);
            $rules['slug'] = 'required|unique:actors';
        }
        $validateData = $request->validate($rules);
        $validateData['gender'] = $request->gender == 'Male' ? 1: 0;

        if ($request->file('photo')) {
            $rules = [
                'photo'=> 'required|mimes:jpg,png,webp,gif',
            ];
            $validateData = $request->validate($rules);
            if ($request->oldImage) {
                Storage::delete('/images/actor/'.$request->oldImage); 
            }
            $file = $request->file('photo')->getClientOriginalName();
            $fileName = time().'-'.$file;
            $path = $request->file('photo')->storeAs('images/actor', $fileName);
            $validateData['photo'] = $fileName;
        }

        Actor::where('id', $actor->id)->update($validateData);
        return redirect('/actor/'.$request['slug'])->with('editActor_success', 'Data actor has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Actor  $actor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Actor $actor)
    {
        if ($actor->photo) {
            Storage::delete('/images/actor/'.$actor->photo); 
        }

        Actor::destroy($actor->id);        
        return redirect('/actor')->with('deleteActor_success', 'Actor has been deleted.');
    }
}
