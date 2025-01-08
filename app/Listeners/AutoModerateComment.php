<?php

namespace App\Listeners;

use App\Events\CommentCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Models\Comment;

class AutoModerateComment
{
    public function handle(CommentCreated $event)
    {
        $comment = $event->comment;

        if (preg_match('/(https|http)?:\/\/[^\s]+/', $comment->content)) {
            // Отправляем комментарий на ручную модерацию.
            $comment->status = Comment::STATUS_SUSPICIOUS;
        } else {
            // Комментарий прошел автомодерацию.
            $comment->status = Comment::STATUS_PUBLISHED;
        }

        $comment->save();
    }
}

