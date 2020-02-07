<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use phpDocumentor\Reflection\Types\Object_;

class NewCommentMail extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var Array
     */
    protected $comment;
    protected $post;


    public function __construct(Object $comment ,Object $post)
    {
        $this->comment = $comment;
        $this->post = $post;
    }

    /**
     * Build the message.
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
                'comment' => $this->comment,
                'post_title' => $this->post->title,
                'post_content' => $this->post->post

            ]);
    }
}
