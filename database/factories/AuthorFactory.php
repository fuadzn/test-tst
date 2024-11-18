<?php

namespace Database\Factories;

use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AuthorFactory extends Factory
{
    protected $model = Author::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'bio' => $this->faker->jobTitle,
            'birth_date' => $this->faker->date('Y-m-d', 'now')
        ];
    }
}
