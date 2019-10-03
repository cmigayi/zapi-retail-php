<?php
namespace App\Repositories\Contracts;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Contract to Product cartegory repository
*/

use App\Data\ProductCartegory;

interface ProductCartegoryRepositoryInterface{

	public function createProductCartegory(ProductCartegory $productCartegory);

	public function loadBusinessProductCartegories($businessId);
} 