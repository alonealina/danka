<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TextController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\DankaController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\CategoryController;


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

Route::get('danka_regist', [DankaController::class, 'danka_regist'])->name('danka_regist');
Route::post('danka_store', [DankaController::class, 'danka_store'])->name('danka_store');
Route::get('danka_search', [DankaController::class, 'danka_search'])->name('danka_search');
Route::get('hikuyousya_search', [DankaController::class, 'hikuyousya_search'])->name('hikuyousya_search');
Route::get('danka_detail/{id}', [DankaController::class, 'danka_detail'])->name('danka_detail');
Route::get('danka_edit/{id}', [DankaController::class, 'danka_edit'])->name('danka_edit');
Route::post('danka_update', [DankaController::class, 'danka_update'])->name('danka_update');
Route::get('hikuyousya_regist/{danka_id}', [DankaController::class, 'hikuyousya_regist'])->name('hikuyousya_regist');
Route::post('hikuyousya_store', [DankaController::class, 'hikuyousya_store'])->name('hikuyousya_store');
Route::get('hikuyousya_edit/{hikuyousya_id}', [DankaController::class, 'hikuyousya_edit'])->name('hikuyousya_edit');
Route::post('hikuyousya_update', [DankaController::class, 'hikuyousya_update'])->name('hikuyousya_update');
Route::get('family_regist/{danka_id}', [DankaController::class, 'family_regist'])->name('family_regist');
Route::post('family_store', [DankaController::class, 'family_store'])->name('family_store');
Route::get('family_edit/{family_id}', [DankaController::class, 'family_edit'])->name('family_edit');
Route::post('family_update', [DankaController::class, 'family_update'])->name('family_update');


Route::get('db_test', [DankaController::class, 'db_test'])->name('db_test');




Route::get('event_list', [EventController::class, 'event_list'])->name('event_list');
Route::get('event_show/{id}', [EventController::class, 'event_show'])->name('event_show');
Route::get('event_regist/{id}', [EventController::class, 'event_regist'])->name('event_regist');
Route::post('event_store', [EventController::class, 'event_store'])->name('event_store');
Route::get('event_book_show/{id}', [EventController::class, 'event_book_show'])->name('event_book_show');
Route::get('event_book_regist/{id}', [EventController::class, 'event_book_regist'])->name('event_book_regist');
Route::post('event_book_store', [EventController::class, 'event_book_store'])->name('event_book_store');

Route::get('unclaimed_list', [PaymentController::class, 'unclaimed_list'])->name('unclaimed_list');
Route::get('unpaid_list', [PaymentController::class, 'unpaid_list'])->name('unpaid_list');
Route::get('paid_list', [PaymentController::class, 'paid_list'])->name('paid_list');

Route::get('deal_list', [PaymentController::class, 'deal_list'])->name('deal_list');

Route::get('deal_regist', [PaymentController::class, 'deal_regist'])->name('deal_regist');
Route::post('deal_confirm', [PaymentController::class, 'deal_confirm'])->name('deal_confirm');
Route::post('deal_store', [PaymentController::class, 'deal_store'])->name('deal_store');


Route::get('item_list', [PaymentController::class, 'item_list'])->name('item_list');
Route::post('item_store', [PaymentController::class, 'item_store'])->name('item_store');
Route::get('item_edit/{id}', [PaymentController::class, 'item_edit'])->name('item_edit');
Route::post('item_update', [PaymentController::class, 'item_update'])->name('item_update');
Route::get('item_delete/{id}', [PaymentController::class, 'item_delete'])->name('item_delete');

Route::get('notice_regist', [NoticeController::class, 'notice_regist'])->name('notice_regist');
Route::post('notice_store', [NoticeController::class, 'notice_store'])->name('notice_store');
Route::get('notice_list', [NoticeController::class, 'notice_list'])->name('notice_list');
Route::get('notice_show/{id}', [NoticeController::class, 'notice_show'])->name('notice_show');
Route::get('notice_edit/{id}', [NoticeController::class, 'notice_edit'])->name('notice_edit');
Route::post('notice_update', [NoticeController::class, 'notice_update'])->name('notice_update');
Route::get('notice_delete/{id}/', [NoticeController::class, 'notice_delete'])->name('notice_delete');

Route::get('text_regist', [TextController::class, 'text_regist'])->name('text_regist');
Route::post('text_store', [TextController::class, 'text_store'])->name('text_store');
Route::get('text_list', [TextController::class, 'text_list'])->name('text_list');
Route::get('text_show/{id}', [TextController::class, 'text_show'])->name('text_show');
Route::get('text_edit/{id}', [TextController::class, 'text_edit'])->name('text_edit');
Route::post('text_update', [TextController::class, 'text_update'])->name('text_update');
Route::get('text_delete/{id}/', [TextController::class, 'text_delete'])->name('text_delete');
Route::get('text_category_list', [TextController::class, 'text_category_list'])->name('text_category_list');
Route::post('text_category_store', [TextController::class, 'text_category_store'])->name('text_category_store');

Route::get('category_list', [CategoryController::class, 'category_list'])->name('category_list');
Route::post('category_store', [CategoryController::class, 'category_store'])->name('category_store');
Route::get('shipment_category_delete/{id}/', [CategoryController::class, 'shipment_category_delete'])->name('shipment_category_delete');
Route::get('item_category_delete/{id}/', [CategoryController::class, 'item_category_delete'])->name('item_category_delete');
Route::get('text_category_delete/{id}/', [CategoryController::class, 'text_category_delete'])->name('text_category_delete');

Route::get('admin_regist', [AdminController::class, 'admin_regist'])->name('admin_regist');
Route::post('admin_store', [AdminController::class, 'admin_store'])->name('admin_store');
Route::get('admin_list', [AdminController::class, 'admin_list'])->name('admin_list');
Route::get('admin_delete/{id}/', [AdminController::class, 'admin_delete'])->name('admin_delete');





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
