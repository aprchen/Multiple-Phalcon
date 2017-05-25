<?php
define('MODULES_DIR', APP_ROOT . DS . 'modules' . DS);
define('PUBLIC_DIR', APP_ROOT . DS . 'public' . DS);
define('APP_DIR', APP_ROOT . DS . 'app' . DS);
/**
 * 本地环境在php.ini配置文件中添加
 *  [SLENV]
 *  sl.env = "dev"
 */
define('ENV', (get_cfg_var("sl.env") == "dev") ? 'DEV' : 'PRO' );
define('CONFIG', (ENV == 'DEV') ?  "config.dev.php" :  "config.php" );
if (ENV == 'DEV') {
//    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    $debug = new \Phalcon\Debug();
	$debug->listen();
}

use Phalcon\Logger\Adapter\File as FileAdapter;
class Log {
	private static $_logger;

	public static function logger() {
		if(empty(self::$_logger)) {
			self::$_logger = new FileAdapter(APP_DIR . 'logs' . DS . 'log.log');
		}
		return self::$_logger;
	}
}