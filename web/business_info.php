<?php
require_once("vendor/autoload.php");

use App\Middlewares\BusinessInfo;
use App\Repositories\BusinessRepository;
use App\Data\Business;

$businessId = 1;

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
	$data['created_by'] = $business->getCreatedBy();
	$data['date_time'] = $business->getDateTime();
}

$info["records"] = $recordCount;

array_push($content["info"],$info);
array_push($content["business"],$data);
array_push($main["content"],$content);

echo json_encode($main, true);