<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V2IndexController;
use App\Http\Controllers\V2NewAcountController;
use App\Http\Controllers\V2DemoAcountController;
use App\Http\Controllers\V2LoginController;
use App\Http\Controllers\V2ContactController;
use App\Http\Controllers\V2CompanyController;
use App\Http\Controllers\V2FaqController;
use App\Http\Controllers\V2UserController;
use App\Http\Controllers\V2TransferController;
use App\Http\Controllers\V2AddAcountController;
use App\Http\Controllers\V2DepositController;


Route::get('', [V2IndexController::class, 'index'])->name('index');

Route::get('new_acount', [V2NewAcountController::class, 'new_acount'])->name('new_acount');
Route::post('indi_confirm', [V2NewAcountController::class, 'indi_confirm'])->name('indi_confirm');
Route::post('corp_confirm', [V2NewAcountController::class, 'corp_confirm'])->name('corp_confirm');
Route::get('new_acount_complete', [V2NewAcountController::class, 'new_acount_complete'])->name('new_acount_complete');

Route::get('demo_acount', [V2DemoAcountController::class, 'demo_acount'])->name('demo_acount');
Route::post('demo_confirm', [V2DemoAcountController::class, 'demo_confirm'])->name('demo_confirm');
Route::get('demo_acount_complete', [V2DemoAcountController::class, 'demo_acount_complete'])->name('demo_acount_complete');

Route::get('login', [V2LoginController::class, 'login'])->name('login');
Route::post('login_function', [V2LoginController::class, 'login_function'])->name('login_function');
Route::post('login_function2', [V2LoginController::class, 'login_function2'])->name('login_function2');

Route::get('login2', [V2LoginController::class, 'login2'])->name('login2');
Route::get('logout', [V2LoginController::class, 'logout'])->name('logout');

Route::get('contact', [V2ContactController::class, 'contact'])->name('contact');
Route::post('contact_confirm', [V2ContactController::class, 'contact_confirm'])->name('contact_confirm');
Route::get('contact_complete', [V2ContactController::class, 'contact_complete'])->name('contact_complete');

Route::get('company', [V2CompanyController::class, 'company'])->name('company');
Route::get('faq', [V2FaqController::class, 'faq'])->name('faq');


// 以下ユーザーページ
Route::get('summary', [V2UserController::class, 'summary'])->name('summary')->middleware('login');
Route::get('history', [V2UserController::class, 'history'])->name('history')->middleware('login');

Route::get('deposit', [V2DepositController::class, 'deposit'])->name('deposit')->middleware('login');
Route::get('crypto_payment', [V2DepositController::class, 'crypto_payment'])->name('crypto_payment')->middleware('login');
Route::post('crypto_payment_confirm', [V2DepositController::class, 'crypto_payment_confirm'])->name('crypto_payment_confirm')->middleware('login');
Route::get('txid', [V2DepositController::class, 'txid'])->name('txid')->middleware('login');
Route::post('txid_confirm', [V2DepositController::class, 'txid_confirm'])->name('txid_confirm')->middleware('login');
Route::get('payment_complete', [V2DepositController::class, 'payment_complete'])->name('payment_complete')->middleware('login');
Route::get('withdraw', [V2DepositController::class, 'withdraw'])->name('withdraw')->middleware('login');
Route::post('bank_withdraw_confirm', [V2DepositController::class, 'bank_withdraw_confirm'])->name('bank_withdraw_confirm')->middleware('login');
Route::post('crypto_withdraw_confirm', [V2DepositController::class, 'crypto_withdraw_confirm'])->name('crypto_withdraw_confirm')->middleware('login');
Route::get('withdraw_complete', [V2DepositController::class, 'withdraw_complete'])->name('withdraw_complete')->middleware('login');


Route::get('transfer', [V2TransferController::class, 'transfer'])->name('transfer')->middleware('login');
Route::post('transfer_confirm', [V2TransferController::class, 'transfer_confirm'])->name('transfer_confirm')->middleware('login');
Route::get('transfer_complete', [V2TransferController::class, 'transfer_complete'])->name('transfer_complete')->middleware('login');

Route::get('add_acount', [V2AddAcountController::class, 'add_acount'])->name('add_acount')->middleware('login');
Route::post('add_confirm', [V2AddAcountController::class, 'add_confirm'])->name('add_confirm')->middleware('login');
Route::get('add_acount_complete', [V2AddAcountController::class, 'add_acount_complete'])->name('add_acount_complete')->middleware('login');

Route::get('setting', [V2UserController::class, 'setting'])->name('setting')->middleware('login');
Route::get('setting2', [V2UserController::class, 'setting2'])->name('setting2')->middleware('login');

Route::get('activate_2fa', [V2UserController::class, 'activate_2fa'])->name('activate_2fa')->middleware('login');
Route::get('inactivate_2fa', [V2UserController::class, 'inactivate_2fa'])->name('inactivate_2fa')->middleware('login');
