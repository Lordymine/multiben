<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MarketingNotification extends Notification
{
    use Queueable;
	
    protected $detail;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($detail)
    {
        $this->detail = $detail;
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
        $mailMessage =  (new MailMessage)
        ->subject($this->detail['titulo'])
        ->greeting('Olá, ')
        ->line($this->detail['corpo'])
        ->from('suporte@multben.com.br', env('MAIL_FROM_NAME'))
        ->salutation('Saudações, Mulben.');
        if($this->detail['filename'] != null){
            $mailMessage->attach(public_path() . '/storage/images/' .$this->detail['filename']);
        }
        
        return $mailMessage;
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
