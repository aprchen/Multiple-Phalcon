<?php

use Phalcon\Mvc\Url as UrlResolver,
    Phalcon\DI\FactoryDefault,
    Phalcon\Session\Adapter\Files as SessionAdapter;
use Phalcon\Mvc\View\Engine\Php as PhpEngine;
use Phalcon\Flash\Direct as FlashDirect;
$di = new FactoryDefault();

$di['url'] = function() use ($config) {
    $url = new UrlResolver();
    $url->setBaseUri($config->application->baseUri);
    return $url;
};

$di->setShared('config', $config);


/**
 * Shared configuration service
 */


$di->setShared('session',function (){
    $session = new SessionAdapter();
    $session->start();
    return $session;
});

$di->setShared('cache',function (){
    $redis = new Redis();
    $redis->connect('127.0.0.1');
    return $redis;
});


/**
 * 数据库
 */
$di->setShared('db', function () {
    $config = $this->getConfig();

    $class = 'Phalcon\Db\Adapter\Pdo\\' . $config->database->adapter;
    $params = [
        'host'     => $config->database->host,
        'username' => $config->database->username,
        'password' => $config->database->password,
        'dbname'   => $config->database->dbname,
        'charset'  => $config->database->charset
    ];

    if ($config->database->adapter == 'Postgresql') {
        unset($params['charset']);
    }

    $connection = new $class($params);

    return $connection;
});



/**
 * Start the session the first time some component request the session service
 */
$di->setShared('session', function () {
    $session = new SessionAdapter();
    $session->start();

    return $session;
});


$di->set('crypt', function() {
    $crypt = new Phalcon\Crypt();
    $crypt->setKey('U3mFSskVIvLuLrC#0UZSEeTtQ!7');
    return $crypt;
});

$di->set('view', function() use ($config) {

    $view = new \Phalcon\Mvc\View();

    $view->setViewsDir($config->application->viewsDir);

    //$view->setMainView('index');

    $view->registerEngines(array(
        '.volt' => function($view, $di) {
            $volt = new \Phalcon\Mvc\View\Engine\Volt($view, $di);
            $volt->setOptions(array(
                'compiledPath' => APP_DIR . 'views' . DS .'_compiled' . DS,
                'stat' => true,
                'compileAlways' => true
            ));
            return $volt;
        },
        '.phtml' => PhpEngine::class
    ));

    return $view;
});

