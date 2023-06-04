<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $fname = fake()->firstName;
        $lname = fake()->lastName;
        $genres = ['Action', 'Comedy', 'Drama', 'Romance', 'Thriller', 'Horror', 'Science Fiction'];

        return [
                'title' => fake()->cityPrefix,
                'release_date'  => fake()->date($format = 'Y-m-d', $max = 'now'),
                'director'  => $fname. " " . $lname,
                'image' => fake()->imageUrl($width = 640, $height = 480),
                'genre' => fake()->randomElement($genres)
        ];
    }
}
