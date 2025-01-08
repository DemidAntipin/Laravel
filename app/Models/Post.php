<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    const STATUS_NEW = 1;
    const STATUS_SUSPICIOUS = 2;
    const STATUS_PUBLISHING_AWAITING = 3;
    const STATUS_PUBLISHED = 4;
    const STATUS_HIDDEN = 5;
    const STATUS_IDLE = 0;

    protected $table = 'posts';

    protected $fillable = ['title', 'content', 'status', 'published_at'];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
