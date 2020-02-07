<?php

namespace App\Listeners;

use App\comment;
use App\Mail\NewCommentMail;
use App\Post;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Auth\User;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\NewComment as NewCommentEvent;
use Illuminate\Support\Facades\Mail;

class NewComment
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param NewCommentEvent $event
     * @return void
     */
    public function handle(NewCommentEvent $event)
    {
        $comment = $event->comment;
        $post = $comment->post;
        Mail::to($comment->commentable->email)->send(new NewCommentMail($comment,$post));

    }
}
