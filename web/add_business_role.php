<?php
require_once("vendor/autoload.php");

use App\Data\BusinessRole;
use App\Repositories\BusinessRoleRepository; 
use App\Middlewares\AddBusinessRole;

//initialize objects
$businessRole = new BusinessRole();
$businessRoleRepository = new BusinessRoleRepository();

//Data validation
$userId = 40;
$businessId = 7;
$role = "Manager";

//set data
$businessRole->setUserId($userId); 
$businessRole->setBusinessId($businessId); 
$businessRole->setBusinessRole($role); 

//set repository
$addBusinessRole = new AddBusinessRole($businessRoleRepository);
$businessRole = $addBusinessRole->createBusinessRole($businessRole);
echo $businessRole->getBusinessRoleId()." ".$businessRole->getUserId();
