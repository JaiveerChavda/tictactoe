<?php

namespace App\Policies;

use App\Models\Game;
use App\Models\User;

class GamePolicy
{
    public function join(User $user, Game $game): bool
    {
        return $game->playerOne->id !== $user->id && $game->playerTwo === null;
    }
}
