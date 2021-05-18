<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\Like;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LikeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Like::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $likeable = [
            Post::class,
        ];

        $fakerRandomElement = $this->faker->randomElement($likeable);

        return [
            'user_id'=> User::factory(),
            'likeable_type' => $fakerRandomElement,
            'likeable_id' => $fakerRandomElement::all()->random()->id,
        ];
    }
}
