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

    public function scopePopular($q, $limit = 10, $sinceDays = null)
    {
        if ($sinceDays) {
            $q->whereDate('tanggal_posting', '>=', now()->subDays($sinceDays));
        }
        return $q->orderBy('views','desc')->take($limit)
                ->whereHas('category', function ($query) {
                    $query->whereIn('name', [
                        'Kriminal',
                        'Misteri',
                        'Film & Review',
                        'Opini',
                        'Sejarah',
                    ]);
                });
    }

    public function scopeTrending($q, $limit = 10, $rangeDays = 7)
    {
        return $q->whereDate('tanggal_posting', '>=', now()->subDays($rangeDays))
                ->orderBy('views','desc')
                ->take($limit)
                ->whereHas('category', function ($query) {
                    $query->whereIn('name', [
                        'Kriminal',
                        'Misteri',
                        'Film & Review',
                        'Opini',
                        'Sejarah',
                    ]);
                });
    }
}
