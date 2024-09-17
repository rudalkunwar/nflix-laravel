<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [
        'release_date' => 'date',
    ];

    public function actors()
    {
        return $this->belongsToMany(Actor::class, 'actors_movies');
    }

    public function director()
    {
        return $this->belongsTo(Director::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'genres_movies');
    }

    public function watchlists()
    {
        $this->belongsToMany(Watchlist::class);
    }
}
