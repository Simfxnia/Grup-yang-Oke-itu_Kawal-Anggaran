<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\ExpenditureController;
use App\Http\Controllers\FinancingController;
use App\Http\Controllers\ChatController;

// Route::get('/', [HomeController::class, 'index'])->name('homepage.homepage');
Route::get('/', [HomeController::class, 'index']);
Route::post('/', [HomeController::class, 'index']);

Route::get('/dashboard/regIncome', [IncomeController::class, 'index'])->name('dashboard.regIncome');
Route::post('/dashboard/regIncome', [IncomeController::class, 'filter'])->name('income.filter');

Route::get('/dashboard/regExp', [ExpenditureController::class, 'index'])->name('dashboard.regExp');
Route::post('/dashboard/regExp', [ExpenditureController::class, 'filter'])->name('exp.filter');

Route::get('/dashboard/regFin', [FinancingController::class, 'index'])->name('dashboard.regFin');
Route::post('/dashboard/regFin', [FinancingController::class, 'filter'])->name('fin.filter');



