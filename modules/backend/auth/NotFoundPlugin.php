<?php
namespace Multiple\Backend\Auth;
use Phalcon\Events\Event;
use Phalcon\Mvc\User\Plugin;
use Phalcon\Dispatcher;
use Phalcon\Mvc\Dispatcher\Exception as DispatcherException;
use Phalcon\Mvc\Dispatcher as MvcDispatcher;

/**
 * 未找到插件
 *
 */
class NotFoundPlugin extends Plugin
{

	/**
	 *
	 *
	 * @param Event $event
	 * @param MvcDispatcher $dispatcher
	 * @param \Exception $exception
	 * @return boolean
	 */
	public function beforeException(Event $event, MvcDispatcher $dispatcher, \Exception $exception)
	{
        if(ENV == 'DEV'){
            echo $exception->getMessage() . '<br>';
            echo '<pre>' . $exception->getTraceAsString() . '</pre>';
            exit();
        }else{
            $log = \Log::logger();
            $log->error($exception->getMessage() . PHP_EOL . $exception->getTraceAsString());
            $log->close();
        }

		if ($exception instanceof DispatcherException) {
			switch ($exception->getCode()) {
				case Dispatcher::EXCEPTION_HANDLER_NOT_FOUND:
				case Dispatcher::EXCEPTION_ACTION_NOT_FOUND:
					$dispatcher->forward(
						[
							'controller' => 'errors',
							'action'     => 'show404'
						]
					);
					return false;
			}
		}

		$dispatcher->forward(
			[
				'controller' => 'errors',
				'action'     => 'show500'
			]
		);

		return false;
	}
}
