<?php

use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\RegisterApiController;

Route::post('/registerstaff', [RegisterApiController::class, 'registerstaff']);

Route::post('staff/add', [StaffController::class, 'store']);

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
});

