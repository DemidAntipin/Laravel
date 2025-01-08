<?php

namespace App\Listeners;

use App\Events\PostCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Post;

class AutoModeratePost
{
    public function handle(PostCreated $event)
    {
        $post = $event->post;

        if (preg_match('/https?:\/\/[^\s]+/', $post->title) || preg_match('/https?:\/\/[^\s]+/', $post->content)) {
            $post->status = Post::STATUS_SUSPICIOUS;
        } else {
            $post->status = Post::STATUS_PUBLISHING_AWAITING;
        }

        $post->save();
    }
}
