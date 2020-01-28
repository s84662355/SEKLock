<?php
/**
 * Created by PhpStorm.
 * User: chenjiahao
 * Date: 2020-01-19
 * Time: 09:54
 */

namespace SEKLock;


use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
 


class SEKLockServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    protected $commands = [
          
    ];


    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([__DIR__ . '/../config' => config_path()], 'SEKLock-config');
        }


        $this->app->singleton(
            'seklock',
            function (){
                 return new LockController(config('sek_lock'));
            }
        );
    }



    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->commands($this->commands);
    }

}
