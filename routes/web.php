<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\ChartController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('demo', [DemoController::class, 'index']);
Route::post('demosubmit', [DemoController::class, 'store']);

Route::get('chart', [ChartController::class, 'index']);
Route::post('chartsubmit', [ChartController::class, 'store']);


//Route::post('games', 'GamesController@store');
//Route::get('demo', 'DemoController@index');
//[PostController::class, 'index']
// Route::get('demo', function () {
    // return view('welcome');
// });