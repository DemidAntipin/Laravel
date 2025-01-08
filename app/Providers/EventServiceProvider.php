<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\PostPublished;
use App\Listeners\NotifyPostPublished;
use App\Events\CommentCreated;
use App\Listeners\AutoModerateComment;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        PostPublished::class => [
            NotifyPostPublished::class,
        ],
        CommentCreated::class => [
            AutoModerateComment::class,
        ],
	PostCreated::class => [
            AutoModeratePost::class,
        ],
    ];

    public function boot()
    {
        //
    }
}
