<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;

/**
 * @group Books
 *
 * APIs for managing books
 */
class BookController extends Controller
{
    /**
     * Get all books
     *
     * Retrieve a paginated list of all books with their authors, categories, and ratings.
     *
     * @queryParam page integer Page number for pagination. Example: 1
     * @queryParam per_page integer Number of items per page (10-100). Example: 10
     * @queryParam q string Filter by book title or author name. Example: Harry Potter
     *
     * @response 200 {
     *  "data": [{
     *    "id": 1,
     *    "title": "Sample Book Title",
     *    "author": {
     *      "id": 1,
     *      "name": "John Doe"
     *    },
     *    "category": {
     *      "id": 1,
     *      "name": "Fiction"
     *    },
     *    "average_rating": 7.85,
     *    "voter_count": 150
     *  }],
     *  "links": {},
     *  "meta": {}
     * }
     */
    public function index(Request $request)
    {
        $perPage = min((int) $request->get('per_page', 10), 100);
        $query = Book::with(['author', 'category']);

        if ($request->has('q')) {
            $search = $request->get('q');
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhereHas('author', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
            });
        }

        $books = $query->paginate($perPage);

        return BookResource::collection($books);
    }

    /**
     * Get a specific book
     *
     * Retrieve details of a specific book by ID.
     *
     * @urlParam id integer required The ID of the book. Example: 1
     *
     * @response 200 {
     *  "data": {
     *    "id": 1,
     *    "title": "Sample Book Title",
     *    "author": {
     *      "id": 1,
     *      "name": "John Doe"
     *    },
     *    "category": {
     *      "id": 1,
     *      "name": "Fiction"
     *    },
     *    "average_rating": 7.85,
     *    "voter_count": 150
     *  }
     * }
     *
     * @response 404 {
     *  "message": "Book not found"
     * }
     */
    public function show(string $id)
    {
        $book = Book::with(['author', 'category'])
            ->findOrFail($id);

        return new BookResource($book);
    }
}
