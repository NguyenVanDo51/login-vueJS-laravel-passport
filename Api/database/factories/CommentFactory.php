<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $postId = Post::query()->pluck('id');
        $userId = User::query()->pluck('id');
        return [
            'user_id' => $this->faker->randomElement($userId),
            'post_id' => $this->faker->randomElement($postId),
            'content' => $this->faker->text(50)
        ];
    }
}
