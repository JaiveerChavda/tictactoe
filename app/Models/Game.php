<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use App\Models\User;


/**
 * @property int $id
 * @property int $player_one_id
 * @property int $Player_two_id
 * @property array $state
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read User $playerOne
 * @property-read User $playerTwo
 */

class Game extends Model
{
    use HasFactory,Prunable;

    protected $fillable = [
        'player_one_id',
        'player_two_id',
        'state',
    ];

    public function casts(): array
    {
        return [
            'state' => 'json',
        ];
    }

    public function playerOne(): BelongsTo
    {
        return $this->belongsTo(User::class, 'player_one_id');
    }

    public function playerTwo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'player_two_id');
    }

    public function prunable() : Builder
    {
        return static::where('created_at','<=',now()->subHour())->whereNull('state')->whereNull('player_two_id'); 
    }

}
