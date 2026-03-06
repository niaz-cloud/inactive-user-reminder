<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Jobs\SendInactiveUserReminder;
use Illuminate\Support\Facades\Cache;

class CheckInactiveUsers extends Command
{
    protected $signature = 'users:check-inactive';

    protected $description = 'Check inactive users and dispatch reminder jobs';

    public function handle()
    {
        $days = config('inactive.days', 7);

        $inactiveUsers = User::where('last_login_at', '<=', now()->subDays($days))
            ->orWhereNull('last_login_at')
            ->get();

        foreach ($inactiveUsers as $user) {

            $cacheKey = 'reminder_sent_' . $user->id . '_' . now()->format('Y-m-d');

            if (!Cache::has($cacheKey)) {

                SendInactiveUserReminder::dispatch($user);

                Cache::put($cacheKey, true, now()->endOfDay());

                $this->info("Reminder dispatched for user: " . $user->email);
            }
        }

        return Command::SUCCESS;
    }
}