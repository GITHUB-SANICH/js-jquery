<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ForgonUserEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
	// private $user;
	// private $password;


    public function __construct()
    {

    }
   // public function __construct($user, $password)
   // {
   //     $this->user = $user;
   //     $this->password = $password;
   // }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //Mail::to($user)->send(new ForgotPassword($password));
    }
}
