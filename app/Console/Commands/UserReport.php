<?php

namespace App\Console\Commands;

use App\Jobs\SendReportJob;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class UserReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:report';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $data = User::query()
            ->where('created_at', '>', Carbon::now()->subDays(1))
            ->get();
        dispatch(new SendReportJob($data));
    }
}
