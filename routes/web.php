<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Doctors\DoctorsPage;
use App\Livewire\Plans\PlansPage;
use App\Livewire\Policies\PoliciesPage;
use App\Livewire\Services\ServicesPage;
use App\Livewire\Specialties\SpecialtiesPage;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', function () { return view('dashboard'); })->name('dashboard');

    Route::prefix('admin')->group(function () {

        Route::get('/doctors', DoctorsPage::class)->name('doctors');

        Route::get('/plans', PlansPage::class)->name('plans');

        Route::get('/policies', PoliciesPage::class)->name('policies');

        Route::get('/services', ServicesPage::class)->name('services');

        Route::get('/specialties', SpecialtiesPage::class)->name('specialties');


    });
});
