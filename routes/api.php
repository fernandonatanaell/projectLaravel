<?php

use App\Http\Controllers\API\Admin\APIAdminUsersController;
use App\Http\Controllers\API\APIItem;
use App\Http\Controllers\API\APILoginRegisterController;
use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('item')->group(function(){
    // == QUERY TO GET ALL ITEMS ==
    Route::get('/getall', [APIItem::class, 'getAllItems']);

    // == QUERY TO INSERT NEW ITEM ==
    Route::get('/insert', [APIItem::class, 'insert']);

    // == QUERY TO UPDATE ITEM ==
    Route::get
    ('/update', [APIItem::class, 'update']);

    // == QUERY TO DELETE ITEM ==
    Route::get('/delete', [APIItem::class, 'delete']);

    // == QUERY TO RESTORE ITEM ==
    Route::get('/restore', [APIItem::class, 'restore']);
});

Route::prefix('users')->group(function(){
    Route::get('/getall', [APIAdminUsersController::class, 'getAll']);
    Route::get('/get/{user_id}', [APIAdminUsersController::class, 'get']);
    Route::post('/insert', [APIAdminUsersController::class, 'insert']);
    Route::post('/changePassword', [APIAdminUsersController::class, 'changePassword']);
    Route::post('/update', [APIAdminUsersController::class, 'update']);
    Route::get('/delete/{user_id}', [APIAdminUsersController::class, 'delete']);
});


// == LOGOUT ==
Route::get('/dologout', [APILoginRegisterController::class, 'doLogout']);


// == LOGIN ==
Route::post('/dologin', [APILoginRegisterController::class, 'doLogin']);

// == REGISTER ==
Route::post('/doregister', [APILoginRegisterController::class, 'doRegister']);
