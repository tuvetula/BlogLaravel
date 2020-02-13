<?php

namespace App\Mail;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewCommentMail extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var Array
     */
    protected $comment;
    protected $post;


    public function __construct(Comment $comment ,Post $post)
    {
        $this->comment = $comment;
        $this->post = $post;
    }

    /**
     * Build the messages.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('romain.marcant@gmail.com')
            ->subject('Nouveau commentaire')
            ->view('emails/newCommentOnPost')
            ->with([
                'user_email' => $this->comment->commentable->email,
                'user_name' => $this->comment->commentable->name,
                'user_first_name' => $this->comment->commentable->first_name,
                'comment' => $this->comment->comment,
                'post_title' => $this->post->title,
                'post_content' => $this->post->post

            ]);
    }
}
