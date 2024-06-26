<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    public function authors() {
        return $this->belongsToMany(Author::class, 'book_author');
    }

    protected $fillable = [
        'title',
        'description',
        'price',
        'rate'
    ];
}
