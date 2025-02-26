<?php

use App\Livewire\TaskManager;
use Illuminate\Support\Facades\Route;

Route::get('/task-manager/{task}', TaskManager::class)->name('task-manager');
Route::get('/', function () {
    return view('welcome');
});
