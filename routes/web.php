<?php

use App\Http\Controllers\AdminsController;
use App\Http\Controllers\AgeGroupController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LeadTypes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\NewOrderController;

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
            Route::get('/', [AdminsController::class, 'index'])->name('admins.index');
            Route::get('/get-data',[AdminsController::class,'getData'])->name('admins.getData');
            Route::post('/store',[AdminsController::class,'store'])->name('admins.store');
            Route::post('/edit',[AdminsController::class,'edit'])->name('admin.edit');
            Route::post('/delete',[AdminsController::class,'delete'])->name('admin.delete');
            Route::post('/update',[AdminsController::class,'update'])->name('admin.update');
        });

        /*New order route*/
        Route::group(['prefix' => 'new-order'], function(){
            Route::get('/', [NewOrderController::class, 'index'])->name('admin.new-order');
            Route::post('/add-client', [NewOrderController::class, 'add_client'])->name('admin.add-client');
        });
    });
});
