<?php

use App\Http\Controllers\App\ProductController;
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
