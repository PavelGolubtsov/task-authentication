<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class LoginCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auth:login';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates and returns a token on authorization';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $login = $this->ask('What is your login?');
        $password = $this->secret('What is your password?');

        $success = auth()->attempt([
            'login' => $login,
            'password' => $password
        ]);

        if($success) {
            $user = auth()->user();
            $api_token = Str::random(80);
            $api_token_sha = hash('sha256', $api_token);
            User::where('id', $user->id)->update([
                'api_token' => $api_token_sha,
            ]);

            $this->info(
                'api_token: ' . $api_token
            );

            return ['token' => $api_token];
        }

        $this->info('No success!');
        return Command::SUCCESS;
    }
}
