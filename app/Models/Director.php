<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Director extends Model
{
    use HasFactory;
    protected $guarded = [];
    // In your Movie model (e.g., Movie.php)
    protected $casts = [
        'birth_date' => 'date',
    ];

    public function movies()
    {
        return $this->hasMany(Movie::class);
    }
}
