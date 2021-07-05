<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShortLinkController;
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

Route::get('decode_urls', ShortLinkController::class.'@index');
Route::post('encode', ShortLinkController::class.'@store')->name('generate.shorten.link.post');
   
Route::get('{code}', ShortLinkController::class.'@shortenLink')->name('shorten.link');

Route::get('statistics/{code}', ShortLinkController::class.'@statistics')->name('shorten.link');
