<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CompanyVoucher extends Notification
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
        ->subject('Recebemos uma solicitação de Bônus na Multben!')
        ->greeting('Olá, ')
        ->line('Você está recebendo este e-mail porque está liberado o VOUCHER para seu cliente utilizar.')
        ->line('Código do Voucher: '.$this->detail['voucher'])
        ->line('Você poder verificar o serviço solicitado na plataforma.')
        ->from('suporte@multben.com.br', env('MAIL_FROM_NAME'))
        ->salutation('Saudações, Mulben.');
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
