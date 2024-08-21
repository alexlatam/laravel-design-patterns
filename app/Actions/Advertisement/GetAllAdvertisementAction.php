<?php

namespace App\Actions\Advertisement;

use App\Http\Dtos\SearchAdvertisementDto;
use App\Repositories\Contracts\AdvertisementRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

final readonly class GetAllAdvertisementAction
{
    function __construct(
        private AdvertisementRepositoryInterface $advertisementRepository
    ) {}

    public function __invoke(array $data): LengthAwarePaginator
    {
        $search = new SearchAdvertisementDto(
            show_all: $data['show_all'],
            status: $data['status'],
            max_price: $data['max_price'],
            min_price: $data['min_price'],
            category_id: $data['category_id'],
            keyword: $data['keyword'],
        );

        return $this->advertisementRepository->all($search);
    }
}
