<?php

namespace App\Mail;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMailUserCommentPostUpdate extends Mailable
{
    public $post;
    use Queueable, SerializesModels;

    /**
     * Create a new messages instance.
     *
     * @param $post
     */
    public function __construct(Post $post)
    {
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
            ->subject('Le post que vous avez commenté a été modifié!!!')
            ->view('emails/UserCommentPostUpdate');
    }
}
