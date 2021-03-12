<?php

namespace App\Models;

use Illuminate\Database\Eloquent;

/**
 * @property string $content
 */
class Comment extends Eloquent\Model
{
    use Eloquent\Factories\HasFactory;

    protected $fillable = [
        'content',
    ];

    public function user(): Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function article(): Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Article::class);
    }
}
