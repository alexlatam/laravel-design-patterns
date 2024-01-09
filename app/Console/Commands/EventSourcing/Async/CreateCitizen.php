<?php

namespace App\Console\Commands\EventSourcing\Async;

use App\Aggregates\CitizenAggregateRoot;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class CreateCitizen extends Command
{
    protected $signature = 'app:create-citizen-async';

    protected $description = 'Command description';

    public function handle(): void
    {
        $user = User::create([
            'name' => 'John Doe',
            'email' => 'citizen_one@mail.com',
            'password' => bcrypt('password'),
            'created_at' => now(),
        ]);

        $uuid = Str::uuid()->toString();

        CitizenAggregateRoot::retrieve($uuid)
            ->createCitizen($user->id)
            ->createTransactionCount($user->id)
            ->persist();

        $this->info("Citizen created with uuid: {$uuid}!!");
    }
}
