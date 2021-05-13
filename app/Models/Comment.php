<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    /**
     * Comment status is published
     *
     * @var integer
     */
    const StatusPublished = 1;

    /**
     * Comment status is pending
     *
     * @var integer
     */
    const StatusPending = 2;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['post_id' , 'user_id'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status',
        'author_name',
        'email',
        'title',
        'body',
        'user_id'
    ];

    /**
     * Relation to User model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function User(){
        return $this->belongsTo(User::class);
    }

    /**
     * Relation to Post model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Post(){
        return $this->belongsTo(Post::class);
    }
}
