<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendTestEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:test-email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a test email to verify email configuration';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Mail::raw('This is a test email', function ($message) {
            $message->to('carlosehs.9319@gmail.com')
                    ->subject('Test Email');
        });

        $this->info('Test email sent successfully!');
        return 0;
    }
}
