<?php
require_once("vendor/autoload.php");

use App\Data\BusinessRole;
use App\Repositories\BusinessRoleRepository; 
use App\Middlewares\AddBusinessRole;

//initialize objects
$businessRole = new BusinessRole();
$businessRoleRepository = new BusinessRoleRepository();

//Data validation

// Employee role label
//$empLabel = $_POST['label'];
$empLabel = "Manager";

// Business
//$businessId = $_POST['business_id']; 
$businessId = 1; 

//Employee
//$employeeId = $_POST['employee_id'];
$employeeId = 1;

// Privileges (one or more), impload the array values
//$previleges = impload(',', $_POST['previleges']);
$previleges = "1,2,4";

//set data
$businessRole->setEmployeeId($employeeId); 
$businessRole->setBusinessId($businessId); 
$businessRole->setRoleLabel($empLabel); 
$businessRole->setRolePrevileges($previleges);	

//set repository
$addBusinessRole = new AddBusinessRole($businessRoleRepository);
$businessRole = $addBusinessRole->createBusinessRole($businessRole);

if($businessRole == null){
	$info['status'] = false;
	$info['results'] = 0;		
}else{
	$info['status'] = true;
	$info['results'] = 1;
	$data['role_id'] = $businessRole->getBusinessRoleId();
	$data['employee_id'] = $businessRole->getEmployeeId();
	$data['business_id'] = $businessRole->getBusinessId();
	$data['label'] = $businessRole->getRoleLabel();
	$data['privileges'] = $businessRole->getRolePrevileges();
	$data['date_time'] = $businessRole->getDateTime();
}
$content["info"] = array();
$content["role"] = array();
$main["content"] = array();

array_push($content["info"], $info);
array_push($content["role"], $data);
array_push($main["content"], $content);

echo json_encode($main, true);