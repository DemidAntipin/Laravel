<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    const STATUS_NEW = 1;
    const STATUS_SUSPICIOUS = 2;
    const STATUS_PUBLISHED = 3;
    const STATUS_IDLE = 0;

    protected $table = 'comments';

    protected $fillable = ['post_id', 'content', 'status'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}

