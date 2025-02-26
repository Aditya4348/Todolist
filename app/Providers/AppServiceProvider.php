<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Livewire::component('todolist-manager', \App\Livewire\TodolistManager::class);

        // Menambahkan layout default untuk semua komponen Livewire
        Livewire::directive('layout', function () {
            return 'components.layouts.app';
        });
    }

    public function register()
    {
        //
    }
}
