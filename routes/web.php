<?php

use App\Http\Controllers\AdminsController;
use App\Http\Controllers\AgeGroupController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\ImportHistoryController;
use App\Http\Controllers\LeadDeleteController;
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

Route::get('download/{path}', [OrdersController::class, 'download']);
Route::get('downloadZip/{path}', [LeadDeleteController::class, 'downloadZip']);
Route::post('import/download', [ImportController::class, 'downloadCsv'])->name('admin.import.download');
Route::any('import-history/downloadOriginal/{id}', [ImportHistoryController::class, 'downloadOriginal'])->name('admin.import-history.downloadOriginal');
Route::any('import-history/downloadDuplicate/{id}', [ImportHistoryController::class, 'downloadDuplicate'])->name('admin.import-history.downloadDuplicate');
Route::any('send-lead/{id}',[OrdersController::class,'sendLead'])->name('admin.send-lead');

Route::group(['middleware' => 'prevent-back-history'],function(){

    Auth::routes(['register' => false]);
    Route::group(['middleware' => ['auth']], function() {
        Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        Route::post('/dashboard-detail', [App\Http\Controllers\HomeController::class, 'getData'])->name('home.getData');
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
        Route::post('get_email_template', [SettingController::class, 'get_email_template'])->name('get-email-template');

        Route::group(['prefix' => 'admins'], function(){
            Route::get('/index', [AdminsController::class, 'index'])->name('menu.admin.index');
            Route::get('/get-data',[AdminsController::class,'getData'])->name('admins.getData');
            Route::post('/store',[AdminsController::class,'store'])->name('admins.store');
            Route::post('/edit',[AdminsController::class,'edit'])->name('admin.edit');
            Route::post('/delete',[AdminsController::class,'delete'])->name('admin.delete');
            Route::post('/update',[AdminsController::class,'update'])->name('admin.update');
        });

        Route::group(['prefix' => 'import'], function() {
            Route::get('/',[ImportController::class, 'index'])->name('admin.import.index');
            Route::post('/importCSV',[ImportController::class, 'importCSV'])->name('admin.import.importCSV');
            Route::post('/getData', [ImportController::class, 'getData'])->name('admin.import.getData');
            Route::post('/start_upload',[ImportController::class, 'start_upload'])->name('admin.import.start_upload');
            Route::post('/checkFileUpload', [ImportController::class, 'checkFileUpload'])->name('admin.import.checkFileUpload');
            Route::post('/checkLeadUploadProgress',[ImportController::class, 'checkLeadUploadProgress'])->name('admin.lead.upload_progress');
        });

        Route::group(['prefix' => 'clients'], function(){
            Route::get('/', [ClientsController::class, 'index'])->name('admin.clients.index');
            Route::get('/get-data',[ClientsController::class,'getData'])->name('admin.clients.getData');
            Route::post('/store',[ClientsController::class,'store'])->name('admin.client.store');
            Route::post('/edit',[ClientsController::class,'edit'])->name('admin.client.edit');
            Route::post('/delete',[ClientsController::class,'delete'])->name('admin.client.delete');
        });

        Route::group(['prefix' => 'import-history'], function(){
            Route::get('/', [ImportHistoryController::class, 'index'])->name('admin.import-history');
            Route::post('/get-data',[ImportHistoryController::class,'getData'])->name('admin.import-history.getData');
            Route::post('/getAge', [ImportHistoryController::class, 'getAge'])->name('admin.import-history.getAge');
        });

        Route::group(['prefix' => 'leads'], function(){
            Route::get('/', [LeadsController::class, 'index'])->name('admin.leads');
            Route::get('/get-data', [LeadsController::class, 'getData'])->name('admin.leads.getData');
            Route::post('/bulkRemove', [LeadsController::class, 'bulkRemove'])->name('admin.leads.bulkRemove');
            Route::post('/getAge', [LeadsController::class, 'getAge'])->name('admin.leads.getAge');

        });

        Route::group(['prefix' => 'orders'], function(){
            Route::get('/', [OrdersController::class, 'index'])->name('admin.orders');
            Route::get('/get-data',[OrdersController::class,'getData'])->name('admin.get-data');
        });

        Route::group(['prefix' => 'stats'], function(){
            Route::get('/', [StatsController::class, 'index'])->name('admin.stats');
            Route::post('/getStats', [StatsController::class, 'getStats'])->name('admin.stats.getStats');
        });

        /*New order route*/
        Route::group(['prefix' => 'new-order'], function(){
            Route::get('/', [NewOrderController::class, 'index'])->name('admin.new-order');
            Route::post('/create-client', [NewOrderController::class, 'create_client'])->name('admin.create-client');
            Route::post('/email-filter',[NewOrderController::class,'email_filter'])->name('admin.client.email-filter');
            Route::post('/age-group',[NewOrderController::class,'age_group'])->name('admin.age-group');
            Route::post('/count-total-leads-available',[NewOrderController::class,'count_total_leads_available'])->name('admin.count-total-leads-available');
            Route::post('/create-order',[NewOrderController::class,'create_order'])->name('admin.create-order');
            Route::post('/getState', [NewOrderController::class,'getState'])->name('admin.getState');
        });
    });
});
