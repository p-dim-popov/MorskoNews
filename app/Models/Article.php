<?php

namespace App\Models;

use Illuminate\Database\Eloquent;

/**
 * @property string $title
 * @property string $content
 */
class Article extends Eloquent\Model
{
    use Eloquent\Factories\HasFactory;

    protected $fillable = [
        'title',
        'content',
    ];

    public function user(): Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comments(): Eloquent\Relations\HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function categories(): Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }
}
