<?php

namespace Fabioroque\Roqueui;

use Illuminate\Support\ServiceProvider;
use Fabioroque\Roqueui\Console\RoqueuiCommand;
use Fabioroque\Roqueui\Console\BirthdayCommand;
use Fabioroque\Roqueui\Console\AlertCommand;

class RoqueuiServiceProvider extends ServiceProvider
{

    public function registerCommands()
    {
        
        if ($this->app->runningInConsole()) {
            $this->commands([
                RoqueuiCommand::class,
                BirthdayCommand::class,
                AlertCommand::class,
            ]);
        }

    }

    public function provides()
    {
        return [
            RoqueuiCommand::class,
            BirthdayCommand::class,
            AlertCommand::class,
        ];
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerCommands();
    }


}
