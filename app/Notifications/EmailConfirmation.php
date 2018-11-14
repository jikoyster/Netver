<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Auth;

class EmailConfirmation extends Notification
{
    use Queueable;

    var $token;
    var $email;
    var $line1 = 'You are receiving this email because we need email confirmation for your account registration.';
    var $action = 'Email Confirmation';
    var $route;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token = null, $email = null, $reset = false, $type = null)
    {
        $this->token = $token;
        $this->email = $email;
        if($reset) {
            $this->line1 = 'You are receiving this email because you requested for password reset.';
            $this->action = 'Password Reset';
            $this->route = route('password.reset', ['token'=>$this->token,'email'=>$this->email], false);
        } else {
            if($type != 'accountant') {
                if(Auth::check()) {
                    $this->line1 = 'You are receiving this email because you are invited to register by '.Auth::user()->first_name.' ('.Auth::user()->email.').';
                    $this->action = 'Confirm Invitation';
                }
                $this->route = route('register.confirm', ['token'=>$this->token,'email'=>$this->email], false);
            } else {
                $this->route = route('accountant.register.confirm', ['token'=>$this->token,'email'=>$this->email], false);
            }
        }
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
        return (new MailMessage)
            ->line($this->line1)
            ->subject($this->action)
            ->action($this->action, url(config('app.url').$this->route))
            ->line('If you did not register, no further action is required.');
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
