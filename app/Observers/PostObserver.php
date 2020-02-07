<?php

namespace App\Observers;

use App\Mail\SendMailUserCommentPostUpdate;
use App\Models\Post;
use Illuminate\Support\Facades\Mail;

class PostObserver
{
    /**
     * Handle the post "created" event.
     *
     * @param Post $post
     * @return void
     */
    public function created(Post $post)
    {
        //
    }

    /**
     * Handle the post "updated" event.
     *
     * @param Post $post
     * @return void
     */
    public function updated(Post $post)
    {
        $comments = $post->comments;
        $mails=[];
        foreach ($comments as $comment)
        {
            if(!in_array($comment->user->email , $mails))
            {
                array_push($mails,$comment->user->email);
                Mail::to($comment->user->email)
                    ->send(new SendMailUserCommentPostUpdate($post));
            }
        }
    }

    /**
     * Handle the post "deleted" event.
     *
     * @param Post $post
     * @return void
     */
    public function deleted(Post $post)
    {
        $post->comments()->delete();
    }

    /**
     * Handle the post "restored" event.
     *
     * @param  Post  $post
     * @return void
     */
    public function restored(Post $post)
    {
        //
    }

    /**
     * Handle the post "force deleted" event.
     *
     * @param  Post  $post
     * @return void
     */
    public function forceDeleted(Post $post)
    {
        //
    }
}
