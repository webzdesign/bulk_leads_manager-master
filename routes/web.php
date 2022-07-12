<?php

use App\Http\Controllers\AdminsController;
use App\Http\Controllers\AgeGroupController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\ImportHistoryController;
use App\Http\Controllers\LeadsController;
use App\Http\Controllers\LeadTypes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\NewOrderController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\StatsController;

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

Route::get('/', function () {
    return redirect('login');
});

Route::group(['middleware' => 'prevent-back-history'],function(){

    Auth::routes(['register' => false]);
    Route::group(['middleware' => ['auth']], function() {
        Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

        /* LeadTypes Route */
        Route::group(['prefix' => 'lead_type'], function(){
            Route::get('/', [LeadTypes::class, 'index'])->name('admin.lead_type.index');
            Route::post('/store_lead_type', [LeadTypes::class,'store_lead_type'])->name('admin.lead_type.store_lead_type');
            Route::post('/edit',[LeadTypes::class,'edit'])->name('admin.lead_type.edit');
            Route::post('/delete',[LeadTypes::class, 'delete'])->name('admin.lead_type.delete');

            /*Age Group Route */
            Route::post('/store_age_group',[AgeGroupController::class,'store_age_group'])->name('admin.lead_type.store_age_group');
            Route::post('/age_delete',[AgeGroupController::class,'age_delete'])->name('admin.lead_type.age_delete');
            Route::post('/age_edit',[AgeGroupController::class,'age_edit'])->name('admin.lead_type.age_edit');
        });

        /*Settings route*/
        Route::get('settings', [SettingController::class, 'index'])->name('settings');
        Route::post('site_setting_create', [SettingController::class, 'site_setting_create'])->name('site_setting_create');
        Route::post('email_setup_create', [SettingController::class, 'email_setup_create'])->name('email_setup_create');
        Route::post('email_template_create', [SettingController::class, 'email_template_create'])->name('email_template_create');

        Route::group(['prefix' => 'admins'], function(){
            Route::get('/index', [AdminsController::class, 'index'])->name('menu.admin.index');
            Route::get('/get-data',[AdminsController::class,'getData'])->name('admins.getData');
            Route::post('/store',[AdminsController::class,'store'])->name('admins.store');
            Route::post('/edit',[AdminsController::class,'edit'])->name('admin.edit');
            Route::post('/delete',[AdminsController::class,'delete'])->name('admin.delete');
            Route::post('/update',[AdminsController::class,'update'])->name('admin.update');
            Route::post('/checkEmailId',[AdminsController::class,'checkEmailId'])->name('admin.checkEmailId');
        });

        Route::group(['prefix' => 'import'], function() {
            Route::get('/',[ImportController::class, 'index'])->name('admin.import.index');
            Route::post('/importCSV',[ImportController::class, 'importCSV'])->name('admin.import.importCSV');
            Route::post('/start_upload',[ImportController::class, 'start_upload'])->name('admin.import.start_upload');
        });

        Route::group(['prefix' => 'clients'], function(){
            Route::get('/', [ClientsController::class, 'index'])->name('admin.clients.index');
            Route::get('/get-data',[ClientsController::class,'getData'])->name('admin.clients.getData');
            Route::post('/store',[ClientsController::class,'store'])->name('admin.client.store');
            Route::post('/edit',[ClientsController::class,'edit'])->name('admin.client.edit');
            Route::post('/delete',[ClientsController::class,'delete'])->name('admin.client.delete');
            Route::post('/filter',[ClientsController::class,'filter'])->name('admin.client.filter');
            Route::post('/checkEmailId',[ClientsController::class,'checkEmailId'])->name('admin.client.checkEmailId');
        });

        Route::group(['prefix' => 'import-history'], function(){
            Route::get('/', [ImportHistoryController::class, 'index'])->name('admin.import-history');
        });

        Route::group(['prefix' => 'leads'], function(){
            Route::get('/', [LeadsController::class, 'index'])->name('admin.leads');
        });

        Route::group(['prefix' => 'orders'], function(){
            Route::get('/', [OrdersController::class, 'index'])->name('admin.orders');
        });

        Route::group(['prefix' => 'stats'], function(){
            Route::get('/', [StatsController::class, 'index'])->name('admin.stats');
        });



        /*New order route*/
        Route::group(['prefix' => 'new-order'], function(){
            Route::get('/', [NewOrderController::class, 'index'])->name('admin.new-order');
            Route::post('/create-client', [NewOrderController::class, 'create_client'])->name('admin.create-client');
        });
    });
});
