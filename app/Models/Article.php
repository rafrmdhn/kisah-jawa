<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'artikels';
    protected $guarded = ['id'];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function tags() {
        return $this->belongsToMany(Tag::class, 'artikel_tags', 'artikel_id', 'tag_id');
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function scopeTrending($query, int $days = 7)
    {
        return $query->whereDate('tanggal_posting', '>=', now()->subDays($days))
                        ->orderBy('views', 'desc');
    }
}
