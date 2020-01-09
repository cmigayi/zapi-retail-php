<?php
namespace App\Repositories\Contracts;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Contract to service repository
*/

use App\Data\Service;

interface ServiceRepositoryInterface{

	public function createService(Service $service);

	public function getBusinessCartegoryService($serviceId);
	
	public function loadBusinessCartegoryServices($serviceCartegoryId);
	
	public function loadBusinessServices($businessId);
	
	public function updateBusinessService(Service $service);
	
	public function deleteBusinessService($serviceId);
}