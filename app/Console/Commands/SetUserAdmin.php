<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class SetUserAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:set-user-admin {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add user role to this email address';

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

        $user->assignRole('admin');

        $this->info('User role set to admin for ' . $user->email);
    }
}
