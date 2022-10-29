<?php

namespace App\Jobs;

use App\Mail\ReportMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendReportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $details;

    /**
     * SendReportJob constructor.
     * @param $details
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    public function handle()
    {
        foreach ($this->details as $detail) {
            $email = new ReportMail($detail);
            Mail::to($detail['email'])->send($email);
        }

        dd('success');
    }
}
