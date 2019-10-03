<?php
require_once("vendor/autoload.php");

use App\Data\Customer;
use App\Repositories\CustomerRepository; 
use App\Middlewares\AddCustomer;

//initialize objects
$customer = new Customer();
$customerRepository = new CustomerRepository();

//Data validation
$fname = "Moe";
$lname = "Jay";
$email = "hm@gmail.com";
$phone = "0745617089";
$nationalId = "23456789";

//set data
$customer->setFname($fname);
$customer->setLname($lname);
$customer->setEmail($email);
$customer->setPhone($phone);
$customer->setNationalId($nationalId);

//set repository
$addCustomer = new AddCustomer($customerRepository);
$customer = $addCustomer->createCustomer($customer);
echo $customer->getCustomerId()." ".$customer->getFname();