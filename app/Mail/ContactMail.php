<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

	protected $inputs;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($inputs)
    {
		$this->inputs=$inputs;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {        
        return $this->view('mail.contact')->with([
			'name'=>$this->inputs['name'],
			'email'=>$this->inputs['email'],
			'subject'=>$this->inputs['subject'],
			'question'=>$this->inputs['question']
		]);
    }
}
