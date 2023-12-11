<?php

namespace Modules\Sales\Repositories;

use Illuminate\Support\Facades\DB;
use Modules\Sales\Repositories\Contracts\ReadSaleRepositoryInterface;
use Modules\Sales\ValueObjects\SaleId;

final class ReadSaleRepository implements ReadSaleRepositoryInterface
{
    public function find(SaleId $id): ?object
    {
        // Podriamos tener una base de datos para lectura. Podria ser una BD Postgres
        // return DB::connection('pgsql')->table('sales')->where('id', $id)->first();

        return DB::table('sales')->where('id', $id->toNative())->first();
    }
}
