<?php
return array(
    'web' => array(
        'className' => 'Multiple\Web\Module',
        'path' => MODULES_DIR . 'web'.DS.'Module.php'
    ),
    'frontend' => array(
        'className' => 'Multiple\Frontend\Module',
        'path' => MODULES_DIR . 'frontend' . DS . 'Module.php',
        'description' => '网页模块'
    ),
    'backend' => array(
        'className' => 'Multiple\Backend\Module',
        'path' => MODULES_DIR.'backend'.DS.'Module.php',
        'description' => '管理后台'
    ),

);
