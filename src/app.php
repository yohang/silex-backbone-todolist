<?php

use Silex\Application;
use Silex\Provider\TwigServiceProvider;
use SilexExtension\AsseticExtension;
use Todo\Controller;

$app = new Application();

$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => array(
        'driver'   => 'pdo_sqlite',
        'path'     => realpath(__DIR__.'/../app.db'),
    ),
));

$app->register(new \Todo\Silex\Provider\TwigJsServiceProvider());

$app->register(new TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views',
));

$app->register(new AsseticExtension(), array(
    'assetic.options' => array(
        'debug' => $app['debug']
    ),
    'assetic.filters' => $app->protect(function(\Assetic\FilterManager $fm) use ($app) {
        //$fm->set('twig_js', $app['twig_js.assetic_filter']);
    }),
    'assetic.assets' => $app->protect(function($am, $fm) use ($app) {
        $am->set('styles', new Assetic\Asset\AssetCache(
            new Assetic\Asset\GlobAsset($app['assetic.input.path_to_css']),
            new Assetic\Cache\FilesystemCache($app['assetic.path_to_cache'])
        ));
        $am->get('styles')->setTargetPath($app['assetic.output.path_to_css']);

        $am->set('scripts', new Assetic\Asset\AssetCache(
            new \Assetic\Asset\AssetCollection(array(
                new Assetic\Asset\GlobAsset($app['assetic.input.path_to_js']),
                new \Assetic\Asset\FileAsset($app['vendor_dir'] . '/jms/twig-js/twig.js')
            )),
            new Assetic\Cache\FilesystemCache($app['assetic.path_to_cache'])
        ));
        $am->get('scripts')->setTargetPath($app['assetic.output.path_to_js']);
    })
));

new Controller\Api($app);
new Controller\Base($app);

return $app;
