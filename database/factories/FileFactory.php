<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\File>
 */
class FileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'url' => 'https://res.cloudinary.com/dr1ohfvxn/image/upload/v1698753039/erhjsvj7g16iebcqubxd.jpg',
            'name' => 'php6206',
            'type' => 'image',
            'size' => 714429,
        ];
    }
}
