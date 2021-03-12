<?php

namespace App\Models;

use Illuminate\Database\Eloquent;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

/**
 * @property string $name
 * @property string $email
 * @property string $password
 */
class User extends AuthUser
{
    use Eloquent\Factories\HasFactory, Notifiable, HasRoles;

    const ROLES = [
        'ADMIN' => 'ADMIN',
        'REGULAR' => 'REGULAR',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function articles(): Eloquent\Relations\HasMany
    {
        return $this->hasMany(Article::class);
    }

    public function comments(): Eloquent\Relations\HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
