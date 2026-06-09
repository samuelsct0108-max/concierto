<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeatSoldController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\SeatController;

Route::get('/', function () {return view('frontend.reservation');});
Route::get('/consult-reservation', function () {return view('frontend.consult-reservation');});
Route::get('/form-login', function () {return view('principal.login');});
Route::post('/system/login', [UserController::class, 'login']);
Route::get('/system/download-ticket/{id}', [SeatController::class, 'downloadTicket']);

Route::get('/system/send-ticket-customer/{id}', [SeatController::class, 'sendTicketToCustomer']);

Route::post('/system/masive-sell-seats', [SeatSoldController::class, 'massiveSellSeat']);
Route::post('/system/send-masive-sell-seats', [SeatSoldController::class, 'sendMassiveSellSeat']);
Route::get('/system/download-masive-sell-seats/{email}/{name}', [SeatSoldController::class, 'sendMassiveSellSeat']);
// Route::get('/system/send-masive-sell-seats/{email}/{name}', [SeatSoldController::class, 'sendMassiveSellSeat']);
// Route::get('/system/send-masive-sell-seats/{email}/{name}', [SeatSoldController::class, 'sendMassiveSellSeat']);



Route::group(['middleware' => 'admin'], function () {

    Route::get('/system', function () {return view('dist.dashboard');});
    Route::get('/system/sales', function () {return view('dist.sales');});
    Route::get('/system/dashboard', function () {return view('dist.dashboard');});
    Route::post('/system/sell-seats', [SeatSoldController::class, 'sellSeat']);
    Route::get('/system/users', function () {return view('dist.users');});
    Route::post('/system/create-user', [UserController::class, 'createUser']);
    Route::get('/system/edit-user/{id}', function ($id) {
        $user = DB::select('select * from users_gmos where id = ?', [$id]);
        $roles = DB::select('select * from roles_gmos');
        return view('dist.edit-user',compact('roles','id','user'));
    });


    Route::post('/system/update-user', [UserController::class, 'updateUser']);
    Route::get('/system/delete-user/{id}', [UserController::class, 'deleteUser']);
    Route::get('/system/logout', [UserController::class, 'logout']);
    Route::get('/system/admin-sales', function () {return view('dist.admin-sales');});
    Route::get('/system/admin-sale/{id}', function ($id) {
        return view('dist.edit-sale',compact('id'));
    });

    //collect money
    Route::get('/system/collect-money', function () {return view('dist.collect-money');});
    Route::get('/system/add-collect/{id}', function ($id) {return view('dist.add-collect',compact('id'));});
    Route::post('/system/store-collect', [CollectionController::class, 'store']);
    Route::get('/system/delete-collect/{id}', [CollectionController::class, 'destroy']);
});
