<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Genre extends Pivot
{
    protected $table = 'genres';
    protected $fillable = [
        'name',
        'style'
    ];

    public function books() {
        return $this->belongsToMany(Book::class, 'book_genre', 'genre_id', 'book_id');
    }
}
