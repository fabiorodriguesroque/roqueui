<?php

namespace Fabioroque\Roqueui\Console;

use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Console\Command;

class AlertCommand extends GeneratorComponent
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'roqueui:alert {type}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create component';

    /**
     * The component name 
     *
     * @var String
     */
    protected $componentName = 'Alert';

    /**
     * Unique valid types
     * 
     * @var string[]
     */
    protected $validTypes = [
        'primary',
        'secondary',
        'danger',
        'warning',
        'info',
        'light',
        'dark',
    ];

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct($files);
    }

    /**
     * Execute the console command.
     *
     * @return bool|null
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function handle()
    {
        $this->setType($this->argument('type')); 

        if(parent::handle()){ 
            $this->writeView();
            $this->info('Created successfully');
        }

        return false;
        
    }

    protected function writeView()
    {
        $path = $this->viewPath(
            str_replace('.', '/', 'components/roqueui.'.$this->getView()).'-'.$this->type.'.blade.php'   
        );

        $html = $this->generateHtml();

        if (! $this->files->isDirectory(dirname($path))) {
            $this->files->makeDirectory(dirname($path), 0777, true, true);
        }

        if ($this->files->exists($path) && ! $this->option('force')) {
            $this->error('View already exists!');

            return;
        }

        file_put_contents(
            $path,
            $html,
        );
}


    /**
     * Build the directory for the class if necessary.
     *
     * @param  string  $path
     * @return string
     */
    protected function makeDirectory($path)
    {
        if (! $this->files->isDirectory(dirname($path))) {
            $this->files->makeDirectory(dirname($path), 0777, true, true);
        }

        return $path;
    }

    protected function generateHtml()
    {
        $html = '<div>
    '.$this->type.'
</div>';

        return $html;
    }


    /**
     * Validate types
     * 
     * @return bool 
     */
    protected function isValidType($type)
    {
        $type = strtolower($type);

        return in_array($type, $this->validTypes);
    }

}
