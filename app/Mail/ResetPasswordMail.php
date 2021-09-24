<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\PasswordReset;
use App\Models\User;

class ResetPasswordMail extends Mailable
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
        $subject = "1 Business CRM - Reset Password";
        $passwordReset = PasswordReset::where('email_id', $this->user->email_id)->first();
        $DataBag['user'] = $this->user;
        $DataBag['resetPasswordLink'] = route('auth.resetPassword', array('token' => $passwordReset->token));
        return $this->subject($subject)->view('crm.mails.reset-password-mail', $DataBag);
    }
}
