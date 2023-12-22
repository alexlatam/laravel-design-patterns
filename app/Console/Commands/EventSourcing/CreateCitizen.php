<?php

namespace App\Console\Commands\EventSourcing;

use App\Models\EventSourcing\Citizen;
use App\Models\User;
use Faker\Provider\es_VE\Address;
use Illuminate\Console\Command;

class CreateCitizen extends Command
{
    protected $signature = 'app:create-citizen';

    protected $description = 'Crea un nuevo ciudadano';

    public function handle(): void
    {
        $user = User::create([
            "name" => "Juan",
            "email" => "juan@app.com",
            "password" => bcrypt("12345678"),
            "created_at" => now(),
        ]);

        Citizen::createWithAttributes([
            "community" => Address::community(),
            "user_id" => $user->id,
        ]);

        $this->info("Ciudadano creado exitosamente");
    }
}
