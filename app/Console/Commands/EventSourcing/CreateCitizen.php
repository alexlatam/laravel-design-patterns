<?php

namespace App\Console\Commands\EventSourcing;

use App\Models\EventSourcing\Sync\Citizen;
use App\Models\EventSourcing\Sync\TransactionCount;
use App\Models\User;
use Faker\Provider\es_VE\Address;
use Illuminate\Console\Command;

class CreateCitizen extends Command
{
    protected $signature = 'app:create-citizen';

    protected $description = 'Crea un nuevo ciudadano';

    public function handle(): void
    {
        try {
            $user = User::create([
                "name" => "Juan",
                "email" => "juancho@app.com",
                "password" => bcrypt("12345678"),
                "created_at" => now(),
            ]);

            Citizen::createWithAttributes([
                "community" => Address::community(),
                "user_id" => $user->id,
            ]);

            TransactionCount::createWithAttributes([
                "user_id" => $user->id,
                "total" => 0,
            ]);

            $this->info("Ciudadano creado exitosamente");
        } catch (\Exception $exception) {
            $this->error("Ciudadano no pudo ser creado");
        }
    }
}
