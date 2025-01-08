<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;
use App\Events\PostPublished;
use Carbon\Carbon;


class PublishPosts extends Command
{
//    protected $signature = 'app:publish-scheduled-posts';
//    protected $description = 'Command description';
    protected $signature = 'posts:publish-scheduled';
    protected $description = 'Automatically publish posts scheduled for publishing';


    public function handle()
    {
        \Log::info('PublishScheduledPosts command is running');
        $posts = Post::where('status', Post::STATUS_PUBLISHING_AWAITING)
                     ->where('published_at', '<=', now())
                     ->get();

        foreach ($posts as $post) {
            $post->status = Post::STATUS_PUBLISHED;
            $post->save();
	    event(new PostPublished($post));
            $this->info("Post '{$post->title}' published.");
        }

        return Command::SUCCESS;
    }
}

