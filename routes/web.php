
<?php

use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return redirect()->route('barang.index');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::resource('barang', ItemController::class)
    ->parameters(['barang' => 'item'])
    ->except(['show']);
