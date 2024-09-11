<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Customers_Report;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceArchiveController;
use App\Http\Controllers\InvoiceAttachmentsController;
use App\Http\Controllers\Invoices_Report;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\InvoicesDetailsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/home', [HomeController::class, 'index'])->name('home');



require __DIR__ . '/auth.php';

############################## Start Invoices #####################################

// Route::get('invoices', [InvoicesController::class, 'index']);
// Route::get('invoices/create', [InvoicesController::class, 'create']);
// Route::post('invoices/store', [InvoicesController::class, 'store']);
// Route::get('invoices/edite', [InvoicesController::class, 'edite']);
// Route::post('invoices/update', [InvoicesController::class, 'update']);
// Route::post('invoices/destroy', [InvoicesController::class, 'destroy'])->name('invoices.destroy');
Route::resource('invoices', InvoicesController::class);

############################## End Invoices #####################################

############################## Start Section #####################################

// Route::get('sections', [SectionController::class, 'index']);
// Route::get('sections/create', [SectionController::class, 'create']);
// Route::post('sections/stroe', [SectionController::class, 'store'])->name('sections.store');
// Route::get('sections/edite', [SectionController::class, 'edite']);
// Route::post('sections/update', [SectionController::class, 'update']);
// Route::post('sections/destroy', [SectionController::class, 'destroy']);
Route::resource('sections', SectionController::class);

############################## End Invoices #####################################

Route::resource('products', ProductController::class);

Route::resource('InvoiceAttachments', InvoiceAttachmentsController::class);

Route::get('/section/{id}', [InvoicesController::class, 'getproducts']);

Route::get('/InvoicesDetails/{id}', [InvoicesDetailsController::class, 'edit']);

Route::post('delete_file', [InvoicesDetailsController::class, 'destroy'])->name('delete_file');

Route::get('/edit_invoice/{id}', [InvoicesController::class, 'edit']);

Route::get('/Status_show/{id}', [InvoicesController::class, 'show'])->name('Status_show');

Route::post('/Status_Update/{id}', [InvoicesController::class, 'Status_Update'])->name('Status_Update');

Route::resource('Archive', InvoiceArchiveController::class);

Route::get('Invoice_Paid', [InvoicesController::class, 'Invoice_Paid']);

Route::get('Invoice_UnPaid', [InvoicesController::class, 'Invoice_UnPaid']);

Route::get('Invoice_Partial', [InvoicesController::class, 'Invoice_Partial']);

Route::get('Print_invoice/{id}', [InvoicesController::class, 'Print_invoice']);

Route::get('export_invoices', 'InvoicesController@export');


Route::group(['middleware' => ['auth']], function () {

    Route::resource('roles', RoleController::class);

    Route::resource('users', UserController::class);
});


Route::get('invoices_report', [Invoices_Report::class, 'index']);

Route::post('Search_invoices', [Invoices_Report::class, 'Search_invoices']);

Route::get('customers_report', [Customers_Report::class, 'index'])->name("customers_report");

Route::post('Search_customers',  [Customers_Report::class, 'Search_customers']);

Route::get('download/{invoice_number}/{file_name}', [InvoicesDetailsController::class, 'get_file']);

Route::get('View_file/{invoice_number}/{file_name}', [InvoicesDetailsController::class, 'open_file']);

Route::get('markAsRead/{notifi_id}/{id}', [InvoicesController::class, 'MarkAsRead'])->name('markAsRead');

Route::get('markAsRead_all', [InvoicesController::class, 'MarkAsRead_all'])->name('markAsRead_all');

Route::get('/{page}', [AdminController::class, 'index']);
