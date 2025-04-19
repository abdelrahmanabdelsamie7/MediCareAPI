<?php
namespace App\Mail;
use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminReplyMail extends Mailable
{
    use Queueable, SerializesModels;
    public $contact;
    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }
    public function build()
    {
        return $this->subject('Reply to Your contact Submission')
            ->view('emails.reply_to_user')
            ->with([
                'name' => $this->contact->name,
                'reply' => $this->contact->reply,
            ]);
    }
}