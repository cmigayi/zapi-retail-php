<?php
namespace App\Common;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Handle transaction number 
*/

class TransactionNumber{

	public function __construct(){

	}

	public function getTransactionNumber(){
		return $this->generateTransactionNumber();
	}

	public function generateTransactionNumber(){
		return uniqid(rand(),true);
	}
}

