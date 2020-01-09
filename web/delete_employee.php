<?php
require_once("vendor/autoload.php");

use App\Data\Employee;
use App\Repositories\EmployeeRepository; 
use App\Middlewares\EmployeeInfo;

//initialize objects
$employee = new Employee();
$employeeRepository = new EmployeeRepository();
$employeeInfo = new EmployeeInfo($employeeRepository);

$verb = $_SERVER['REQUEST_METHOD'];
$url_pieces = explode('/', $_SERVER['PATH_INFO']);
if($url_pieces[1] != "zapi-v1"){	
	return http_response_code(404);
}

$userId = $url_pieces[3];
$employeeId = $url_pieces[5];

// Data validation

//$employeeId = 1;

$data = $employeeInfo->deleteEmployee($employeeId);

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