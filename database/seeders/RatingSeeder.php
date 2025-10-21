<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class RatingSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();
        $books = DB::table('books')->pluck('id')->toArray();
        $ratingsToInsert = [];
        $totalRatings = 500000;
        $batchSize = 5000;

        for ($i = 0; $i < $totalRatings; $i++) {
            $ratingsToInsert[] = [
                'book_id' => $faker->randomElement($books),
                'rating' => $faker->numberBetween(1, 10),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            if (($i + 1) % $batchSize === 0) {
                DB::table('ratings')->insert($ratingsToInsert);
                $ratingsToInsert = [];
                $this->command->info("Inserting ratings batch: " . ($i + 1) . "/{$totalRatings}");
            }
        }

        if (!empty($ratingsToInsert)) {
            DB::table('ratings')->insert($ratingsToInsert);
        }

        $this->command->info('500.000 Ratings inserted. Now updating denormalized fields...');

        DB::statement("
            UPDATE books b
            JOIN (
                SELECT 
                    book_id, 
                    COUNT(id) AS voter_count, 
                    AVG(rating) AS average_rating
                FROM ratings
                GROUP BY book_id
            ) AS r ON b.id = r.book_id
            SET 
                b.voter_count = r.voter_count,
                b.average_rating = r.average_rating
        ");

        $this->command->info('Books average rating and voter count updated.');

        DB::statement("
            UPDATE authors a
            JOIN (
                SELECT 
                    b.author_id, 
                    COUNT(r.id) AS total_high_ratings
                FROM ratings r
                JOIN books b ON r.book_id = b.id
                WHERE r.rating > 5
                GROUP BY b.author_id
            ) AS t ON a.id = t.author_id
            SET 
                a.total_high_ratings = t.total_high_ratings
        ");

        $this->command->info('Authors total high ratings updated.');
    }
}