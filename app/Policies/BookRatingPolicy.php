<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class BookRatingPolicy
{
    public function resetAll(User $user)
    {
        return $user->role === 'admin';
    }
}
