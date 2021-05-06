<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Board
 *
 * @property int $id
 * @property string $title
 * @property string $color
 * @property int $owner_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\CardList[] $lists
 * @property-read int|null $lists_count
 * @property-read \App\User $owner
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Board newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Board newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Board query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Board whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Board whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Board whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Board whereOwnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Board whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Board whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Board extends Model
{
    protected $fillable = ['title', 'color', 'owner_id'];


    public function lists(): HasMany
    {
        return $this->hasMany(CardList::class, 'board_id');
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
