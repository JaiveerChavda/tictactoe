<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Game;
use App\Models\User;

test('dashboard redirects to games', function () {
    
    login()
    ->get('/dashboard')
    ->assertRedirect(route('games.index',absolute:false));
    
});

test('can create game', function () {
    $user = User::factory()->create();
    
    $response = login($user)
    ->post('/games');

    $game = Game::first();

    $response->assertRedirect(route('games.show',['game' => $game->id],absolute:false));

    // Additional assertions for ensuring correctness
    $response->assertSessionHasNoErrors(); // Ensure no session errors
    
    $this->assertDatabaseCount('games',1);

    $this->assertDatabaseHas('games',[
        'player_one_id' => $user->id
    ]); 

    expect($game->state)->toBeEmpty();    

});

