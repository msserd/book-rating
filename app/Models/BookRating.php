<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookRating extends Model
{
    protected $fillable = [
        'user_id', 
        'book_id', 
        'rating', 
    ];

    /**
     * К какой книге относится эта оценка
     *
     * @return BelongsTo
     */
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    /**
     * Какой пользователь поставил эту конкретную оценку
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
