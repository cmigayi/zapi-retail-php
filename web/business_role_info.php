<?php
require_once("vendor/autoload.php");

use App\Data\BusinessRole;
use App\Repositories\BusinessRoleRepository; 
use App\Middlewares\BusinessRoleInfo;

//initialize objects
$businessRole = new BusinessRole();
$businessRoleRepository = new BusinessRoleRepository();

// Validate inputs
//$businessRoleId = $_POST['business_role_id'];
$businessRoleId = 24;

$businessRoleInfo = new BusinessRoleInfo($businessRoleRepository);
$businessRole = $businessRoleInfo->getBusinessRole($businessRoleId);

if($businessRole == null){
	$info["status"] = false;
	$recordCount = 0;	
}else{
	$recordCount = 1;	
	$info["status"] = true;
	$data['business_role_id'] = $businessRole->getBusinessRoleId();
	$data['employee_id'] = $businessRole->getEmployeeId();
	$data['business_id'] = $businessRole->getBusinessId();
	$data['role_label'] = $businessRole->getRoleLabel();
	$data['role_privileged'] = $businessRole->getRolePrevileges();
	$data['date_time'] = $businessRole->getDateTime();	
}

$main["content"] = array();
$content["info"] = array();
$content["businessRole"] = array();

array_push($content["info"],$info);
array_push($content["businessRole"],$data);
array_push($main["content"],$content);

echo json_encode($main, true);