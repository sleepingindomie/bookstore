<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RatingResource;
use App\Models\Rating;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @group Ratings
 *
 * APIs for managing book ratings
 */
class RatingController extends Controller
{
    /**
     * Get all ratings
     *
     * Retrieve a paginated list of all ratings.
     *
     * @queryParam page integer Page number for pagination. Example: 1
     * @queryParam per_page integer Number of items per page (10-100). Example: 10
     *
     * @response 200 {
     *  "data": [{
     *    "id": 1,
     *    "rating": 8,
     *    "book": {
     *      "id": 1,
     *      "title": "Sample Book"
     *    },
     *    "created_at": "2024-01-15 10:30:00"
     *  }],
     *  "links": {},
     *  "meta": {}
     * }
     */
    public function index(Request $request)
    {
        $perPage = min((int) $request->get('per_page', 10), 100);
        $ratings = Rating::with('book')->latest()->paginate($perPage);

        return RatingResource::collection($ratings);
    }

    /**
     * Create a new rating
     *
     * Submit a new rating for a book.
     *
     * @bodyParam book_id integer required The ID of the book to rate. Example: 1
     * @bodyParam rating integer required The rating value (1-10). Example: 8
     *
     * @response 201 {
     *  "data": {
     *    "id": 1,
     *    "rating": 8,
     *    "book": {
     *      "id": 1,
     *      "title": "Sample Book"
     *    },
     *    "created_at": "2024-01-15 10:30:00"
     *  },
     *  "message": "Rating submitted successfully"
     * }
     *
     * @response 422 {
     *  "message": "Validation error",
     *  "errors": {
     *    "book_id": ["The book id field is required."],
     *    "rating": ["The rating must be between 1 and 10."]
     *  }
     * }
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'book_id' => 'required|exists:books,id',
            'rating' => 'required|integer|min:1|max:10',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $rating = Rating::create([
            'book_id' => $request->book_id,
            'rating' => $request->rating,
        ]);

        return response()->json([
            'data' => new RatingResource($rating->load('book')),
            'message' => 'Rating submitted successfully'
        ], 201);
    }

    /**
     * Get books by author
     *
     * Retrieve all books written by a specific author.
     *
     * @urlParam author_id integer required The ID of the author. Example: 1
     *
     * @response 200 {
     *  "data": [{
     *    "id": 1,
     *    "title": "Sample Book Title"
     *  }]
     * }
     */
    public function booksByAuthor($author_id)
    {
        $books = Book::where('author_id', $author_id)
            ->select('id', 'title')
            ->orderBy('title')
            ->get();

        return response()->json(['data' => $books]);
    }
}
