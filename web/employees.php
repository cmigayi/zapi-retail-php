<?php
require_once("vendor/autoload.php");

use App\Data\Employee;
use App\Repositories\EmployeeRepository; 
use App\Middlewares\Employees;

$verb = $_SERVER['REQUEST_METHOD'];
$url_pieces = explode('/', $_SERVER['PATH_INFO']);
if($url_pieces[1] != "zapi-v1"){	
	return http_response_code(404);
}

$userId = $url_pieces[3];

//initialize objects
$employee = new Employee();
$employeeRepository = new EmployeeRepository();

$employees = new Employees($employeeRepository);
$data = $employees->getEmployees();

if($data == null){
	$info["status"] = false;	
}else{
	$recordCount = count($data[0]);	
	$info["status"] = true;
	$info["records"] = $recordCount;	
}

$main["content"] = array();
$content["info"] = array();
$content["employees"] = array();

array_push($content["info"],$info);
array_push($content["employees"],$data[0]);
array_push($main["content"],$content);

echo json_encode($main, true);