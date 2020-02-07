<?php
require_once("vendor/autoload.php");

use App\Data\BusinessRole;
use App\Repositories\BusinessRoleRepository; 
use App\Middlewares\BusinessRoleInfo;

//initialize objects
$businessRole = new BusinessRole();
$businessRoleRepository = new BusinessRoleRepository();
$businessRoleInfo = new BusinessRoleInfo($businessRoleRepository);

// Data validation

//$businessRoleId = $_POST['business_role_id'];
$businessRoleId = 24;

$data = $businessRoleInfo->deleteBusinessRole($businessRoleId);

if($data == null){
	$info["status"] = false;	
}else{	
	$info["status"] = true;
}

$main["content"] = array();
$content["info"] = array();

array_push($content["info"],$info);
array_push($main["content"],$content);

echo json_encode($main, true);