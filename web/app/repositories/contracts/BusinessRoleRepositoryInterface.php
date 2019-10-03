<?php
namespace App\Repositories\Contracts;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Contract to business role repository
*/

interface BusinessRoleRepositoryInterface{

	/**	
	* Create new business role
	*
	* @param $businessRole object
	* @return BusinessRole object
	*/
	public function createBusinessRole($businessRole);

	/**	
	* load business agent data
	*
	* @param int $businessId, int $userId (agent) 
	* @return array businessRoles and user
	*/
	public function loadBusinessAgent($businessId,$userId);

	/**	
	* load business agents
	*
	* @param int $businessId 
	* @return array businessRoles and user
	*/
	public function loadBusinessAgents($businessId);	

}