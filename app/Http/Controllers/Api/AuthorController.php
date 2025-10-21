<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AuthorResource;
use App\Models\Author;
use Illuminate\Http\Request;

/**
 * @group Authors
 *
 * APIs for managing authors
 */
class AuthorController extends Controller
{
    /**
     * Get all authors
     *
     * Retrieve a list of all authors.
     *
     * @queryParam page integer Page number for pagination. Example: 1
     * @queryParam per_page integer Number of items per page (10-100). Example: 10
     *
     * @response 200 {
     *  "data": [{
     *    "id": 1,
     *    "name": "John Doe",
     *    "total_high_ratings": 1250,
     *    "books_count": 15
     *  }],
     *  "links": {},
     *  "meta": {}
     * }
     */
    public function index(Request $request)
    {
        $perPage = min((int) $request->get('per_page', 10), 100);
        $authors = Author::withCount('books')->paginate($perPage);

        return AuthorResource::collection($authors);
    }

    /**
     * Get top 10 most famous authors
     *
     * Retrieve the top 10 authors ranked by high ratings (rating > 5).
     *
     * @response 200 {
     *  "data": [{
     *    "id": 1,
     *    "name": "John Doe",
     *    "total_high_ratings": 1250,
     *    "books_count": 15
     *  }]
     * }
     */
    public function top()
    {
        $authors = Author::select('authors.*')
            ->selectRaw('COUNT(CASE WHEN ratings.rating > 5 THEN 1 END) as votes')
            ->leftJoin('books', 'authors.id', '=', 'books.author_id')
            ->leftJoin('ratings', 'books.id', '=', 'ratings.book_id')
            ->groupBy('authors.id', 'authors.name', 'authors.total_high_ratings', 'authors.created_at', 'authors.updated_at')
            ->orderByDesc('votes')
            ->limit(10)
            ->get()
            ->map(function($author) {
                return [
                    'id' => $author->id,
                    'name' => $author->name,
                    'total_high_ratings' => $author->votes,
                ];
            });

        return response()->json(['data' => $authors]);
    }

    /**
     * Get a specific author
     *
     * Retrieve details of a specific author by ID.
     *
     * @urlParam id integer required The ID of the author. Example: 1
     *
     * @response 200 {
     *  "data": {
     *    "id": 1,
     *    "name": "John Doe",
     *    "total_high_ratings": 1250,
     *    "books_count": 15
     *  }
     * }
     *
     * @response 404 {
     *  "message": "Author not found"
     * }
     */
    public function show(string $id)
    {
        $author = Author::withCount('books')->findOrFail($id);

        return new AuthorResource($author);
    }
}
