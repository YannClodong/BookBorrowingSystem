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
    public function definition()
    {
        return [
            'title' => $this->faker->unique()->text($maxNbChars = 30),
            'authors' => $this->faker->name,
            'description' => $this->faker->text,
            'released_at' => $this->faker->date,
            'cover_image' => "https://picsum.photos/seed/" . $this->faker->word . "/200/300",
            'pages' => $this->faker->numberBetween(1, 5000),
            'language_code' => $this->faker->languageCode,
            'isbn' => $this->faker->unique()->numberBetween(1000000000, 9999999999),
            'in_stock' => $this->faker->numberBetween(1, 20)
        ];
    }
}
