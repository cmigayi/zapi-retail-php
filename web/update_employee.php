<?php
require_once("vendor/autoload.php");

use App\Data\Employee;
use App\Repositories\EmployeeRepository; 
use App\Middlewares\EmployeeInfo;

use App\Common\Email;
use App\Common\Phone;
use App\Common\InputValidator;
use App\Common\Username;
use App\Common\Password;

$verb = $_SERVER['REQUEST_METHOD'];
$url_pieces = explode('/', $_SERVER['PATH_INFO']);
if($url_pieces[1] != "zapi-v1"){	
	return http_response_code(404);
}

$userId = $url_pieces[3];
$employeeId = $url_pieces[5];

//initialize objects
$employee = new Employee();
$employeeRepository = new EmployeeRepository();
$employeeInfo = new EmployeeInfo($employeeRepository);
$email = new Email();
$phone = new Phone();
$inputValidator = new InputValidator();

// Data validation

$employeeId = $_POST['employee_id'];
//$employeeId = 1;

// Firstname validation
$fname = $_POST['fname'];
//$fname = "Cilo";
$fname = $inputValidator->validateInput($fname);

// Lastname validation
$lname = $_POST['lname'];
//$lname = "Cilo";
$lname = $inputValidator->validateInput($lname);

// Email validation
$employeeEmail = $_POST['email'];
//$employeeEmail = "cilo78@gmail.com";
$email->setEmail($employeeEmail); 
$employeeEmail = $email->validEmail();

// Phone validation
$employeePhone = $_POST['phone'];
//$employeePhone = "0718485173";
$phone->setPhoneNumber($employeePhone);
$employeePhone = $phone->validPhoneNumber();

$nationalId = $_POST['national_id'];
//$nationalId = "2456789";

// set data
$employee->setEmployeeId($employeeId);
$employee->setFname($fname);
$employee->setLname($lname);
$employee->setEmail($employeeEmail);
$employee->setPhone($employeePhone);
$employee->setNationalId($nationalId);

if(empty($employeeEmail) || empty($employeePhone)){
	//Validation failed 
	$info["status"] = false;
	$info["records"] = 0;
}else{
	$employee = $employeeInfo->updateEmployee($employee);	
	
	if($employee == null){
		//Validation failed 
		$info["status"] = false;
		$info["records"] = 0;
	}else{
		$info["status"] = true;
		$info["records"] = 1;	
		$data["employee_id"] = $employee->getEmployeeId();
		$data["fname"] = $employee->getFname();
		$data["lname"] = $employee->getLname();
		$data["email"] = $employee->getEmail();
		$data["phone"] = $employee->getPhone();
		$data["national_id"] = $employee->getNationalId();
		$data['username'] = $employee->getUsername();
		$data['password'] = $employee->getPassword();
		$data["date_time"] = $employee->getDateTime();
	}
}

$main["content"] = array();
$content["info"] = array();
$content["employee"] = array();

array_push($content["info"],$info);
array_push($content["employee"],$data);
array_push($main["content"],$content);

echo json_encode($main, true);