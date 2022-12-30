<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InvitationSubscriptionConfirmation extends Notification
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
        ->subject($this->detail['nome'].' '.$this->detail['sobrenome'])
        ->greeting('Olá, ')
        ->line('Você está recebendo este e-mail como convite para ingressar na nossa plataforma')
        ->line('Agora é só acesso o link para se cadastrar e utilizar os serviços da plataforma.')
        ->from('suporte@multben.com.br', env('MAIL_FROM_NAME'))
        ->salutation('Saudações, Mulben.');
        
        if($this->detail['token_acesso'] != null){
            $mailMessage->line('Abaixo esta o seu link:');      
            $mailMessage->action('Abrir Url' , url('invitation/'.$this->detail['token_acesso']));
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
