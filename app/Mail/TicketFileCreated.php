<?php

namespace App\Mail;

use App\Models\User;
use App\Models\EmailTemplate;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TicketFileCreated extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The user instance.
     *
     * @var User
     */
    public $user;

    public $jobDetail;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user,$jobDetail)
    {
        $this->user = $user;
		$this->jobDetail = $jobDetail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $emailTemplate = EmailTemplate::where('company_id', $this->user->company_id)->where('label', 'new-file-ticket-created')->first(['subject', 'body']);
        if($emailTemplate){
            $subject = $emailTemplate->subject;
            $body = $emailTemplate->body;

			$subject = str_replace('##CUSTOMER_NAME', ucwords($this->user->first_name.' '.$this->user->last_name), $subject);

            $body = str_replace('##APP_NAME', $this->user->company->name, $body);
            $body = str_replace('##APP_LOGO', asset('uploads/logo/'. $this->user->company->logo), $body);
			$body = str_replace('##CUSTOMER_NAME', ucwords($this->user->first_name.' '.$this->user->last_name), $body);
			$body = str_replace('##MESSAGE', ucfirst($this->jobDetail), $body);
            $this->subject($subject)
                ->view('emails.layout')
                ->with(['body'=>$body]);
        }
    }
}
