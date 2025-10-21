<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Author extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * Kita hanya perlu 'name' karena 'total_high_ratings' akan diupdate oleh sistem.
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Get the books for the author.
     */
    public function books()
    {
        return $this->hasMany(Book::class, 'author_id');
    }

    // Tambahkan relasi ratings agar withCount / whereHas bekerja
    public function ratings()
    {
         return $this->hasManyThrough(
            Rating::class, // final model
            Book::class,   // through model
            'author_id',   // books.author_id
            'book_id',     // ratings.book_id
            'id',          // authors.id (local key)
            'id'           // books.id (local key on through)
        );
    }

}