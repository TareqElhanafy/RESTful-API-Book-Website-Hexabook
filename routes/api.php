<?php

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

//Users
Route::resource('users','User\UserController',['except'=>['create','edit']]);
Route::resource('users.categories.freebooks','User\UserCategoryFreebookController');


//Buyer
Route::resource('buyers','Buyer\BuyerController',['only'=>['index','show']]);
Route::resource('buyers.sellers','Buyer\BuyerSellerController',['only'=>'index']);
Route::resource('buyers.transactions','Buyer\BuyerTransactionController',['only'=>'index']);
Route::resource('buyers.paidbooks','Buyer\BuyerPaidbookController',['only'=>'index']);
Route::resource('buyers.categories','Buyer\BuyerCategoryController',['only'=>'index']);

//Seller
Route::resource('sellers','Seller\SellerController',['only'=>['index','show']]);
Route::resource('sellers.transactions','Seller\SellerTransactionController',['only'=>['index']]);
Route::resource('sellers.categories','Seller\SellerCategoryController',['only'=>['index']]);
Route::resource('sellers.buyers','Seller\SellerBuyerController',['only'=>['index']]);
Route::resource('sellers.products','Seller\SellerProductController',['except'=>['create','edit','show']]);
//Category
Route::resource('categories','Category\CategoryController',['except'=>['create','edit']]);
//Freebooks
Route::resource('freebooks','Freebook\FreebookController',['except'=>['create','edit']]);
//Paidbooks
Route::resource('paidbooks','Paidbook\PaidbookController',['only'=>['index','show']]);
Route::resource('paidbooks.transactions','Paidbook\PaidbookTransactionController',['only'=>['index']]);
Route::resource('paidbooks.buyers','Paidbook\PaidbookBuyerController',['only'=>['index']]);
Route::resource('paidbooks.categories','Paidbook\PaidbookCategoryController',['only'=>['index','update','destroy']]);
Route::resource('paidbooks.buyers.transactions','Paidbook\PaidbookBuyerTransactionController',['only'=>['store']]);
//Transactions
Route::resource('transactions','Transaction\TransactionController',['only'=>['index','show']]);
Route::resource('transactions.categories','Transaction\TransactionCategoryController',['only'=>'index']);
Route::resource('transactions.sellers','Transaction\TransactionSellerController',['only'=>'index']);

//Discusiions
Route::resource('discussions','Discussion\DiscussionController',['only'=>'index','show']);

//Verification System
Route::get('user/{token}/verify','User\UserController@verify')->name('verify');
Route::get('users/{user}/resend','User\UserController@resend');
//
Route::post('oauth/token','\Laravel\Passport\Http\Controllers\AccessTokenController@issueToken');
