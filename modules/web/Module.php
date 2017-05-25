<?php

namespace Multiple\Web;

use Phalcon\DiInterface;
use Phalcon\Events\Manager;
use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Php as PhpEngine;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Phalcon\Config;
use Phalcon\Mvc\Dispatcher;

class Module implements ModuleDefinitionInterface
{
    /**
     * Registers an autoloader related to the module
     *
     * @param DiInterface $di
     */
    public function registerAutoloaders(DiInterface $di = null)
    {
        $loader = new Loader();

        $loader->registerNamespaces([
            'Multiple\Web\Controllers' => __DIR__ . '/controllers/'
        ]);

        $loader->register();
    }

    /**
     * Register the services here to make them general or register in the ModuleDefinition to make them module-specific
     */
    public function registerServices(DiInterface $di)
    {
        // Registering a dispatcher
        $di->set(
            "dispatcher",
            function () {
                $dispatcher = new Dispatcher();

                $dispatcher->setDefaultNamespace("Multiple\\Web\\Controllers");

                return $dispatcher;
            }
        );

        // Registering the view component
//        $di->set(
//            "view",
//            function () {
//                $view = new View();
//
//                $view->setViewsDir(__DIR__."/views/");
//
//                return $view;
//            }
//        );
    }
}
