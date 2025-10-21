<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'author_id' => Author::inRandomOrder()->first()->id, 
            'category_id' => Category::inRandomOrder()->first()->id,
            // Hapus unique() karena kita butuh 100.000 judul.
            // Biarkan Faker membuat judul, dan jika ada duplikasi, biarkan saja.
            'title' => $this->faker->sentence(5), 
            'average_rating' => 0.00,
            'voter_count' => 0,
        ];
    }
}
