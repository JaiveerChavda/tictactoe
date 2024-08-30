<?php

namespace App\Http\Controllers;

use App\Events\GameJoined;
use App\Events\PlayerMadeMove;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class GameController extends Controller
{
    /**
     * here we'll list all the joinable games.
     * with ommiting request user, so they don't join their own game
     */
    public function index(Request $request)
    {
        return inertia('Dashboard',[
            'games' => Game::with('playerOne')
                ->whereNull('player_two_id')
                ->where('player_one_id','!=',$request->user()->id)
                ->oldest()
                ->simplePaginate(100),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $game = Game::create([
            'player_one_id' => $request->user()->id
        ]);

        return to_route('games.show',$game);
    }

     /**
     * Join a game
     * only user other then the owner of game
     * can join the game, that's why we also implemented join policy
     * to prevent the creator of the game to join his own game
     */

    public function join(Request $request,Game $game)
    {
        Gate::authorize('join',$game);

        $game->update([
            'player_two_id' => $request->user()->id,
        ]);

        GameJoined::dispatch($game);

        return to_route('games.show',$game);
    }

    /**
     * Display the specified resource.
     */
    public function show(Game $game)
    {
        $game->load(['playerOne','playerTwo']);
        return inertia('Games/Show',compact('game'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Game $game)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Game $game)
    {
        $data = $request->validate([
            'state' => ['required','array','size:9'],
            'state.*' => ['integer','between:-1,1']
        ]);

        $game->update($data);
        
        broadcast(new PlayerMadeMove($game))->toOthers();

        return to_route('games.show',$game);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Game $game)
    {
        //
    }
}
