<?php

use App\Http\Controllers\App\ProductController;
use App\Http\Controllers\ReviewController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/products/find-by-name/{name}", [ProductController::class, "findByName"])->name("api.products.find_by_name");
Route::resource("products", ProductController::class)->only("store", "index", "show", "update", "destroy")->names([
    "index" => "api.products.index",
    "store" => "api.products.store",
    "show" => "api.products.show",
    "update" => "api.products.update",
    "destroy" => "api.products.destroy",
]);

// Update Reviews using an Application Service, with Event Dispatcher and Listeners
Route::put('/reviews', [ReviewController::class, 'update'])->name('api.reviews.update');

// Import routes from src folder

Route::prefix('v1')->group(function () {
    // Import routes from src/DDD/CommandHandlerWithCommandBus/Post/Infrastructure/Routes/post.php
    require base_path('src/DDD/CommandHandlerWithCommandBus/Post/Infrastructure/Routes/post.php');
    require base_path('src/DDD/CommandHandlerWithCommandBusWithoutAttachCommandHandler/Post/Infrastructure/Routes/post.php');

    // Import routes from src/DDD/CommandHandlerWithDecorator/Infrastructure/Routes/review.php
    // require base_path('src/DDD/CommandHandlerWithDecorator/Infrastructure/Routes/review.php');
});

