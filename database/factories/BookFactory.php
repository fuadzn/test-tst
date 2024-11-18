<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BookFactory extends Factory
{
    protected $model = Book::class;

    public function definition()
    {
        return [
            'title' => $this->faker->title,
            'description' => $this->faker->jobTitle,
            'publish_date' => $this->faker->date('Y-m-d', 'now'),
            'author_id' => Author::factory(), 
        ];
    }
}
