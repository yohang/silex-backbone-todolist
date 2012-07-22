<?php

$app['resources_path'] = realpath(__DIR__.'/..');
$app['cache_path'] = realpath(__DIR__.'/../../cache');

$app['assetic.path_to_cache']       = $app['cache_path'] . DIRECTORY_SEPARATOR . 'assetic' ;
$app['assetic.path_to_web']         = __DIR__ . '/../../web';

$app['assetic.input.path_to_css']       = $app['resources_path'] . '/css/*.css';
$app['assetic.output.path_to_css']      = '/css/styles.css';
$app['assetic.input.path_to_js']        = array(
    $app['resources_path'] . '/js/libs/jquery.js',
    $app['resources_path'] . '/js/libs/underscore.js',
    $app['resources_path'] . '/js/libs/backbone.js',
    $app['resources_path'] . '/js/app/app.js',
    $app['resources_path'] . '/js/app/model/*.js',
    $app['resources_path'] . '/js/app/collection/*.js',
    $app['resources_path'] . '/js/app/view/*.js',
    $app['resources_path'] . '/js/app/router.js',
);
$app['assetic.output.path_to_js']       = '/js/scripts.js';
$app['assetic.output.path_to_js_templates']       = '/js/templates.js';
$app['twig_js.template.path'] = $app['twig.path'] . '/js';
$app['vendor_dir'] = realpath(__DIR__ . '/../../vendor');
