<?php
require_once("vendor/autoload.php");

use App\Data\Employee;
use App\Repositories\EmployeeRepository; 
use App\Middlewares\AddEmployee;
use App\Common\Email;
use App\Common\Phone;
use App\Common\InputValidator;
use App\Common\Username;
use App\Common\Password;

//initialize objects
$employee = new Employee();
$employeeRepository = new EmployeeRepository();
$email = new Email();
$phone = new Phone();
$username = new Username();
$password = new Password();
$inputValidator = new InputValidator();

// set repository
$addEmployee = new AddEmployee($employeeRepository);

// Data validation

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
//$employeeEmail = "cilo@gmail.com";
$email->setEmail($employeeEmail); 
$employeeEmail = $email->validEmail();

// Phone validation
$employeePhone = $_POST['phone'];
//$employeePhone = "0718485173";
$phone->setPhoneNumber($employeePhone);
$employeePhone = $phone->validPhoneNumber();

// Username autogenerated
$employeeUsername = $username->generateUsername();
//echo $employeeUsername."<br/>";

// Password autogenerated
$employeePassword = $password->generatePassword();
//echo $employeePassword;
$password->setPassword($employeePassword);
$employeePassword = $password->encryptPassword();

$nationalId = $_POST['national_id'];
//$nationalId = "2456789";

// set data
$employee->setFname($fname);
$employee->setLname($lname);
$employee->setEmail($employeeEmail);
$employee->setPhone($employeePhone);
$employee->setUsername($employeeUsername);
$employee->setPassword($employeePassword);
$employee->setNationalId($nationalId);

if(empty($employeeEmail) || empty($employeePhone)){
	//Validation failed 
	$info["status"] = false;
	$info["records"] = 0;
}else{
	$employee = $addEmployee->createEmployee($employee);	
	
	if($employee == null){
		//Validation failed 
		$info["status"] = false;
		$info["records"] = 0;
	}else{
		$info["status"] = true;
		$info["records"] = 1;	
		$data["owner_id"] = $employee->getEmployeeId();
		$data["fname"] = $employee->getFname();
		$data["lname"] = $employee->getLname();
		$data["email"] = $employee->getEmail();
		$data["phone"] = $employee->getPhone();
		$data["username"] = $employee->getUsername();
		$data["password"] = $employee->getPassword();
		$data["national_id"] = $employee->getNationalId();
		$data["date_time"] = $employee->getDateTime();
	}
}
$content["info"] = array();
$content["employee"] = array();
$main["content"] = array();

array_push($content["info"],$info);
array_push($content["employee"],$data);
array_push($main["content"],$content);

echo json_encode($main, true);