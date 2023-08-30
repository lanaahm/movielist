<?php

namespace App\Http\Controllers;

use App\Models\Watchlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WatchlistController extends Controller
{
    public function index()
    {
        if (request('search')) {
            $watchlist = Watchlist::whereHas('movies', function ($query) {
                $query->where('title', 'like', '%'.request('search').'%');
            })->latest()->where('user_id', Auth::user()->id);
            
        }else{
            $watchlist = Watchlist::with('movies')->latest()->where('user_id', Auth::user()->id);
        }

        if (request('sorted')) {
            if (request('sorted') == 'planned') {
                $watchlist->where('status', '0');
            }
            elseif (request('sorted') == 'watching') {
                $watchlist->where('status', '1');
            }
            elseif (request('sorted') == 'finish') {
                $watchlist->where('status', '2');
            }
        }

        $status = ['Planned', 'Watching', 'Finish'];
        return view('watchlist.main', [
            'title' => 'Watch List',
            'status' => $status,
            'watchlist' => $watchlist->paginate(4)
        ]);
    }

    public function store(Request $request)
    {
        Watchlist::create($request->all());
        return back()->with('addWatchlist_success', 'Watchlist has been added');
    }

    public function update(Request $request, Watchlist $watchlist)
    {
        
        if ($request->status == 3) 
            Watchlist::destroy($watchlist->id);
        else
            Watchlist::where('id', $watchlist->id)->update($request->except(['_method', '_token']));
        return redirect('/watchlist')->with('watchlistAction_success', 'Watchlist has been updated.');
    }
}
