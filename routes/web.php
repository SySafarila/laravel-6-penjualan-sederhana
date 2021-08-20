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

Route::resource('invoices', 'InvoicesController');
Route::patch('invoices/{invoice}/upload-image', 'InvoicesController@uploadImage')->name('invoices.uploadImage');
Route::patch('invoices/{invoice}/accept-payment', 'InvoicesController@acceptPayment')->name('invoices.acceptPayment');
Route::patch('invoices/{invoice}/decline-payment', 'InvoicesController@declinePayment')->name('invoices.declinePayment');
Route::patch('invoices/{invoice}/cancel-payment', 'InvoicesController@cancelPayment')->name('invoices.cancelPayment');
Route::get('/seller/invoices', 'InvoicesController@sellerIndex')->name('seller.invoices.index');
Route::get('/seller/invoices/{invoice}', 'InvoicesController@sellerShow')->name('seller.invoices.show');
