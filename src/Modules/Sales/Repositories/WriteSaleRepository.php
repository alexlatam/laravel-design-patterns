<?php

namespace Modules\Sales\Repositories;

use Illuminate\Support\Facades\DB;
use Modules\Sales\Repositories\Contracts\WriteSaleRepositoryInterface;
use Modules\Sales\ValueObjects\Price;
use Modules\Sales\ValueObjects\SaleId;
use Modules\Sales\ValueObjects\UserId;

final class WriteSaleRepository implements WriteSaleRepositoryInterface
{
    public function create(SaleId $id, UserId $user_id, Price $price): string
    {
        return DB::connection('mysql')->table('sales')->insertGetId([
            'id' => $id->toNative(),
            'user_id' => $user_id->toNative(),
            'price' => $price->toNative(),
        ]);
    }
}
