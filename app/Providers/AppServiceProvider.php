<?php

namespace App\Providers;


use Livewire\Livewire;
use Illuminate\Support\Str;
use Dedoc\Scramble\Scramble;
use Illuminate\Routing\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Livewire::component('todolist-manager', \App\Livewire\TodolistManager::class);

        // Menambahkan layout default untuk semua komponen Livewire
        Livewire::directive('layout', function () {
            return 'components.layouts.app';
        });
        
        Scramble::configure()
        ->routes(function (Route $route) {
            return Str::startsWith($route->uri, 'api/');
        });
    }

    public function register()
    {
        //
    }
}
