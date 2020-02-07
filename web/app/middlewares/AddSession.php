<?php
namespace App\Middlewares;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Create/add new session
*/

use App\Repositories\Contracts\SessionRepositoryInterface;

class AddSession{
	private $repo;

	public function __construct(SessionRepositoryInterface $repo){
		$this->repo  = $repo;
	}

	public function createSession($session){
		return $this->repo->createSession($session);
	}	
}