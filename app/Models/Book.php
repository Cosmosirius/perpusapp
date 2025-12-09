<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //add property to Book entity
    protected $fillable = [
        'title',
        'author',
        'published_date',
        'isbn',
        'description',
        'cover_image',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}