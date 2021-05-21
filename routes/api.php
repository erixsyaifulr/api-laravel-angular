<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;

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
Route::post('employees', 'EmployeeController@index');
Route::get('employee/{id}', 'EmployeeController@show');
Route::post('employee', 'EmployeeController@store');
Route::put('employee/{id}', 'EmployeeController@update');
Route::delete('employee/{id}', 'EmployeeController@destroy');

Route::post('listemployee', 'EmployeeController@listAll');

Route::get('salarys', 'SalaryController@index');
Route::get('salary/{id}', 'SalaryController@show');
Route::post('salary', 'SalaryController@store');
Route::put('salary/{id}', 'SalaryController@update');
Route::delete('salary/{id}', 'SalaryController@destroy');


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('register', 'UserController@register');
Route::post('login', 'UserController@login');