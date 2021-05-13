<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

/**
 * @property string password
 * @property string name
 * @property string phone
 * @property string email
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
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


    /**
     * Hash password
     * @return $this
     */
    public function makePasswordHash(){
        $this->password = Hash::make($this->password);
        return $this;
    }

    /**
     * Relation to Post model
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Post(){
        return $this->hasMany(Post::class);
    }

    /**
     * Relation to Category model
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Category(){
        return $this->hasMany(Category::class);
    }

    /**
     * Relation to Comment model
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Comment(){
        return $this->hasMany(Comment::class);
    }
}
