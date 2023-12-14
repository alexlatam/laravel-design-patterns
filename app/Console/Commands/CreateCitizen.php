<?php

namespace App\Console\Commands;

use App\Models\Citizen;
use App\Models\User;
use Faker\Provider\es_VE\Address;
use Illuminate\Console\Command;

class CreateCitizen extends Command
{
    protected $signature = 'app-name:make-citizen';

    protected $description = 'Crea un nuevo ciudadano';

    public function handle(): void
    {
        try {
            $user = User::create([
                "name" => "ciudadano 1",
                "email" => "ciudadano1@app.com",
                "password" => bcrypt("12345678"),
                "created_at" => now(),
            ]);

            Citizen::create([
                "user_id" => $user->id,
                "community" => Address::community(),
                "total" => 0,
                "created_at" => now(),
            ]);

            $this->info("Ciudadano creado con éxito");
        } catch (\Throwable $th) {
            $this->error("Error al crear ciudadano");
        }
    }
}
