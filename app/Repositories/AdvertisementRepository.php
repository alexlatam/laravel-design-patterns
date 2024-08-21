<?php

namespace App\Repositories;

use App\Models\Advertisement;
use App\Repositories\Contracts\AdvertisementRepositoryInterface;
use Carbon\Carbon;
use App\Http\Dtos\SearchAdvertisementDto;

final class AdvertisementRepository implements AdvertisementRepositoryInterface
{
    private int $pagination = 15;

    public function store(int $user_id, array $data): void
    {
        Advertisement::create([
            'user_id' => $user_id,
            'category_id' => $data['category_id'],
            'title' => $data['title'],
            'description' => $data['description'],
            'price' => $data['price'],
            'status' => $data['status'],
            'final_date' => $data['final_date'],
        ]);
    }

    public function cancel(int $advertisement_id): void
    {
        Advertisement::where('id', $advertisement_id)->update([
            'deleted_at' => now(),
        ]);
    }

    public function all(SearchAdvertisementDto $search)
    {
        $adsQuery = Advertisement::query();

        if ($search->getKeyword()) {
            $adsQuery->where(function ($query) use ($search) {
                $query->where('title', 'like', "%{$search->getKeyword()}%")
                    ->orWhere('description', 'like', "%{$search->getKeyword()}%");
            });
        }

        if ($search->getCategoryId()) {
            $adsQuery->where('category_id', $search->getCategoryId());
        }

        if ($search->getMaxPrice() && $search->getMinPrice()) {
            $adsQuery->whereBetween('price', [0, 500]);
        }

        if ($search->getStatus()) {
            $adsQuery->where('status', $search->getStatus());
        }

        if ($search->getShowAll()) {
            $adsQuery->orderBy('price', 'desc');
        } else {
            $adsQuery->where('final_date', '<=', Carbon::now())
                ->orderBy('created_at');
        }

        return $adsQuery->whereNull('deleted_at')
            ->with(['user:id,name,lastname', 'category:id,title'])
            ->paginate($this->pagination);
    }
}
