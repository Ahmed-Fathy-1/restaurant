<?php

use App\Http\Controllers\Api\MainController;
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

Route::controller(MainController::class)->group(function () {

    Route::post('check-availability', 'checkAvailability');

    Route::post('reserve-table', 'reserveTable');

    Route::get('all-menu', 'listAllItemsInMenu');

    Route::post('order', 'order');

    Route::post('order-invoice', 'orderInvoice');






});
