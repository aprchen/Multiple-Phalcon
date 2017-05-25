<?php

namespace Multiple\Backend;

use Multiple\Backend\Auth\AjaxBj;
use Multiple\Backend\Auth\NotFoundPlugin;
use Multiple\Backend\Auth\SecurityPlugin;
use Phalcon\DiInterface;
use Phalcon\Events\Manager;
use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Php as PhpEngine;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;

class Module implements ModuleDefinitionInterface
{
    const MODULE_NAME = 'backend';
    /**
     * Registers an autoloader related to the module
     *
     * @param DiInterface $di
     */
    public function registerAutoloaders(DiInterface $di = null)
    {
        $loader = new Loader();
        $loader->registerNamespaces([
            'Multiple\Backend\Controllers' => MODULES_DIR . self::MODULE_NAME . DS . 'controllers' . DS,
            'Multiple\Backend\Auth' => __DIR__ . '/auth/',
            //'Sl\Models'=>APP_DIR.'models'.DS
        ]);
        $loader->register();
    }

    public function registerServices(DiInterface $di)
    {


        $di->set(
            "dispatcher",
            function () {
                // 创建一个事件管理器
                $eventsManager = new Manager();

                // 监听分发器中使用安全插件产生的事件
                $eventsManager->attach(
                    "dispatch:beforeExecuteRoute",
                    new SecurityPlugin()
                );

                // 处理异常和使用 NotFoundPlugin 未找到异常
                $eventsManager->attach(
                    "dispatch:beforeException",
                    new NotFoundPlugin()
                );

                $dispatcher = new Dispatcher();

                // 分配事件管理器到分发器
                $dispatcher->setEventsManager($eventsManager);
                $dispatcher->setDefaultNamespace("Multiple\\Backend\\Controllers");
                return $dispatcher;
            }
        );
        $di->set('view', function()  {
            $view = new View();

            $view->setViewsDir(MODULES_DIR . self::MODULE_NAME.DS.'views'.DS);
            //$view->setLayoutsDir('layouts'.DS);
            $view->setTemplateAfter('main');
            //$view->setMainView('index');
            $view->registerEngines(array(
                '.phtml' => PhpEngine::class,
                '.volt' => function($view, $di) {
                    $volt = new \Phalcon\Mvc\View\Engine\Volt($view, $di);
                    return $volt;
                }
            ));
            return $view;
        });

    }
}
