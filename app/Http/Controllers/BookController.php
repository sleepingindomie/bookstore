<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Author;
use App\Models\Rating;

class BookController extends Controller
{
    public function welcome(Request $request)
    {
        $perPage = (int) $request->input('per_page', 10);
        $perPage = max(10, min(100, $perPage));

        $query = Book::with(['author','category']);

        if ($q = $request->input('q')) {
            $query->where(function($qr) use ($q) {
                $qr->where('title', 'like', "%{$q}%")
                   ->orWhereHas('author', fn($a) => $a->where('name','like',"%{$q}%"));
            });
        }

        $books = $query->orderByDesc('average_rating')->paginate($perPage)->withQueryString();

        $popularBooks = Book::orderByDesc('average_rating')
            ->limit(10)->get();

        return view('welcome', compact('books','popularBooks'));
    }

    public function topAuthors()
    {
        $authors = Author::select('id','name','total_high_ratings as votes')
            ->orderByDesc('total_high_ratings')
            ->limit(10)->get();

        return view('authors.top', compact('authors'));
    }

    public function createRating()
    {
        $authors = Author::orderBy('name')->get();
        return view('ratings.create', compact('authors'));
    }

    public function storeRating(Request $request)
    {
        $data = $request->validate([
            'author_id' => 'nullable|exists:authors,id',
            'book_id'   => 'required|exists:books,id',
            'rating'    => 'required|integer|min:1|max:10',
        ]);

        if (!empty($data['author_id'])) {
            $ok = Book::where('id', $data['book_id'])
                      ->where('author_id', $data['author_id'])
                      ->exists();
            if (! $ok) {
                return back()->withErrors(['book_id' => 'Selected book does not belong to selected author.'])->withInput();
            }
        }

        Rating::create([
            'book_id' => $data['book_id'],
            'rating'  => $data['rating'],
        ]);

        $book = Book::find($data['book_id']);

        $stats = Rating::where('book_id', $data['book_id'])
            ->selectRaw('COUNT(*) as voter_count, AVG(rating) as average_rating')
            ->first();

        $book->update([
            'voter_count' => $stats->voter_count,
            'average_rating' => $stats->average_rating,
        ]);

        $authorHighRatings = Rating::join('books', 'ratings.book_id', '=', 'books.id')
            ->where('books.author_id', $book->author_id)
            ->where('ratings.rating', '>', 5)
            ->count();

        Author::where('id', $book->author_id)->update([
            'total_high_ratings' => $authorHighRatings,
        ]);

        return redirect()->route('home')->with('success', 'Rating berhasil disimpan.');
    }

    public function booksByAuthor(Author $author)
    {
        $books = $author->books()->select('id','title')->orderBy('title')->get();
        return response()->json($books);
    }
}