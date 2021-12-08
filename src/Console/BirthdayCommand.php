<?php

namespace Fabioroque\Roqueui\Console;

use Illuminate\Console\Command;

class BirthdayCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'roqueui:birthday';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Display the author birthday';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('3 December 1992');
    }
}
