<?php

namespace Todo\Controller;

use Todo\Controller;

class Base extends Controller
{
    public function initialize()
    {
        $this->app->get('/', array($this, 'index'));
    }

    public function index()
    {
        return $this->app['twig']->render('index.html.twig');
    }
}
