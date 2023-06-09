<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Request>
 */
class RequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $fname  = fake()->firstName;;
        $lname  = fake()->lastName;

        return [
            'title' => fake()->cityPrefix,
            'director'  => $fname . " " . $lname
        ];
    }
}
