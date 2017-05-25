<?php

$loader = new \Phalcon\Loader();

$loader->registerNamespaces(array(
    'Sl\Models'=>$config->application->modelsDir
));
$loader->registerDirs(
    array(
        $config->application->controllersDir,
    )
)->register();
