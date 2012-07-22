<?php

namespace Todo;

use Silex\Application;

/**
 * Base controller class
 */
abstract class Controller
{
    /**
     * @var \Silex\Application
     */
    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;

        $this->initialize();
    }

    abstract public function initialize();
}

