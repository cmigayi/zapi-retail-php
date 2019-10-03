<?php
namespace App\Repositories\Contracts;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Contract to service cartegory repository
*/

use App\Data\ServiceCartegory;

interface ServiceCartegoryRepositoryInterface{

	public function createServiceCartegory(ServiceCartegory $serviceCartegory);

	public function loadBusinessServiceCartegories($businessId);
} 