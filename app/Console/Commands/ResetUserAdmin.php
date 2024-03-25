<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class ResetUserAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:reset-user-admin {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove user role to this email address';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = Str::lower($this->argument('email'));
        $user = User::whereEmail($email)->first();

        if(!$user) {
            $this->error('User not found');
            return;
        }

        $user->removeRole('admin');

        $this->info('User role admin reseted for ' . $user->email);
    }
}
