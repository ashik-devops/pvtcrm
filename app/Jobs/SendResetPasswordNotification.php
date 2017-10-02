<?php

namespace App\Jobs;

use App\Notifications\ResetPassword;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendResetPasswordNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user;
    public $resetPassword;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, ResetPassword $resetPassword)
    {
        $this->user=$user;
        $this->resetPassword=$resetPassword;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->user->notify($this->resetPassword);
    }
}
