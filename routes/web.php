<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TextController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\IndexController;


use App\Http\Controllers\V2DemoAcountController;
use App\Http\Controllers\V2ContactController;
use App\Http\Controllers\V2CompanyController;
use App\Http\Controllers\V2FaqController;
use App\Http\Controllers\V2UserController;
use App\Http\Controllers\V2TransferController;
use App\Http\Controllers\V2AddAcountController;
use App\Http\Controllers\V2DepositController;


Route::get('', [IndexController::class, 'index'])->name('index');

Route::get('login', [LoginController::class, 'login'])->name('login');
Route::post('login_function', [LoginController::class, 'login_function'])->name('login_function');
Route::post('login_function2', [LoginController::class, 'login_function2'])->name('login_function2');

Route::get('login2', [LoginController::class, 'login2'])->name('login2');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');




// 以下ユーザーページ
Route::get('summary', [V2UserController::class, 'summary'])->name('summary');
Route::get('history', [V2UserController::class, 'history'])->name('history');

Route::get('event_list', [EventController::class, 'event_list'])->name('event_list');
Route::get('event_show/{id}', [EventController::class, 'event_show'])->name('event_show');
Route::get('event_add/{id}', [EventController::class, 'event_add'])->name('event_add');
Route::post('event_store', [EventController::class, 'event_store'])->name('event_store');


Route::get('text_regist', [TextController::class, 'text_regist'])->name('text_regist');
Route::post('text_store', [TextController::class, 'text_store'])->name('text_store');
Route::get('text_list', [TextController::class, 'text_list'])->name('text_list');
Route::get('text_show/{id}', [TextController::class, 'text_show'])->name('text_show');
Route::get('text_edit/{id}', [TextController::class, 'text_edit'])->name('text_edit');
Route::post('text_update', [TextController::class, 'text_update'])->name('text_update');
Route::get('text_delete/{id}/', [TextController::class, 'text_delete'])->name('text_delete');
Route::get('text_category_list', [TextController::class, 'text_category_list'])->name('text_category_list');
Route::post('text_category_store', [TextController::class, 'text_category_store'])->name('text_category_store');
Route::get('text_category_delete/{id}/', [TextController::class, 'text_category_delete'])->name('text_category_delete');

Route::get('admin_regist', [AdminController::class, 'admin_regist'])->name('admin_regist');
Route::post('admin_store', [AdminController::class, 'admin_store'])->name('admin_store');
Route::get('admin_list', [AdminController::class, 'admin_list'])->name('admin_list');





Route::get('deposit', [V2DepositController::class, 'deposit'])->name('deposit');
Route::get('crypto_payment', [V2DepositController::class, 'crypto_payment'])->name('crypto_payment');
Route::post('crypto_payment_confirm', [V2DepositController::class, 'crypto_payment_confirm'])->name('crypto_payment_confirm');
Route::get('txid', [V2DepositController::class, 'txid'])->name('txid');
Route::post('txid_confirm', [V2DepositController::class, 'txid_confirm'])->name('txid_confirm');
Route::get('payment_complete', [V2DepositController::class, 'payment_complete'])->name('payment_complete');
Route::get('withdraw', [V2DepositController::class, 'withdraw'])->name('withdraw');
Route::post('bank_withdraw_confirm', [V2DepositController::class, 'bank_withdraw_confirm'])->name('bank_withdraw_confirm');
Route::post('crypto_withdraw_confirm', [V2DepositController::class, 'crypto_withdraw_confirm'])->name('crypto_withdraw_confirm');
Route::get('withdraw_complete', [V2DepositController::class, 'withdraw_complete'])->name('withdraw_complete');


Route::get('transfer', [V2TransferController::class, 'transfer'])->name('transfer');
Route::post('transfer_confirm', [V2TransferController::class, 'transfer_confirm'])->name('transfer_confirm');
Route::get('transfer_complete', [V2TransferController::class, 'transfer_complete'])->name('transfer_complete');

Route::get('add_acount', [V2AddAcountController::class, 'add_acount'])->name('add_acount');
Route::post('add_confirm', [V2AddAcountController::class, 'add_confirm'])->name('add_confirm');
Route::get('add_acount_complete', [V2AddAcountController::class, 'add_acount_complete'])->name('add_acount_complete');

Route::get('setting', [V2UserController::class, 'setting'])->name('setting');
Route::get('setting2', [V2UserController::class, 'setting2'])->name('setting2');

Route::get('activate_2fa', [V2UserController::class, 'activate_2fa'])->name('activate_2fa');
Route::get('inactivate_2fa', [V2UserController::class, 'inactivate_2fa'])->name('inactivate_2fa');
