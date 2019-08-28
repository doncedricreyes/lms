<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Notifications\NewMessage;
use Illuminate\Notifications\Notifiable;
use App\Message;
use Auth;

class NewMessage extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        $token = null;
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {  
         if(Auth::user()->role == 'student'){
        return (new MailMessage)
     
                  
                    ->line('You have a new message.')         
                    ->line('Please login to LMS to view your grade.')  
                    ->action('Login to LMS', route('student.login'));
    }  
    if(Auth::user()->role == 'admin'){
        return (new MailMessage)
     
                   
                    ->line('You have a new message.')         
                    ->line('Please login to LMS to view your grade.')  
                    ->action('Login to LMS', route('admin.login'));
    } 
    if(Auth::user()->role == 'teacher'){
        return (new MailMessage)
     
                  
                    ->line('You have a new message.')         
                    ->line('Please login to LMS to view your grade.')  
                    ->action('Login to LMS', route('teacher.login'));
    } 
    if(Auth::user()->role == 'parent'){
        return (new MailMessage)
     
                 
                    ->line('You have a new message.')         
                    ->line('Please login to LMS to view your grade.')  
                    ->action('Login to LMS', route('parent.login'));
    } 
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
            //
        ];
    }
}
