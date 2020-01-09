<?php
require_once("vendor/autoload.php");

use App\Middlewares\Businesses;
use App\Repositories\BusinessRepository;
use App\Data\Business;

$verb = $_SERVER['REQUEST_METHOD'];
$url_pieces = explode('/', $_SERVER['PATH_INFO']);
if($url_pieces[1] != "zapi-v1"){	
	return http_response_code(404);
}

$userId = $url_pieces[3];

$businessRepo = new BusinessRepository();

$businesses = new Businesses($businessRepo);
$data = $businesses->getOwnerBusinesses($userId);
//print_r($ownerBusinesses); 
// Count records found
$recordCount = count($data[0]);	

$main["content"] = array();
$content["info"] = array();
$content["businesses"] = array();

if($data == null){
	$info["status"] = false;	
}else{
	$info["status"] = true;	
}

$info["records"] = $recordCount;

array_push($content["info"],$info);
array_push($content["businesses"],$data[0]);
array_push($main["content"],$content);

echo json_encode($main, true);