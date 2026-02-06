<?php

namespace App\Policies;

use App\Models\Book;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BookPolicy
{
    public function before(User $user, $ability)
    {
        if ($user->role === 'admin')
            return true;
    }

    public function edit(User $user, Book $book): bool
    {
        return $user->id === $book->user_id;
    }

    public function update(User $user, Book $book): bool
    {
        return $user->id === $book->user_id;
    }

    public function delete(User $user, Book $book): bool
    {
        return $user->id === $book->user_id;
    }
}
