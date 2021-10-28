<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence($nbWords = 6, $variableNbWords = true);
        $slug = Str::slug($title, '-');

        return [
            'user_id' => function(){
                return User::all()->random();
            },
            'title' => $title,
            'slug' => $slug,
            'excerpt' => $this->faker->text(200),
            'body' => $this->faker->text(1000)
        ];
    }
}
