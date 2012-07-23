<?php

namespace Todo\Command;

use Silex\Application;
use Symfony\Component\Console\Command\Command as BaseCommand;

class Command extends BaseCommand
{
    /**
     * @var \Silex\Application
     */
    protected $app;

    public function __construct(Application $app, $name = null)
    {
        $this->app = $app;

        parent::__construct($name);
    }
}
