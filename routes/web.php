<?php

use Illuminate\Support\Facades\Route;

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

@include_once('admin_web.php');

Route::get('/', function () {
    return redirect()->route('login');
})->name('/');

Route::prefix('auth')->group(function (){
    Route::get('login', 'App\Http\Controllers\AuthController@index')->name('login');
    Route::post('login', 'App\Http\Controllers\AuthController@login')->name('doLogin');
    Route::get('logout', 'App\Http\Controllers\AuthController@logout')->name('doLogout');
    Route::get('forget-password', 'App\Http\Controllers\AuthController@index')->name('forget-password');
    Route::get('sign-up', 'App\Http\Controllers\AuthController@index')->name('sign-up');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('dashboard', 'App\Http\Controllers\DashboardController@index')->name('dashboard');
    Route::resource('pengaturan/tarif-berlaku', 'App\Http\Controllers\Pengaturan\TarifBerlakuController');
    Route::resource('pengaturan/tarif-flat', 'App\Http\Controllers\Pengaturan\TarifFlatController');
    Route::resource('pengaturan/tarif-progressive', 'App\Http\Controllers\Pengaturan\TarifProgressiveController');
    Route::resource('pengaturan/tarif-member', 'App\Http\Controllers\Pengaturan\TarifMemberController');
    Route::resource('operator', 'App\Http\Controllers\OperatorController');
});

Route::prefix('starter-kit')->group(function () {
    Route::view('index', 'admin.color-version.index')->name('index');
});