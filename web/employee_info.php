<?php
require_once("vendor/autoload.php");

use App\Data\Employee;
use App\Repositories\EmployeeRepository; 
use App\Middlewares\EmployeeInfo;

//initialize objects
$employee = new Employee();
$employeeRepository = new EmployeeRepository();

$verb = $_SERVER['REQUEST_METHOD'];
$url_pieces = explode('/', $_SERVER['PATH_INFO']);
if($url_pieces[1] != "zapi-v1"){	
	return http_response_code(404);
}

$userId = $url_pieces[3];

$employeeId = $url_pieces[5];

$employeeInfo = new EmployeeInfo($employeeRepository);
$employee = $employeeInfo->getEmployee($employeeId);

if($employee == null){
	$info["status"] = false;	
}else{
	$recordCount = 1;	
	$info["status"] = true;
	$data['employee_id'] = $employee->getEmployeeId();
	$data['fname'] = $employee->getFname();
	$data['lname'] = $employee->getLname();
	$data['email'] = $employee->getEmail();
	$data['phone'] = $employee->getPhone();
	$data['national_id'] = $employee->getNationalId();
	$data['username'] = $employee->getUsername();
	$data['password'] = $employee->getPassword();
	$data['date_time'] = $employee->getDateTime();	
}

$main["content"] = array();
$content["info"] = array();
$content["employee"] = array();

array_push($content["info"],$info);
array_push($content["employee"],$data);
array_push($main["content"],$content);

echo json_encode($main, true);