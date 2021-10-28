<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'post_id' => function(){
                return Post::all()->random();
            },
            'user_id' => function(){
                return User::all()->random();
            },
            'body' => $this->faker->sentence(12, true)
        ];
    }
}
