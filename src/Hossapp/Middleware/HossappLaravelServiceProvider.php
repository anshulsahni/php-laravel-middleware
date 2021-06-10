<?php
namespace Hossapp\Middleware;
use Illuminate\Support\ServiceProvider;

class HossappLaravelServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/hossapp.php' => config_path('hossapp.php'),
        ]);
    }
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        // $this->mergeConfigFrom(
        //     __DIR__.'/config/hossapp.php', 'hossapp'
        // );
    }
}
