<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\TodolistManager;

Route::get('/todolist',[TodolistManager::class, 'indexapi']);
Route::get('/tasks',[TodolistManager::class, 'indexTaks']);
Route::Post('/todolist',[TodolistManager::class, 'storeapi']);
Route::Post('/task',[TodolistManager::class, 'storeTaskapi']);
Route::delete('/todolist/{id}', [TodolistManager::class, 'destroy']);
Route::delete('/tasks/{id}', [TodolistManager::class, 'destroyTask']);
Route::Put('/tasks/{id}', [TodolistManager::class, 'updateTaks']);