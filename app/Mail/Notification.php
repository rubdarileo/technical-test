<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Notification extends Mailable
{
    use Queueable, SerializesModels;

    /** data info */
    public $data;

    /**  The view template. */
    public $view;

    /**  The mail subject. */
    public $subject;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $data, string $view, string $subject = 'Client Notification')
    {
        $this->afterCommit();
        $this->data = $data;
        $this->view = $view;
        $this->subject = $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.'.$this->view)
            ->subject($this->subject)
            ->with([
                'data' => $this->data,
            ]);
    }
}
