<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    
    protected $model = Article::class;

    public function definition()
    {
        return [
            'title' => $this->faker->address(100),
            'content' => $this->faker->text(600),
            'user_id' => 1
        ];
    }
}
