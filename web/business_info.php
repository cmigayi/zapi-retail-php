<?php
require_once("vendor/autoload.php");

use App\Middlewares\BusinessInfo;
use App\Repositories\BusinessRepository;
use App\Data\Business;

$verb = $_SERVER['REQUEST_METHOD'];
$url_pieces = explode('/', $_SERVER['PATH_INFO']);
if($url_pieces[1] != "zapi-v1"){	
	return http_response_code(404);
}

$userId = $url_pieces[3];

$businessId = $url_pieces[5];

$businessRepo = new BusinessRepository();

$business = new Business();
$businessInfo = new BusinessInfo($businessRepo);
$business = $businessInfo->getBusiness($businessId);
//print_r($ownerBusinesses); 
// Count records found
$recordCount = 0;	

$main["content"] = array();
$content["info"] = array();
$content["business"] = array();

if($business == null){
	$info["status"] = false;	
}else{
	$recordCount = 1;

	$info["status"] = true;	

	$data = array();
	$data['business_id'] = $business->getBusinessId();
	$data['business_name'] = $business->getBusinessName();
	$data['business_type'] = $business->getBusinessType();
	$data['location'] = $business->getBusinessLocation();
	$data['country'] = $business->getBusinessCountry();
	$data['logo'] = $business->getBusinessLogo();
	$data['owner_id'] = $business->getOwnerId();
	$data['date_time'] = $business->getDateTime();
}

$info["records"] = $recordCount;

array_push($content["info"],$info);
array_push($content["business"],$data);
array_push($main["content"],$content);

echo json_encode($main, true);