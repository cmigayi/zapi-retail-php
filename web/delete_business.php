<?php
require_once("vendor/autoload.php");

use App\Data\Business;
use App\Repositories\BusinessRepository; 
use App\Middlewares\BusinessInfo;

//initialize objects
$business = new Business();
$businessRepository = new BusinessRepository();
$businessInfo = new BusinessInfo($businessRepository);

$verb = $_SERVER['REQUEST_METHOD'];
$url_pieces = explode('/', $_SERVER['PATH_INFO']);
if($url_pieces[1] != "zapi-v1"){	
	return http_response_code(404);
}

$userId = $url_pieces[3];
$businessId = $url_pieces[5];

// Data validation

$businessId = $businessId;
//$businessId = 1;

$data = $businessInfo->deleteBusiness($businessId);

if($data == null){
	$info["status"] = false;	
}else{	
	$info["status"] = true;
}

$main["content"] = array();
$content["info"] = array();

array_push($content["info"],$info);
array_push($main["content"],$content);

echo json_encode($main, true);