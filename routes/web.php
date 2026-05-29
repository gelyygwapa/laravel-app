<?php

use App\Http\Controllers\FlowerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('flowers.index');
});

// Individual CRUD routes instead of resource
Route::get('/flowers', [FlowerController::class, 'index'])->name('flowers.index');
Route::get('/flowers/create', [FlowerController::class, 'create'])->name('flowers.create');
Route::post('/flowers', [FlowerController::class, 'store'])->name('flowers.store');
Route::get('/flowers/{flower}', [FlowerController::class, 'show'])->name('flowers.show');
Route::get('/flowers/{flower}/edit', [FlowerController::class, 'edit'])->name('flowers.edit');
Route::put('/flowers/{flower}', [FlowerController::class, 'update'])->name('flowers.update');
Route::delete('/flowers/{flower}', [FlowerController::class, 'destroy'])->name('flowers.destroy');
Route::view('/offline', 'offline');