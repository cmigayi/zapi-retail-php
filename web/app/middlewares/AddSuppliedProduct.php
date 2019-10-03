<?php
namespace App\Middlewares;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Create/add new supplied product
*/

use App\Repositories\Contracts\SuppliedProductRepositoryInterface;
use App\Data\SuppliedProduct;

class AddSuppliedProduct{
	private $repo; 

	public function __construct(SuppliedProductRepositoryInterface $repo){
		$this->repo = $repo;
	}

	public function createSuppliedProduct(SuppliedProduct $suppliedProduct){
		return $this->repo->createSuppliedProduct($suppliedProduct);
	}
}