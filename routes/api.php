<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

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


Route::get("/getCustomers",[HomeController::class, 'get_customers']);

Route::post("/createusers",[HomeController::class, 'create_users']);

Route::get("/getusers/{id}",[HomeController::class, 'show_users']);

Route::put("/getusers/{id}/edit",[HomeController::class, 'update_users']);

Route::delete("/getusers/{id}/delete",[HomeController::class, 'delete_users']);


Route::post("/addProduct",[AdminController::class, 'api_add_product']);
Route::get("/viewProducts",[AdminController::class, 'api_view_products']);
Route::get("/viewProduct/{id}",[AdminController::class, 'api_show_product']);
Route::post("/editProduct/{id}",[AdminController::class, 'api_edit_product']);
Route::delete("/deleteProduct/{id}",[AdminController::class, 'api_delete_product']);

