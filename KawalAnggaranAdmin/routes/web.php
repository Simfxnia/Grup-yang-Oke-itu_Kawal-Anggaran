<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\ExpenditureController;
use App\Http\Controllers\FinancingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminIncomeController;
use App\Http\Controllers\AdminExpenditureController;
use App\Http\Controllers\AdminFinancingController;

Route::get('/', [HomeController::class, 'index']);
Route::post('/', [HomeController::class, 'index']);


Route::get('login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('login', [AuthController::class, 'login'])->name('admin.login');

Route::get('admin/regIncome', [AdminIncomeController::class, 'index'])->name('admin.regIncome.index');
Route::post('/admin/regIncome/storePAD', [AdminIncomeController::class, 'storePAD'])
    ->name('admin.regIncome.storePAD');
Route::post('/admin/regIncome/storeTKDD', [AdminIncomeController::class, 'storeTKDD'])
    ->name('admin.regIncome.storeTKDD');
Route::post('/admin/regIncome/storeLainnya', [AdminIncomeController::class, 'storeLainnya'])
    ->name('admin.regIncome.storeLainnya');
Route::post('/admin/regIncome', [AdminIncomeController::class, 'filter'])
    ->name('income.filter');

Route::delete('/admin/regIncome/delete-PAD', [AdminIncomeController::class, 'deletePAD'])
    ->name('admin.regIncome.deletePAD');

Route::delete('/admin/regIncome/delete-TKDD', [AdminIncomeController::class, 'deleteTKDD'])
    ->name('admin.regIncome.deleteTKDD');

Route::delete('/admin/regIncome/delete-lainnya', [AdminIncomeController::class, 'deleteLainnya'])
    ->name('admin.regIncome.deleteLainnya');

Route::get('admin/regExp', [AdminExpenditureController::class, 'index'])->name('admin.regExp.index');
Route::post('/admin/regExp/storePegawai', [AdminExpenditureController::class, 'storePegawai'])
    ->name('admin.regExp.storePegawai');
Route::post('/admin/regExp/storeBj', [AdminExpenditureController::class, 'storeBj'])
    ->name('admin.regExp.storeBj');
Route::post('/admin/regExp/storeModal', [AdminExpenditureController::class, 'storeModal'])
    ->name('admin.regExp.storeModal');
Route::post('/admin/regExp', [AdminExpenditureController::class, 'filter'])
    ->name('exp.filter');

Route::delete('/admin/regExp/delete-pegawai', [AdminExpenditureController::class, 'deletePegawai'])
    ->name('admin.regExp.deletePegawai');

Route::delete('/admin/regExp/delete-bj', [AdminExpenditureController::class, 'deleteBj'])
    ->name('admin.regExp.deleteBj');

Route::delete('/admin/regExp/delete-modal', [AdminExpenditureController::class, 'deleteModal'])
    ->name('admin.regExp.deleteModal');

Route::get('admin/regFin', [AdminFinancingController::class, 'index'])->name('admin.regFin.index');
Route::post('/admin/regFin/storePenerimaan', [AdminFinancingController::class, 'storePenerimaan'])
    ->name('admin.regFin.storePenerimaan');
Route::post('/admin/regFin/storePengeluaran', [AdminFinancingController::class, 'storePengeluaran'])
    ->name('admin.regFin.storePengeluaran');
Route::post('/admin/regFin', [AdminFinancingController::class, 'filter'])
    ->name('fin.filter');

Route::delete('/admin/regFin/delete-penerimaan', [AdminFinancingController::class, 'deletePenerimaan'])
    ->name('admin.regFin.deletePenerimaan');

Route::delete('/admin/regFin/delete-pengeluaran', [AdminFinancingController::class, 'deletePengeluaran'])
    ->name('admin.regFin.deletePengeluaran');