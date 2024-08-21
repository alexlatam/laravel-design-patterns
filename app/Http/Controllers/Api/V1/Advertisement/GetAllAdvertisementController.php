<?php

namespace App\Http\Controllers\Api\V1\Advertisement;

use App\Actions\Advertisement\GetAllAdvertisementAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\AdvertisementCollection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final class GetAllAdvertisementController extends Controller
{
    function __construct(private readonly GetAllAdvertisementAction $action) {}

    public function __invoke(Request $request): JsonResponse
    {
        $advertisements = $this->action->__invoke($request->all());

        return response()->json(new AdvertisementCollection($advertisements), Response::HTTP_OK);
    }
}
