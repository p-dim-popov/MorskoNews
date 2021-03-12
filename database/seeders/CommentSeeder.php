<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Seeds comments to each article.
     * WARN: Must be ran only after UserWithArticlesSeeder.
     *
     * @return void
     */
    public function run()
    {
        $userIds = User::all()->pluck('id');
        Article::all()->pluck('id')->each(function ($articleId) use ($userIds) {
            $userIds->random(3)->each(function ($userId) use ($articleId) {
                Comment::factory()
                    ->state([
                        'user_id' => $userId,
                        'article_id' => $articleId
                    ])
                    ->create();
            });
        });
    }
}
