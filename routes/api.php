<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/products/{page?}", [ProductController::class, "index"]);

Route::get("/product/{id?}", [ProductController::class, "getProductByProductId"]);
Route::post("/addProduct", [ProductController::class, "addProduct"]);
Route::put("/updateProduct", [ProductController::class, "updateProduct"]);

Route::delete("/deleteProduct/{id}", [ProductController::class, "deleteProduct"]);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get("search/{name}", [ProductController::class, "search"]);
});

Route::post("/login", [UserController::class, 'index']);
// Route::get("/authFailed", [UserController::class, 'login']);
