<?php

namespace Todo;

use Symfony\Component\Console\Application as BaseApplication;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class Console extends BaseApplication
{
    const VERSION = '1.0.0-dev';

    /**
     * @var \Silex\Application
     */
    protected $app;

    public function __construct()
    {
        parent::__construct('Todolist manager', self::VERSION);

        $this->app = require __DIR__.'/../app.php';
        require __DIR__.'/../../resources/config/dev.php';
    }

    public function doRun(InputInterface $input, OutputInterface $output)
    {
        $this->add(new Command\ServerRun($this->app));
        $this->add(new Command\FixturesLoad($this->app));

        return parent::doRun($input, $output);
    }
}
