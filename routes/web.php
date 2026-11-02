<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\CustomerRestaurantController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/customers', function () {
    return view('customer');
})->name('customers');

Route::get('/dashboard', function () {
    $user = \Illuminate\Support\Facades\Auth::user();

    $restaurants = $user->restaurants()->withCount('menuItems')->get();

    $menuItemsCount = $restaurants->sum('menu_items_count');

    return view('dashboard', compact('restaurants', 'menuItemsCount'));
})->middleware('auth')->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/restaurants', [RestaurantController::class, 'index'])
        ->name('restaurants.index');

    Route::get('/restaurant/create', [RestaurantController::class, 'create'])
        ->name('restaurant.create');

    Route::post('/restaurant', [RestaurantController::class, 'store'])
        ->name('restaurant.store');
    Route::get('/restaurants/{restaurant}/edit', [RestaurantController::class, 'edit'])
    ->name('restaurant.edit');

    Route::put('/restaurants/{restaurant}', [RestaurantController::class, 'update'])
    ->name('restaurant.update');
        
    Route::get('/menu-items', [MenuItemController::class, 'index'])
        ->name('menu-items.index');

    Route::get('/menu-items/create', [MenuItemController::class, 'create'])
        ->name('menu-items.create');

    Route::post('/menu-items', [MenuItemController::class, 'store'])
        ->name('menu-items.store');

    Route::get('/menu-items/{menuItem}/edit', [MenuItemController::class, 'edit'])
        ->name('menu-items.edit');

    Route::put('/menu-items/{menuItem}', [MenuItemController::class, 'update'])
        ->name('menu-items.update');

    Route::delete('/menu-items/{menuItem}', [MenuItemController::class, 'destroy'])
        ->name('menu-items.destroy');

    Route::patch('/menu-items/{menuItem}/availability', [MenuItemController::class, 'toggleAvailability'])
        ->name('menu-items.toggle');

});
Route::get('/discover', [CustomerRestaurantController::class, 'index'])
    ->name('customer.restaurants.index');

Route::get('/discover/{restaurant}', [CustomerRestaurantController::class, 'show'])
    ->name('customer.restaurants.show');
Route::get('/cart', [CartController::class, 'index'])
    ->name('cart.index');

Route::post('/cart/add/{menuItem}', [CartController::class, 'add'])
    ->name('cart.add');

Route::patch('/cart/update/{key}', [CartController::class, 'update'])
    ->name('cart.update');

Route::delete('/cart/remove/{key}', [CartController::class, 'remove'])
    ->name('cart.remove');
Route::middleware('auth')->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])
        ->name('checkout.index');

    Route::post('/checkout', [CheckoutController::class, 'store'])
        ->name('checkout.store');

    Route::get('/checkout/success/{order}', [
        CheckoutController::class,
        'success'
    ])->name('checkout.success');
});