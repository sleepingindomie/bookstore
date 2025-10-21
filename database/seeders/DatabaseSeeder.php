<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Author;
use App\Models\Category;
use App\Models\Book;
use App\Models\Rating;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    
    public function run(): void
    {
        // Menonaktifkan pengecekan Foreign Key untuk seeding cepat
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // 1. Authors: 1000 fakes author
        Author::factory(1000)->create();
        $this->command->info('1000 Authors seeded.');

        // 2. Categories: 3000 fakes book category
        Category::factory(3000)->create();
        $this->command->info('3000 Categories seeded.');

        // 3. Books: 100.000 fakes books
        // Karena jumlahnya banyak, kita gunakan insert biasa
        $authors = Author::pluck('id')->toArray();
        $categories = Category::pluck('id')->toArray();
        $faker = Faker::create();
        $booksToInsert = [];
        
        for ($i = 0; $i < 100000; $i++) {
            $booksToInsert[] = [
                'author_id' => $faker->randomElement($authors),
                'category_id' => $faker->randomElement($categories),
                'title' => $faker->unique()->sentence(5),
                'created_at' => now(),
                'updated_at' => now(),
            ];
            // Batch insert setiap 5000 baris
            if ($i % 5000 === 0 && $i > 0) {
                Book::insert($booksToInsert);
                $booksToInsert = [];
                $this->command->info("Inserting batch... {$i}/100000 Books.");
            }
        }
        if (!empty($booksToInsert)) {
             Book::insert($booksToInsert);
        }
        $this->command->info('100.000 Books seeded.');

        // 4. Ratings: 500.000 fakes rating & Update denormalized fields
        $this->call(RatingSeeder::class);
        $this->command->info('500.000 Ratings seeded and Books/Authors updated.');

        // Mengaktifkan kembali pengecekan Foreign Key
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}