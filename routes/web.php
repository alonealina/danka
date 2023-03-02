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
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\CsvController;


Route::get('', [IndexController::class, 'index'])->name('index');

Route::get('login', [LoginController::class, 'login'])->name('login');
Route::post('login_function', [LoginController::class, 'login_function'])->name('login_function');
Route::post('login_function2', [LoginController::class, 'login_function2'])->name('login_function2');

Route::get('login2', [LoginController::class, 'login2'])->name('login2');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');


// 以下ユーザーページ

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
Route::post('gojikaihi_update', [DankaController::class, 'gojikaihi_update'])->name('gojikaihi_update');
Route::get('family_regist/{danka_id}', [DankaController::class, 'family_regist'])->name('family_regist');
Route::post('family_store', [DankaController::class, 'family_store'])->name('family_store');
Route::get('family_edit/{family_id}', [DankaController::class, 'family_edit'])->name('family_edit');
Route::post('family_update', [DankaController::class, 'family_update'])->name('family_update');

Route::get('danka_csv_test', [CsvController::class, 'danka_csv_test'])->name('danka_csv_test');
Route::post('danka_csv_import', [CsvController::class, 'danka_csv_import'])->name('danka_csv_import');
Route::get('hikuyousya_csv_test', [CsvController::class, 'hikuyousya_csv_test'])->name('hikuyousya_csv_test');
Route::post('hikuyousya_csv_import', [CsvController::class, 'hikuyousya_csv_import'])->name('hikuyousya_csv_import');
Route::get('family_csv_test', [CsvController::class, 'family_csv_test'])->name('family_csv_test');
Route::post('family_csv_import', [CsvController::class, 'family_csv_import'])->name('family_csv_import');
Route::get('deal_csv_test', [CsvController::class, 'deal_csv_test'])->name('deal_csv_test');
Route::post('deal_csv_import', [CsvController::class, 'deal_csv_import'])->name('deal_csv_import');
Route::get('nenki_csv_test', [CsvController::class, 'nenki_csv_test'])->name('nenki_csv_test');
Route::post('nenki_csv_import', [CsvController::class, 'nenki_csv_import'])->name('nenki_csv_import');
Route::get('konryu_csv_test', [CsvController::class, 'konryu_csv_test'])->name('konryu_csv_test');
Route::post('konryu_csv_import', [CsvController::class, 'konryu_csv_import'])->name('konryu_csv_import');



Route::post('danka_csv_export', [DankaController::class, 'danka_csv_export'])->name('danka_csv_export');
Route::post('hikuyousya_csv_export', [DankaController::class, 'hikuyousya_csv_export'])->name('hikuyousya_csv_export');

Route::get('db_test', [DankaController::class, 'db_test'])->name('db_test');





Route::get('deal_list', [PaymentController::class, 'deal_list'])->name('deal_list');
Route::post('unclaimed_update', [PaymentController::class, 'unclaimed_update'])->name('unclaimed_update');
Route::post('unpaid_update', [PaymentController::class, 'unpaid_update'])->name('unpaid_update');
Route::post('paid_update', [PaymentController::class, 'paid_update'])->name('paid_update');
Route::get('deal_detail/{id}', [PaymentController::class, 'deal_detail'])->name('deal_detail');
Route::get('deal_edit/{id}', [PaymentController::class, 'deal_edit'])->name('deal_edit');
Route::post('deal_edit_confirm', [PaymentController::class, 'deal_edit_confirm'])->name('deal_edit_confirm');
Route::post('deal_update', [PaymentController::class, 'deal_update'])->name('deal_update');
Route::get('deal_delete/{id}', [PaymentController::class, 'deal_delete'])->name('deal_delete');

Route::get('deal_regist', [PaymentController::class, 'deal_regist'])->name('deal_regist');
Route::post('deal_confirm', [PaymentController::class, 'deal_confirm'])->name('deal_confirm');
Route::post('deal_store', [PaymentController::class, 'deal_store'])->name('deal_store');

Route::post('deal_csv_export', [PaymentController::class, 'deal_csv_export'])->name('deal_csv_export');


Route::get('item_list', [PaymentController::class, 'item_list'])->name('item_list');
Route::post('item_store', [PaymentController::class, 'item_store'])->name('item_store');
Route::get('item_edit/{id}', [PaymentController::class, 'item_edit'])->name('item_edit');
Route::post('item_update', [PaymentController::class, 'item_update'])->name('item_update');
Route::get('item_delete/{id}', [PaymentController::class, 'item_delete'])->name('item_delete');


Route::get('event_list', [EventController::class, 'event_list'])->name('event_list');
Route::get('event_show/{id}', [EventController::class, 'event_show'])->name('event_show');
Route::get('event_regist/{id}', [EventController::class, 'event_regist'])->name('event_regist');
Route::get('event_regist_search', [EventController::class, 'event_regist_search'])->name('event_regist_search');
Route::post('event_regist_search', [EventController::class, 'event_regist_search'])->name('event_regist_search');
Route::post('event_store', [EventController::class, 'event_store'])->name('event_store');
Route::get('event_date_show/{id}', [EventController::class, 'event_date_show'])->name('event_date_show');
Route::get('event_book_regist/{id}', [EventController::class, 'event_book_regist'])->name('event_book_regist');
Route::post('event_book_store', [EventController::class, 'event_book_store'])->name('event_book_store');

Route::get('event_send_update/{id}', [EventController::class, 'event_send_update'])->name('event_send_update');
Route::get('event_wait_update/{id}', [EventController::class, 'event_wait_update'])->name('event_wait_update');
Route::get('event_date_delete/{id}', [EventController::class, 'event_date_delete'])->name('event_date_delete');

Route::post('star_csv_export', [EventController::class, 'star_csv_export'])->name('star_csv_export');
Route::post('nenki_csv_export', [EventController::class, 'nenki_csv_export'])->name('nenki_csv_export');
Route::post('noukotsu_csv_export', [EventController::class, 'noukotsu_csv_export'])->name('noukotsu_csv_export');

Route::get('shipment_regist', [ShipmentController::class, 'shipment_regist'])->name('shipment_regist');
Route::post('shipment_store', [ShipmentController::class, 'shipment_store'])->name('shipment_store');
Route::get('shipment_list/{id}', [ShipmentController::class, 'shipment_list'])->name('shipment_list');
Route::get('shipment_show/{id}', [ShipmentController::class, 'shipment_show'])->name('shipment_show');
Route::get('shipment_dl/{id}', [ShipmentController::class, 'shipment_dl'])->name('shipment_dl');
Route::post('shipment_update', [ShipmentController::class, 'shipment_update'])->name('shipment_update');
Route::get('shipment_delete/{id}/', [ShipmentController::class, 'shipment_delete'])->name('shipment_delete');
Route::get('shipment_category_list', [ShipmentController::class, 'shipment_category_list'])->name('shipment_category_list');
Route::post('shipment_category_store', [ShipmentController::class, 'shipment_category_store'])->name('shipment_category_store');





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




