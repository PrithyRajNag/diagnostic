<?php
namespace App\Helpers;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;

class MailHelper extends Mailable {
    use Queueable, SerializesModels;
    protected $details;

    function __construct($details)
    {
        $this->details= $details;
    }

    function sendMail(){
//        $this->subject($this->details['subject'])->view('email.email_template')->with('details',$this->details);
        Mail::to($this->details['to'])->send(new TestMail($this->details));
    }
}
