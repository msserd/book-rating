<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    protected $fillable = [
        'title', 
        'user_id', 
        'description', 
        'genre', 
        'adult', 
        'img', 
    ];

    /**
     * Создатель книги
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Все оценки, поставленные этой книге
     *
     * @return HasMany
     */
    public function ratings(): HasMany
    {
        return $this->hasMany(BookRating::class);
    }
}
