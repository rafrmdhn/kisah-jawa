<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['title','slug','content','image','category_id','author_id'];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function author() {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function tags() {
        return $this->belongsToMany(Tag::class, 'article_tags');
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }
}
