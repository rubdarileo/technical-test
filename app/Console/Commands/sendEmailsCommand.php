<?php

namespace App\Console\Commands;

use App\Mail\Notification;
use App\Models\Email;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class sendEmailsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send pending emails';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $emails = Email::where('send', false)->get();

        foreach($emails as $email) {
            Mail::to($email->recipient)->send((new Notification(
                ['subject' => $email->subject, 'recipient' => $email->recipient, 'message' => $email->message],
                'notification',
                $email->subject
            )));
            $email->send = true;
            $email->save();
        }
    }
}
