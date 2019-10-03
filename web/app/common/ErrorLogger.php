<?php
namespace App\Common;

/**
* @Author: Cecil Migayi
* @Email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* This class assist in logging errors using Monolog library 
*/

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class ErrorLogger{
	private $logChannel;

	public function __construct($logChannel){
		$this->logChannel = $logChannel;
	}

	public function initLog(){
		// create a log channel
		$log = new Logger($this->logChannel);
		$log->pushHandler(new StreamHandler('../app.log', Logger::DEBUG));

		return $log;
	}
}