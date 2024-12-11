<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Author extends Model
{
    use softDeletes;


    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
