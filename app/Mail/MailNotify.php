<?php

namespace App\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MailNotify extends Mailable
{
    use Queueable, SerializesModels;


    protected $name;
    protected $id;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name,$id)
    {
        $this->name = $name;
        $this->id = $id;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Laporan Service CV Asia Teknik',
            from: new Address('no-reply@sdp.lukasbudi.my.id', 'no-reply sdp')
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'mail.MailNotify',
            with: [
                'name'=>$this->name,
                'id'=>$this->id,
                'tanggal'=> Carbon::now()->format('Y-m-d H:i:s')
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
