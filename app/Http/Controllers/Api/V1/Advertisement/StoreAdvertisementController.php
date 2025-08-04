<?php

namespace App\Http\Controllers\Api\V1\Advertisement;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdvertisementRequest;
use App\Repositories\Contracts\AdvertisementRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

final class StoreAdvertisementController extends Controller
{
    function __construct(
        private readonly AdvertisementRepositoryInterface $advertisementRepository
    ) {}

    public function __invoke(StoreAdvertisementRequest $request): JsonResponse
    {
        $user_id = Auth::user()->id;
        $this->advertisementRepository->store($user_id, $request->all());

        return response()->json([
            'message' => 'Advertisement created successfully',
        ], Response::HTTP_CREATED);
    }
}
