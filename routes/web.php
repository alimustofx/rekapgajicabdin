<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SalaryPeriodController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\RevisionController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\PayrollTemplateController;
use App\Http\Controllers\RekapController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\UnmatchedDocumentController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return Inertia::render('Welcome');
});

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Profile
    |--------------------------------------------------------------------------
    */

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    /*
    |--------------------------------------------------------------------------
    | Dokumen Gaji
    |--------------------------------------------------------------------------
    */

    Route::get('/dokumen/{document}', [DocumentController::class, 'show'])
        ->name('documents.show');

    Route::get('/dokumen/{document}/download', [DocumentController::class, 'download'])
        ->name('documents.download');

    Route::post('/dokumen/{document}/fix', [DocumentController::class, 'fix'])
        ->name('documents.fix');

    Route::post('/dokumen/{document}/ajukan-perbaikan', [DocumentController::class, 'requestRevision'])
        ->name('documents.request-revision');

    /*
    |--------------------------------------------------------------------------
    | Payroll Operator
    |--------------------------------------------------------------------------
    */

    Route::get('/payroll', [PayrollController::class, 'show'])
        ->name('payroll.show');

    Route::post('/payroll/{payroll}/upload', [PayrollController::class, 'upload'])
        ->name('payroll.upload');

    /*
    |--------------------------------------------------------------------------
    | Download Template Payroll
    |--------------------------------------------------------------------------
    |
    | Operator boleh download template resmi.
    |
    */

    Route::get('/template-payroll/{payrollTemplate}/download', [PayrollTemplateController::class, 'download'])
        ->name('payroll-templates.download');

    /*
    |--------------------------------------------------------------------------
    | Notifikasi
    |--------------------------------------------------------------------------
    */

    Route::post('/notifikasi/baca-semua', [NotificationController::class, 'markAllRead'])
        ->name('notifications.read-all');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Master Sekolah
    |--------------------------------------------------------------------------
    */
    Route::get('/master-sekolah', [SchoolController::class, 'index'])
        ->name('schools.index');

    Route::post('/master-sekolah', [SchoolController::class, 'store'])
        ->name('schools.store');

    Route::post('/master-sekolah/{school}/toggle', [SchoolController::class, 'toggleActive'])
        ->name('schools.toggle');

    /*
    |--------------------------------------------------------------------------
    | Manajemen User
    |--------------------------------------------------------------------------
    */

    Route::get('/user', [UserController::class, 'index'])
        ->name('users.index');

    Route::post('/user', [UserController::class, 'store'])
        ->name('users.store');

    Route::delete('/user/{user}', [UserController::class, 'destroy'])
        ->name('users.destroy');

    /*
    |--------------------------------------------------------------------------
    | Periode
    |--------------------------------------------------------------------------
    */

    Route::get('/periode', [SalaryPeriodController::class, 'index'])
        ->name('periods.index');

    Route::post('/periode', [SalaryPeriodController::class, 'store'])
        ->name('periods.store');

    Route::post('/periode/{period}/toggle', [SalaryPeriodController::class, 'toggleStatus'])
        ->name('periods.toggle');

    /*
    |--------------------------------------------------------------------------
    | Import Gaji
    |--------------------------------------------------------------------------
    */

    Route::get('/import', [ImportController::class, 'index'])
        ->name('imports.index');

    Route::post('/import', [ImportController::class, 'store'])
        ->name('imports.store');

    /*
    |--------------------------------------------------------------------------
    | Pencocokan Dokumen Manual
    |--------------------------------------------------------------------------
    */

    Route::get('/pencocokan-manual', [UnmatchedDocumentController::class, 'index'])
        ->name('unmatched.index');

    Route::post('/pencocokan-manual/{document}/assign', [UnmatchedDocumentController::class, 'assign'])
        ->name('unmatched.assign');

    Route::post('/pencocokan-manual/{document}/ignore', [UnmatchedDocumentController::class, 'ignore'])
        ->name('unmatched.ignore');

    /*
    |--------------------------------------------------------------------------
    | Permintaan Perbaikan
    |--------------------------------------------------------------------------
    */

    Route::get('/perbaikan', [RevisionController::class, 'index'])
        ->name('revisions.index');

    Route::get('/perbaikan/{revisionRequest}', [RevisionController::class, 'show'])
        ->name('revisions.show');

    Route::post('/perbaikan/{revisionRequest}/resolve', [RevisionController::class, 'resolve'])
        ->name('revisions.resolve');

    /*
    |--------------------------------------------------------------------------
    | Template Payroll Admin
    |--------------------------------------------------------------------------
    */

    Route::get('/template-payroll', [PayrollTemplateController::class, 'index'])
        ->name('payroll-templates.index');

    Route::post('/template-payroll', [PayrollTemplateController::class, 'store'])
        ->name('payroll-templates.store');

    /*
    |--------------------------------------------------------------------------
    | Rekap Semua Sekolah
    |--------------------------------------------------------------------------
    */

    Route::get('/rekap', [RekapController::class, 'index'])
        ->name('rekap.index');

    Route::get(
        '/rekap/payroll/{payroll}/download',
        [RekapController::class, 'downloadPayroll']
    )->name('rekap.payroll.download');

    /*
    |--------------------------------------------------------------------------
    | Approve Payroll
    |--------------------------------------------------------------------------
    */

    Route::post('/rekap/payroll/{payroll}/approve', [RekapController::class, 'approve'])
        ->name('rekap.payroll.approve');

    /*
    |--------------------------------------------------------------------------
    | Kembalikan Payroll untuk Revisi
    |--------------------------------------------------------------------------
    */

    Route::post('/rekap/payroll/{payroll}/revision', [RekapController::class, 'requestRevision'])
        ->name('rekap.payroll.revision');
});

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';