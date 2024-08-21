<?php

namespace App\Repositories\Contracts;

use App\Http\Dtos\SearchAdvertisementDto;

interface AdvertisementRepositoryInterface
{
    public function all(SearchAdvertisementDto $search);
    public function store(int $user_id, array $data): void;
    public function cancel(int $advertisement_id): void;
}
