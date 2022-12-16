<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserInvitePlataform extends Notification
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
        return (new MailMessage)
                    ->subject($this->detail['nome'].' '.$this->detail['sobrenome'])
					->greeting('Olá, ')
                    ->line('Quer aproveitar  descontos e benefícios incríveis em tudo que já utiliza no dia a dia? Basta se cadastrar na Multben.')
                    ->line('Eu já me cadastrei e indico.')
                    ->action('Cadastre-se', url('/login?m='.$this->detail['matricula']))
                    ->from('convite@multben.com.br', env('MAIL_FROM_NAME'))
                    ->salutation('Saudações, '.$this->detail['nome']);
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
