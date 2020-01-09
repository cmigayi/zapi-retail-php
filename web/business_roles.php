<?php
require_once("vendor/autoload.php");

use App\Data\BusinessRole;
use App\Repositories\BusinessRoleRepository; 
use App\Middlewares\BusinessRoles;

//initialize objects
$businessRole = new BusinessRole();
$businessRoleRepository = new BusinessRoleRepository();

//Data validation
//$businessId = $_POST['business_id'];
$businessId = 1;

//set repository
$businessRoles = new BusinessRoles($businessRoleRepository);
$data = $businessRoles->getBusinessRoles($businessId);

if($data == null){
	$info["status"] = false;	
}else{
	$recordCount = count($data[0]);	
	$info["status"] = true;
	$info["records"] = $recordCount;	
}

$main["content"] = array();
$content["info"] = array();
$content["businessRoles"] = array();

array_push($content["info"],$info);
array_push($content["businessRoles"],$data[0]);
array_push($main["content"],$content);

echo json_encode($main, true);