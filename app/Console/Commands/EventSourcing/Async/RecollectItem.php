<?php

namespace App\Console\Commands\EventSourcing\Async;

use App\Aggregates\CitizenAggregateRoot;
use App\Models\EventSourcing\Async\Citizen;
use Illuminate\Console\Command;

class RecollectItem extends Command
{
    protected $signature = 'app:recollect-items-async {amount?}';

    protected $description = 'Recolecta elementos entregados por un ciudadano';

    public function handle(): void
    {
        $amount = $this->argument('amount');

        if (! $amount) {
            $this->error('No se ha ingresado la cantidad de elementos a recolectar');
            return;
        }

        $citizen = Citizen::all()->random()->first();

        CitizenAggregateRoot::retrieve($citizen->uuid)
            ->deliveryItems($amount)
            ->persist();

        $this->info("Recolectando {$amount} elementos del ciudadano {$citizen->uuid}...");
    }
}
