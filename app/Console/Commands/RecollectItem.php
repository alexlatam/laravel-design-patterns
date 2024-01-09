<?php

namespace App\Console\Commands;

use App\Models\EventSourcing\Sync\Citizen;
use Illuminate\Console\Command;

class RecollectItem extends Command
{
    protected $signature = 'app:recollect-items {amount?}';

    protected $description = 'Recolecto elementos entregados por los ciudadanos';

    public function handle(): void
    {
        $amount = $this->argument('amount');
        if(!$amount) {
            $this->error('Debe ingresar la cantidad de elementos a recolectar');
            return;
        }

        $citizen = Citizen::first();

        $citizen->deliveryItems($amount);

        $this->info('Se recolectaron ' . $amount . ' elementos');
    }
}
