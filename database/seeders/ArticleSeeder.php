<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = Category::all();
        User::all()->each(function ($user) use ($categories) {
            Article::factory()
                ->state(['user_id' => $user->id])
                ->count(10)
                ->create()
                ->each(function ($article) use ($categories) {
                    $article->categories()->saveMany($categories->random(5));
                });
        });
    }
}
