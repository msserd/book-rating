<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

use App\Models\Book;

use App\Http\Requests\Book\BookRequest;

use Inertia\Inertia;

class BookController extends Controller
{
    /**
     * Отображение общего списка всех книг
     */
    public function index()
    {
        return $this->renderBooks(
            Book::query(), 
            'Рейтинг книг', 
            false
        );
    }

    /**
     * Отображение книг юзера
     */
    public function myBooks()
    {
        return $this->renderBooks(
            Book::query()->where('user_id', auth()->id()), 
            'Мои книги', 
            true
        );
    }

    /**
     * Универсальный метод для подготовки данных и рендеринга страницы списка книг
     */
    public function renderBooks($query, $title, $isMyBooks)
    {
        $books = $query->withAvg('ratings as average_rating', 'rating')
            ->with(['ratings' => function($q) { 
                $q->where('user_id', auth()->id()); 
            }])
            ->latest()
            ->get()
            ->map(function($book) {
                $book->user_rating = auth()->check() ? ($book->ratings->first()?->rating ?? 0) : 0;
                return $book;
            });

        $stats = [
            'count' => $books->count(),
            'total_avg' => number_format($books->avg('average_rating') ?? 0, 2)
        ];

        return inertia('Book/Index', [
            'books' => $books,
            'title' => $title,
            'isMyBooks' => $isMyBooks,
            'stats' => $stats,
        ]);
    }

    /**
     * Страница создания книги
     */
    public function create()
    {
        return Inertia::render('Book/Create', [
            'backUrl' => url()->previous()
        ]);
    }

    /**
     * Сохранение новой книги
     */
    public function store(BookRequest $request)
    {
        $data = array_merge($request->validated(), [
            'user_id' => auth()->id(),
        ]);
        
        Book::create($data);

        $url = $request->input('redirect_to') ?? route('books.index');

        if (str_contains($url, '/create')) 
            $url = route('books.index');

        return redirect()->to($url);
    }

    /**
     * Страница обновления книги
     */
    public function edit(Book $book)
    {
        Gate::authorize('edit', $book);

        $book->genre = explode(', ', $book->genre);

        return Inertia::render('Book/Edit', [
            'book' => $book,
            'backUrl' => url()->previous(),
        ]);
    }

    /**
     * Обновление данных книги
     */
    public function update(BookRequest $request, Book $book)
    {
        Gate::authorize('update', $book);

        $book->update($request->validated());

        $url = $request->input('redirect_to') ?? route('books.index');

        if (str_contains($url, '/create')) 
            $url = route('books.index');

        return redirect()->to($url);
    }

    /**
     * Удаление книги
     */
    public function destroy(Book $book)
    {
        Gate::authorize('delete', $book);

        $book->delete();

        return back();
    }
}
