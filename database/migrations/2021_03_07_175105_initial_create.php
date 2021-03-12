<?php

use App\Models;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InitialCreate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Users
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->text('connection');
            $table->text('queue');
            $table->longText('payload');
            $table->longText('exception');
            $table->timestamp('failed_at')->useCurrent();
        });

        // Articles
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title', 127)->unique();
            $table->mediumText('content');
            $table->timestamps();

            $table->foreignIdFor(Models\User::class)
                ->constrained()
                ->onDelete('cascade');
        });

        // Comments
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string('content');
            $table->timestamps();

            $table->foreignIdFor(Models\User::class)
                ->constrained()
                ->onDelete('cascade');

            $table->foreignIdFor(Models\Article::class)
                ->constrained()
                ->onDelete('cascade');
        });

        // Categories
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
        });

        Schema::create('article_category', function (Blueprint $table) {
            $table->foreignIdFor(Models\Article::class)
                ->constrained();
            $table->foreignIdFor(Models\Category::class)
                ->constrained();
            $table->unique(['article_id', 'category_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_resets');
        Schema::dropIfExists('failed_jobs');
        Schema::dropIfExists('articles');
        Schema::dropIfExists('comments');
        Schema::dropIfExists('article_category');
    }
}
