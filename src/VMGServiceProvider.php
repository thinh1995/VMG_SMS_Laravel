<?php

namespace Lucifer\VmgSmsLaravel;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Application as LaravelApplication;
use Laravel\Lumen\Application as LumenApplication;

class VMGServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->setUpConfig();
    }

    private function setUpConfig(): void
    {
        $source = dirname(__DIR__) . '/resources/config/vmg.php';

        if ($this->app instanceof LaravelApplication) {
            $this->publishes([$source => config_path('vmg.php')], 'config');
        } elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('vmg');
        }

        $this->mergeConfigFrom($source, 'vmg');
    }
}