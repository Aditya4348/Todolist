<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Task;

Route::get('/', function () {
    return view('landing');
});
Route::get('/dashboard', function () {
    return view('welcome');
})->name('dashboard');
Route::get('/dashboard/{id}/edit', function ($id) {
    return view('update', ['id' => $id]);
})->name('update_task');


