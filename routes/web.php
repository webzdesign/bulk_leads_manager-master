<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LeadTypes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SettingController;

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
        });

        /*Settings route*/
        Route::get('settings', [SettingController::class, 'index'])->name('settings');
        Route::post('site_setting_create', [SettingController::class, 'site_setting_create'])->name('site_setting_create');
    });
});
