<?php
namespace App\Middlewares;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Create/add new businessCredit
*/

use App\Repositories\Contracts\BusinessCreditRepositoryInterface;
use App\Data\BusinessCredit;

class AddBusinessCredit{
	private $repo;

	public function __construct(BusinessCreditRepositoryInterface $repo){
		$this->repo = $repo;
	}	

	public function createBusinessCredit(BusinessCredit $businessCredit){
		return $this->repo->createBusinessCredit($businessCredit);
	}
}
