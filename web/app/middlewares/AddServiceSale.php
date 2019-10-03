<?php
namespace App\Middlewares;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Create/add new product sale
*/

use App\Repositories\Contracts\ServiceSaleRepositoryInterface;
use App\Data\ServiceSale;

class AddServiceSale{
	private $repo; 

	public function __construct(ServiceSaleRepositoryInterface $repo){
		$this->repo = $repo;
	}

	public function createServiceSale(ServiceSale $serviceSale){
		return $this->repo->createServiceSale($serviceSale);
	}
}