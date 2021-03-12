<?php

namespace App\Models;

use \Illuminate\Database\Eloquent;

class Category extends Eloquent\Model
{
    use Eloquent\Factories\HasFactory;

    protected $fillable = [
        'name'
    ];

    public $timestamps = false;

    public function articles(): Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Article::class);
    }
}
