<?php

namespace Todo\Silex\Provider;

use Assetic\Asset\AssetCache;
use Assetic\Asset\GlobAsset;
use Assetic\Cache\FilesystemCache;
use Silex\Application;
use Silex\ServiceProviderInterface;
use TwigJs\Assetic\TwigJsFilter;
use TwigJs\CompileRequestHandler;
use TwigJs\JsCompiler;
use TwigJs\Twig\TwigJsExtension;

class TwigJsServiceProvider implements ServiceProviderInterface
{
    /**
     * Registers services on the given app.
     *
     * This method should only be used to configure services and parameters.
     * It should not get services.
     *
     * @param Application $app An Application instance
     */
    public function register(Application $app)
    {
        $app['twig_js.compile_request_handler'] = $app->share(function($app) {
            return new CompileRequestHandler($app['twig'], $app['twig_js.compiler']);
        });

        $app['twig_js.compiler'] = $app->share(function($app) {
            return new JsCompiler($app['twig']);
        });
        $app['twig_js.twig_extension'] = $app->share(function() {
            return new TwigJsExtension();
        });
    }

    /**
     * Bootstraps the application.
     *
     * This method is called after all services are registers
     * and should be used for "dynamic" configuration (whenever
     * a service must be requested).
     */
    public function boot(Application $app)
    {
        if (isset($app['assetic.filter_manager'])) {
            $fm = $app['assetic.filter_manager'];
            $am = $app['assetic.asset_manager'];

            $fm->set('twig_js', new TwigJsFilter(
                $app['twig_js.compile_request_handler']
            ));

            $am->set('twig_js_templates', new AssetCache(
                new GlobAsset($app['twig.path'] . '/js/*.twig', array($fm->get('twig_js'))),
                new FilesystemCache($app['assetic.path_to_cache'])
            ));
            $am->get('twig_js_templates')->setTargetPath($app['assetic.output.path_to_js_templates']);
        }
        $app['twig']->addExtension($app['twig_js.twig_extension']);
    }

}
