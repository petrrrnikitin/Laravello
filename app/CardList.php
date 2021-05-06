<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\CardList
 *
 * @property int $id
 * @property string $title
 * @property int $board_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Board $board
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Card[] $cards
 * @property-read int|null $cards_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CardList newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CardList newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CardList query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CardList whereBoardId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CardList whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CardList whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CardList whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CardList whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CardList extends Model
{
    protected $fillable = ['title', 'board_id'];

    public function board(): BelongsTo
    {
        return $this->belongsTo(Board::class, 'board_id');
    }

    public function cards(): HasMany
    {
        return $this->hasMany(Card::class, 'list_id');
    }
}
