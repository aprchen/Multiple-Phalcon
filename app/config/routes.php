<?php

use Phalcon\Mvc\Router;

$di->set('router', function () use ($modules, $defaultModule)  {

    $router = new Router(false);


    $router->removeExtraSlashes(true);

    if(!empty($defaultModule)) {
        $router->setDefaultModule($defaultModule);
    }


    $router->add('/', array(
        'controller' => 'index',
        'action' => 'index'
    ));

     $router->notFound(array(
         'controller' => 'errors',
         'action' => 'show404'
     ));

    $router->add('/:module/:controller/:action/:params', array(
        'module' => 1,
        'controller' => 2,
        'action' => 3,
        'params' => 4
    ));
    return $router;
});
