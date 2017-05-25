<?php

define('DS', str_replace('\\', '/', DIRECTORY_SEPARATOR));
define('APP_ROOT', str_replace('\\', '/', dirname(dirname(__FILE__))));
define('CONFIG_DIR', APP_ROOT . DS . 'app' . DS . 'config' . DS);
/**
 * Constants Definitions
 */
require_once(CONFIG_DIR ."definitions.php");

try {

    /**
     * 加载配置文件
     */
    $config = require_once(CONFIG_DIR.CONFIG);

    /**
     * 注册模块
     */
    $modules = require_once(CONFIG_DIR . "modules.php");

    /**
     * 默认模块
     */
    $defaultModule = $config->application->defaultModule;

    /**
     * 加载配置
     */
    require_once(CONFIG_DIR . "loader.php");

    /**
     * 注册服务
     */
    require_once(CONFIG_DIR . "services.php");

    /**
     * 常量文件
     */
    require_once(CONFIG_DIR . "constant.php");
    /**
     * 路由
     */
    require_once(CONFIG_DIR . "routes.php");

    //require_once(CONFIG_DIR . "dispatcher.php");
    /**
     * 运行
     */
    require_once(CONFIG_DIR . "application.php");

} catch (Phalcon\Exception $e) {
    if(ENV == 'DEV'){
        echo $e->getMessage() . '<br>';
        echo '<pre>' . $e->getTraceAsString() . '</pre>';
        exit();
    }else{
        $log = Log::logger();
        $log->error($exception->getMessage() . PHP_EOL . $exception->getTraceAsString());
        $log->close();
    }
}