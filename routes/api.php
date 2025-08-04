<?php

use App\Http\Controllers\ReviewController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource("products", ProductController::class)->only("store", "index", "show", "update", "destroy")->names([
    "index" => "api.products.index",
    "store" => "api.products.store",
    "show" => "api.products.show",
    "update" => "api.products.update",
    "destroy" => "api.products.destroy",
]);

// Import routes from src folder

Route::prefix('v1')->group(function () {
    // Import routes from src/DDD/CommandHandlerWithCommandBus/Post/Infrastructure/Routes/post.php
    require base_path('src/DDD/CommandHandlerWithCommandBus/Post/Infrastructure/Routes/post.php');
    require base_path('src/DDD/CommandHandlerWithCommandBusWithoutAttachCommandHandler/Post/Infrastructure/Routes/post.php');
    require base_path('src/CQRS/Shared/Infrastructure/Routes/cqrs.php');

    // Import routes from src/DDD/CommandHandlerWithDecorator/Infrastructure/Routes/review.php
    // require base_path('src/DDD/CommandHandlerWithDecorator/Infrastructure/Routes/review.php');
});

