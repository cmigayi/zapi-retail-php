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

	public function loadBusinessCartegoryService($serviceId);
	
	public function loadBusinessCartegoryServices($serviceCartegoryId);
}