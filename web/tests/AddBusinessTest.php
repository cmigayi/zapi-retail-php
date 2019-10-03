<?php

use PHPUnit\Framwork\TestCase;
use App\Data\Business;
use App\Repositories\BusinessRepository; 
use App\Middlewares\AddBusiness;

class AddBusinessTest extends TestCase{
	private $business;
	private $businessRepository; 
	private $addBusiness;

	public function setUp(){
		$this->business = new Business();
		$this->businessRepository = new BusinessRepository();
	}

	public function tearDown(){
		$this->business = null;
		$this->businessRepository = null;
	}

	public function testIfBusinessIsAdded(){
		//set data
		$this->business->setBusinessName("Jjj"); 
		$this->business->setBusinessType(2); 
		$this->business->setBusinessLocation("Jjj"); 
		$this->business->setBusinessCountry("Jjj"); 
		$this->business->setBusinessLogo("Jjj"); 

		//set repository
		$this->addBusiness = new AddBusiness($this->businessRepository);
		$this->addBusiness->createBusiness($this->business);
	}
}
