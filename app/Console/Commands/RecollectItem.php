<?php

namespace App\Console\Commands;

use App\Models\Citizen;
use Illuminate\Console\Command;

class RecollectItem extends Command
{
    protected $signature = 'app-name:recollect {amount?}';

    protected $description = 'REcoletca elementos entregados por los ciudadanos';

    public function handle(): void
    {
        try {
            $amount = $this->argument('amount');

            if(!$amount) {
                $this->error("Debe ingresar la cantidad de elementos a recolectar");
            }

            $citizen = Citizen::first();
            $citizen->deliveryItems($amount);

            $this->info("Se han recolectado {$amount} elementos");
        } catch (\Throwable $th) {
            $this->error("Error al recolectar elementos");
        }
    }
}
