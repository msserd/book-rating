<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

use App\Models\Book;
use App\Models\BookRating;


class BookRatingController extends Controller
{
    /**
     * Сохранение рейтинга книги
     */
    public function rate(Request $request, Book $book)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5'
        ]);

        BookRating::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'book_id' => $book->id,
            ],
            [
                'rating' => $request->rating,
            ]
            );

        return back();
    }

    /**
     * Удаление рейтингов юзера
     */
    public function resetMy()
    {
        BookRating::where('user_id', auth()->id())->delete();

        return back();
    }

    /**
     * Удаление всех рейтингов
     */
    public function resetAll()
    {
        Gate::authorize('resetAll', BookRating::class);

        BookRating::truncate(); 

        return back();
    }
}
