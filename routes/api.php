<?php

/**
 * Author: Aubrey Nickerson
 * Date: May 25th, 2021
 * Program: api.php
 * Project: Global Protection Code Challenge
 */

use Illuminate\Http\Request;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Create a person. User must have API key to create a person.
// API key gets passed to middleware() for authorization.
Route::post('person/{api_token}', 'App\Http\Controllers\ApiController@createPerson')->middleware('api_token');
// Find a person with their ID. User must have API key.
// ID gets passed to getPerson() function in ApiController Controller.
Route::get('person/{id}/{api_token}', 'App\Http\Controllers\ApiController@getPerson')->middleware('api_token');
// Find the ten most recently created people along with API key.
Route::get('person/{api_token}', 'App\Http\Controllers\ApiController@getFirstTenPeople')->middleware('api_token');
// Retrieve statistics with API key.
Route::get('statistics/{api_token}', 'App\Http\Controllers\ApiController@getStatistics')->middleware('api_token');
