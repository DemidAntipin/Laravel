<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use softDeletes;

    protected $fillable = [
         'name',
	 'year',
	 'isbn',
         'cost',
	 'author_id'
    ];

    protected $guarded = [
        'id',
    ];

    protected $casts = [
        'cost' => 'float',
    ];

    public function author() {
        return $this->belongsTo(Author::class);
    }

    protected function casts() {
         return [
             'year' => 'integer',
             'cost' => 'float', 
             'isbn' => 'string',
         ];
    }
}
