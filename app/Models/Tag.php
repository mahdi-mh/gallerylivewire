<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    /**
     * The attributes that timestamp is require on not.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'name' ];

    /**
     * Relation to Post model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function Post(){
        return $this->belongsToMany(Post::class,'post_tag');
    }
}
