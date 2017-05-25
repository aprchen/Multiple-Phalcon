<?php

return new \Phalcon\Config(array(
    'database' => array(
        'adapter'     => 'Mysql',
        'host'        => '127.0.0.1',
        'username'    => 'root',
        'password'    => '',
        'dbname'      => '',
        'prefix'      =>'',
        'charset'     => 'utf8',
    ),
    'application' => array(
        'controllersDir' => APP_DIR . 'controllers' . DS,
        'modelsDir'      => APP_DIR . 'models' . DS,
        'viewsDir'       => APP_DIR . 'views' . DS,
        'pluginsDir'     => APP_DIR . 'plugins' . DS,
        'mvcDir'         => APP_DIR . 'mvc' . DS,
        'libraryDir'     => APP_DIR . 'library' . DS,
        'cacheDir'       => APP_DIR . 'cache' . DS,
        'baseUri'        => '',
        'defaultModule'  => ''
    )
));
