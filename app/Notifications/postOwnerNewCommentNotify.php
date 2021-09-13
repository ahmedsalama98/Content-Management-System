<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class postOwnerNewCommentNotify extends Notification implements ShouldQueue , ShouldBroadcast
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

      protected $comment;
    public function __construct($comment)
    {
        //
        $this->comment = $comment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {


        $arr = [ 'database', 'broadcast'];

        if( $notifiable->receive_email == 1){
            $arr[]= 'mail';
        }

        return  [ 'database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line( $this->comment->name . 'add new comment on your post')
                    ->action('click to browse ',route('post.show',$this->comment->post->slug));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'comment_writer_name'=> $this->comment->name,
            'coment'=>$this->comment->comment,
            'coment_id'=>$this->comment->id,
            'post_slug'=>$this->comment->post->slug,
        ];
    }


    public function toDatabase($notifiable)
    {
        return [
            'comment_writer_name'=> $this->comment->name,
            'coment'=>$this->comment->comment,
            'coment_id'=>$this->comment->id,
            'post_slug'=>$this->comment->post->slug,
        ];
    }

    public function toBroadcast($notifiable)
    {
        return [
            'comment_writer_name'=> $this->comment->name,
            'coment'=>$this->comment->comment,
            'coment_id'=>$this->comment->id,
            'post_slug'=>$this->comment->post->slug,
        ];
    }
}
