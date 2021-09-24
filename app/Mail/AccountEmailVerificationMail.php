<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class AccountEmailVerificationMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $DataBag = [];
        $subject = "1 Business CRM - Account Verification";
        $DataBag['user'] = $this->user;
        $DataBag['emailVerificationLink'] = route('auth.emailVerification', array('token' => $this->user->email_verify_token));
        return $this->subject($subject)->view('crm.mails.account-email-verification-mail', $DataBag);
    }
}
