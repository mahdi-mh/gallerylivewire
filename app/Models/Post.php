<?php

namespace App\Models;

use App\Http\Controllers\ImageSaverController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [ 'user_id' , 'category_id'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'title' , 'caption' , 'url'];

    protected $with = 'tag';

    public function ForceDeleteByPhotos(){
        ImageSaverController::DeleteAllPhotos($this->url);
        return $this->forceDelete();
    }

    public function GetSingleRout(){
        return '/posts/'.$this->id;
    }

    /**
     * Relation to User model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function User(){
        return $this->belongsTo(User::class);
    }

    /**
     * Relation to Category model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Category(){
        return $this->belongsTo(Category::class);
    }

    /**
     * Relation to Tag model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function Tag(){
        return $this->belongsToMany(Tag::class,'post_tag');
    }

    /**
     * Relation to Comment model
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Comment(){
        return $this->hasMany(Comment::class);
    }

}
