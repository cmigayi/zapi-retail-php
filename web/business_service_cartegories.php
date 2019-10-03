<?php
require_once("vendor/autoload.php");

use App\Middlewares\BusinessServiceCartegories;
use App\Repositories\ServiceCartegoryRepository;

$businessId = 1;

$serviceCartegoryRepo = new ServiceCartegoryRepository();

$businessServiceCartegories = new BusinessServiceCartegories($serviceCartegoryRepo);
$data = $businessServiceCartegories->getBusinessServiceCartegories($businessId);
//print_r($ownerBusinesses); 
// Count records found
$recordCount = 0;	

$main["content"] = array();
$content["info"] = array();
$content["businessServiceCartegories"] = array();

if($data == null){
	$info["status"] = false;	
}else{
	$info["status"] = true;	
	$recordCount = count($data[0]);
}

$info["records"] = $recordCount;

array_push($content["info"],$info);
array_push($content["businessServiceCartegories"],$data[0]);
array_push($main["content"],$content);

echo json_encode($main, true);