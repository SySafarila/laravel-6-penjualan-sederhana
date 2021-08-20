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

Route::redirect('/home', '/')->name('home');

// products
Route::resource('seller/products', 'ProductsController')->except('show');
Route::get('/products/{product}', 'ProductsController@show')->name('products.show');

// carts
Route::resource('carts', 'CartsController');

// invoices
Route::resource('invoices', 'InvoicesController');
Route::patch('invoices/{invoice}/upload-image', 'InvoicesController@uploadImage')->name('invoices.uploadImage');
Route::patch('invoices/{invoice}/accept-payment', 'InvoicesController@acceptPayment')->name('invoices.acceptPayment');
Route::patch('invoices/{invoice}/decline-payment', 'InvoicesController@declinePayment')->name('invoices.declinePayment');
Route::patch('invoices/{invoice}/cancel-payment', 'InvoicesController@cancelPayment')->name('invoices.cancelPayment');
Route::patch('invoices/{invoice}/cancel-invoice', 'InvoicesController@cancelInvoice')->name('invoices.cancelInvoice');
Route::get('/seller/invoices', 'InvoicesController@sellerIndex')->name('seller.invoices.index');
Route::get('/seller/invoices/{invoice}', 'InvoicesController@sellerShow')->name('seller.invoices.show');

// search products
Route::get('/seller/search-products', 'SearchController@searchProductsSeller')->name('seller.search.products');
Route::get('/search-products', 'SearchController@searchProducts')->name('search.products');

// search invoices
Route::get('/seller/search-invoices', 'SearchController@searchInvoicesSeller')->name('seller.search.invoices');
Route::get('/search-invoices', 'SearchController@searchInvoices')->name('search.invoices');

// account
Route::get('/account', 'AccountsController@index')->name('account.index');
Route::patch('/account', 'AccountsController@updateCredentials')->name('account.updateCredentials');
