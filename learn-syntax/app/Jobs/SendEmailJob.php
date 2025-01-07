<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;
    /**
     * Create a new job instance.
     * @param array $data
     * @return void
     */

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     * @return void
     */
    public function handle(): void
    {
        
        Mail::raw(
            "Message from: {$this->data['email']}\n\n{$this->data['message']}",
            function ($message) {
                $message->to('shaiqueaijaz.9434@gmail.com') // Recipient email
                        ->subject($this->data['subject']); // Subject of the email
            }
        );
    }
}
