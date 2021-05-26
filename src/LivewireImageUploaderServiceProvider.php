<?php

namespace Sherwinchia\LivewireImageUploader;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Sherwinchia\LivewireImageUploader\Http\Livewire\ImageUploader;

class LivewireImageUploaderServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/resources/views', 'livewire-image-uploader');
        $this->publishes([
            __DIR__.'/resources/assets' => public_path('image-uploader'),
          ], 'assets');

        Livewire::component('image-uploader', ImageUploader::class);
    }

    /**
     * Register the application services.
     */
    public function register() {}
}
