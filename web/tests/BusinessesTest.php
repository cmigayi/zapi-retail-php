<?php

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Testing businesses fetching process
*/

use PHPUnit\Framework\TestCase;
use App\Middlewares\Businesses;
use App\Repositories\BusinessRepository;

class BusinessesTest extends TestCase{

	/**
	* Testing if the returned value is an array
	*/
	public function testIfBusinessesFetched(){
		$businesses = new Businesses(new BusinessRepository());
		$this->assertInternalType('array',$businesses->getOwnerBusinesses(1));
	}

}