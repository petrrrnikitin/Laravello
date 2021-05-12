<?php

namespace App\Policies;

use App\CardList;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CardListPolicy
{
    use HandlesAuthorization;

    public function createCard(User $user, CardList $cardList)
    {
        return $user->id === $cardList->board->owner_id;
    }
}
