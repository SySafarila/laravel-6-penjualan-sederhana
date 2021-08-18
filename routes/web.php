<?php

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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@home')->name('root');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('seller/products', 'ProductsController')->except('show');
Route::get('/products/{product}', 'ProductsController@show')->name('products.show');

Route::resource('carts', 'CartsController');
