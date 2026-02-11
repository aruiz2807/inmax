<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;
use App\Livewire\Services\ServicesPage;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

/*services*/
    //Route::get('/services', [ServiceController::class, 'show'])->name('services');
    Route::post('/services', [ServiceController::class, 'store'])->name('service.store');
/*--------*/

    Route::get('/services', ServicesPage::class)->name('services');

});
