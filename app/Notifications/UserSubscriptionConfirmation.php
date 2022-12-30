<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserSubscriptionConfirmation extends Notification
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
        ->subject('Seu pagamento foi Aprovado!')
        ->greeting('Olá, ')
        ->line('Você está recebendo este e-mail como confirmação do pagamento do nosso plano ' .$this->detail['plano'])
        ->line('Agora é só começar a utilizar os serviços da plataforma.')
        ->from('suporte@multben.com.br', env('MAIL_FROM_NAME'))
        ->salutation('Saudações, Mulben.');
        
        if($this->detail['token_acesso'] != null){
            $mailMessage->line('Abaixo esta o seu link de compartilhamento para enviar para até 3 membros que irão compartilhar o plano');      
            $mailMessage->line('Também é possível enviar o link para o email de cada integrante, caso prefira, a partir da sua área na plataforma.');      
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
