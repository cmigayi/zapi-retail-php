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
$dataFormat = $url_pieces[7];

$csvData = explode('|', $url_pieces[5]);	
print_r($csvData);

$results = 0;
$content["info"] = array();
$content["business"] = array();
$main["content"] = array();

foreach($csvData as $csvItem){		
	$csvData = explode(',', $csvItem);
	//set data
	$business->setBusinessName($csvData[0]); 
	$business->setBusinessType(""); 
	$business->setBusinessLocation($csvData[1]); 
	$business->setBusinessCountry($csvData[2]); 
	$business->setBusinessLogo(""); 
	$business->setOwnerId($userId);
		
	//set repository
	$addBusiness = new AddBusiness($businessRepository);
	$business = $addBusiness->createBusiness($business);
	
	if($business != null){
		$results = $results + 1;
		$data["business_id"] = $business->getBusinessId();  
		$data["name"] = $business->getBusinessName();  
		$data["type"] = $business->getBusinessType();  
		$data["location"] = $business->getBusinessLocation();  
		$data["country"] = $business->getBusinessCountry();  
		$data["logo"] = $business->getBusinessLogo();  
		$data["owner_id"] = $business->getOwnerId(); 
	}	
	array_push($content["business"], $data);
}
$info["results"] = $results;
array_push($content["info"], $info);
array_push($main["content"], $content);

echo json_encode($main, true);
