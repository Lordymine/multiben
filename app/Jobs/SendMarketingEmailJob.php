<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Notification;
use App\Notifications\MarketingNotification;

class SendMarketingEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $details;
    
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $users = $this->details['users'];
        $sendTo = [];
        
        if($users != null){
            switch ($this->details['enviar_para']){
                case 1:
                    foreach ($users as $user){
//                         $sendTo = $users;
                        sleep(60);
                        Notification::send($user, new MarketingNotification($this->details));
                    }
                    break;
                case 2:
                    foreach ($users as $user){
                        if($user->ativoEmAlgumPlano()){
//                             array_push($sendTo, $user);
                            sleep(60);
                            Notification::send($user, new MarketingNotification($this->details));
                        }
                    }
                    break;
                case 3:
                    foreach ($users as $user){
                        if(!$user->ativoEmAlgumPlano()){
//                             array_push($sendTo, $user->email);
                            sleep(60);
                            Notification::send($user, new MarketingNotification($this->details));
                        }
                    }
                    break;
            }
            
//             Notification::send($sendTo, new MarketingNotification($this->details));
        }
    }
}
