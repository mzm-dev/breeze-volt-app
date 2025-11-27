<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';

use Livewire\Volt\Volt;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');

    // Route untuk Nota (CRUD)
    Volt::route('notes', 'notes.index')->name('notes.index');
    Volt::route('notes/create', 'notes.create')->name('notes.create');
    Volt::route('notes/{note}', 'notes.show')->name('notes.show');
    Volt::route('notes/{note}/edit', 'notes.edit')->name('notes.edit');
});
