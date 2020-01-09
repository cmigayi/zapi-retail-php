<?php
require_once("vendor/autoload.php");

use App\Data\Business;
use App\Repositories\BusinessRepository; 
use App\Middlewares\AddBusiness;

//initialize objects
$business = new Business();
$businessRepository = new BusinessRepository();

//assume JSON, handle requests by verb and path
$verb = $_SERVER['REQUEST_METHOD'];
$url_pieces = explode('/', $_SERVER['PATH_INFO']);
if($url_pieces[1] != "zapi-v1"){	
	return http_response_code(404);
}

$userId = $url_pieces[3];

//Data validation

$bName = $_POST['name'];
//$bName = "BB";

//$bType = $_POST['business_type'];
$bType = "ddsd";

$bLoc = $_POST['location'];
//$bLoc = "loc";

$bCountry = $_POST['country'];
//$bCountry = "gh";

$bLogo = "none";
$ownerId = $userId;

//set data
$business->setBusinessName($bName); 
$business->setBusinessType($bType); 
$business->setBusinessLocation($bLoc); 
$business->setBusinessCountry($bCountry); 
$business->setBusinessLogo($bLogo); 
$business->setOwnerId($ownerId);

//set repository
$addBusiness = new AddBusiness($businessRepository);
$business = $addBusiness->createBusiness($business);

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
