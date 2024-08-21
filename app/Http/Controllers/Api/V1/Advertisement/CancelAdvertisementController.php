<?php

namespace App\Http\Controllers\Api\V1\Advertisement;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Repositories\Contracts\AdvertisementRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class CancelAdvertisementController extends Controller
{
    function __construct(
        private readonly AdvertisementRepositoryInterface $advertisementRepository
    ) {}

    public function __invoke(Advertisement $advertisement): JsonResponse
    {
        $this->advertisementRepository->cancel($advertisement->id);

        return response()->json([
            'message' => 'Advertisement canceled successfully',
        ], Response::HTTP_OK);
    }
}
