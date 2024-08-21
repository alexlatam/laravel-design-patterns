<?php

use App\Events\PrivateMessage;
use App\Events\PublicMessage;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\GetUsersByCriteriaController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SalesController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/articles', ArticleController::class);

Route::resource('products', ProductController::class, [
    'name' => [
        'index' => 'app.products.index',
        'create' => 'app.products.create',
        'store' => 'app.products.store',
        'show' => 'app.products.show',
        'edit' => 'app.products.edit',
        'update' => 'app.products.update',
        'destroy' => 'app.products.destroy',
    ],
]);

Route::get('/', function () {
    return view('welcome');
});

// Insert a new sale into the database and get the same sale using CQRS pattern
Route::get('/cqrs', SalesController::class);

Route::get('docs/exceptions/{code}', fn ($code) => $code)->name('docs.exceptions');

Route::get('/articles', ArticleController::class);
Route::get('/articles-all', fn() => Product::getAll());

Route::get('/users-criteria', GetUsersByCriteriaController::class);


/**
 * CHAT WITH LARAVEL ECHO, REDIS AND SOCKET.IO
 * Al ejecutar esta ruta se disparara el evento PublicMessage
 */
Route::get('/chat', function () {
    event(new PublicMessage());
    dd('Public event executed successfully.');
});

/**
 * Al ejecutar esta ruta se disparara el evento PrivateMessage
 * Se enviara el usuario autenticado como parametro al evento
 */
Route::get('/private-chat', function () {
    event(new PrivateMessage(auth()->user()));
    dd('Private event executed successfully.');
});


Route::get('/chats-events', function () {
    return view('chats');
});
