<?php
require_once("vendor/autoload.php");

use App\Data\Business;
use App\Repositories\BusinessRepository; 
use App\Middlewares\BusinessInfo;
use App\Common\Email;
use App\Common\Phone;
use App\Common\InputValidator;

$verb = $_SERVER['REQUEST_METHOD'];
$url_pieces = explode('/', $_SERVER['PATH_INFO']);
if($url_pieces[1] != "zapi-v1"){	
	return http_response_code(404);
}

$userId = $url_pieces[3];
$businessId = $url_pieces[5];

//initialize objects
$business = new Business();
$businessRepository = new BusinessRepository();
$businessInfo = new BusinessInfo($businessRepository);
$email = new Email();
$phone = new Phone();
$inputValidator = new InputValidator();

// Data validation

$businessId = $businessId;
//$businessId = 1;

// Data validation

$bName = $_POST['name'];
//$bName = "BB";

//$bType = $_POST['business_type'];
$bType = "ddsd";

$bLoc = $_POST['location'];
//$bLoc = "Mombasa";

$bCountry = $_POST['country'];
//$bCountry = "gh";

$bLogo = "none";
$ownerId = $userId;

//set data
$business->setBusinessId($businessId); 
$business->setBusinessName($bName); 
$business->setBusinessType($bType); 
$business->setBusinessLocation($bLoc); 
$business->setBusinessCountry($bCountry); 
$business->setBusinessLogo($bLogo); 
$business->setOwnerId($ownerId);

$business = $businessInfo->updateBusiness($business);

if($business == null){
	$info["status"] = false;	
	$info["results"] = 0;	
}else{	
	$info["status"] = true;
	$info["results"] = 1;
	$data["business_id"] = $business->getBusinessId();  
	$data["name"] = $business->getBusinessName();  
	$data["type"] = $business->getBusinessType();  
	$data["location"] = $business->getBusinessLocation();  
	$data["country"] = $business->getBusinessCountry();  
	$data["logo"] = $business->getBusinessLogo();  
	$data["owner_id"] = $business->getOwnerId(); 	
}

$content["info"] = array();
$content["business"] = array();
$main["content"] = array();

array_push($content["info"], $info);
array_push($content["business"], $data);
array_push($main["content"], $content);

echo json_encode($main, true);