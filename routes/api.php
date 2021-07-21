<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route:: get('password', function(){
    return bcrypt('salsa');
});

    Route::get('atlet', 'API\SportController@index');
    Route::get('atlet/{id}','API\SportController@show')->middleware('auth:api');
    Route::post('atlet','API\SportController@store')->middleware('auth:api');
    Route::patch('atlet/{id}','API\SportController@update')->middleware('auth:api');
    Route::delete('atlet/{id}','API\SportController@destroy')->middleware('auth:api');

    Route::get('pelatih', 'API\CoachController@index');
    Route::get('pelatih/{id}','API\CoachController@show')->middleware('auth:api');
    Route::post('pelatih','API\CoachController@store')->middleware('auth:api');
    Route::patch('pelatih/{id}','API\CoachController@update')->middleware('auth:api');
    Route::delete('pelatih/{id}','API\CoachController@destroy')->middleware('auth:api');

    Route::group([

        'middleware' => 'api',
        'prefix' => 'auth'
    
    ], function ($router) {
    
        Route::post('login', 'AuthController@login');
        Route::post('logout', 'AuthController@logout');
        Route::post('refresh', 'AuthController@refresh');
        Route::post('me', 'AuthController@me');
    
    });


