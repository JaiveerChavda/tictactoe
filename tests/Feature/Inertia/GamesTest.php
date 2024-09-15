<?php

use App\Models\Game;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

test('can view games', function () {

    $user = User::factory()->create(['name'=>'john']);

    Game::factory()->create([
        'player_one_id' => $user->id
    ]);

    Game::factory(4)->create();

    login()
        ->get('/games')
        ->assertInertia(fn (Assert $assert) => $assert
        ->component('Dashboard')
        ->has('games.data',5)
        ->where('games.data.0.player_one.name',$user->name)
        );
});
