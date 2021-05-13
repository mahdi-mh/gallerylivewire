<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [ 'user_id' ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'name' ];

    /**
     * Relation to User model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function User(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    /**
     * Relation to Post model
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Post(){
        return $this->hasMany(Post::class,'category_id','id');
    }
}
