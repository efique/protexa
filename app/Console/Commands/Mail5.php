<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Mails;
use App\Mail\HelloWorld;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class Mail5 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:5';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to send email';

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
        //One hour is added to compensate for PHP being one hour faster 
        $now = date("Y-m-d H:i", strtotime(Carbon::now()->addHour()));
        logger($now);

        $date = date("m/d/y");

        $users = Mails::get()->where('interval', 1);
        foreach($users as $user) {
            if($user->break == 0){
                Mail::to($user)
                ->send(new HelloWorld($date));
            }
        }
    }
}
