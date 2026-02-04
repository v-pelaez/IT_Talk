<?php

namespace Database\Factories;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Likeable>
 */
class LikeableFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = [Post::class, Comment::class];
        $randomType = fake()->randomElement($types);

        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'likeable_id' => $randomType::inRandomOrder()->first()->id,
            'likeable_type' => $randomType,
        ];
    }
}
