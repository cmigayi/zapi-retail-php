<?php
require_once("vendor/autoload.php");

use App\Data\FixedAsset;
use App\Repositories\AssetRepository; 
use App\Middlewares\AddAsset;

//initialize objects
$fixedAsset = new FixedAsset();
$assetRepository = new AssetRepository();

//Data validation

//$businessId = $_POST['business_id'];
$businessId = 3;

//$title = $_POST['title'];
$title = "Office printer";

//$desc = $_POST['description'];
$desc = "Wireless, usb, network cable HP printer";

//$amount = $_POST['amount'];
$amount = 8000;

//set data
$fixedAsset->setBusinessId($businessId); 
$fixedAsset->setTitle($title); 
$fixedAsset->setDescription($desc); 
$fixedAsset->setAmount($amount); 

//set repository
$addAsset = new AddAsset($assetRepository);
$fixedAsset = $addAsset->createFixedAsset($fixedAsset);

if($fixedAsset == null){
	$info["status"] = false;
	$info["results"] = 0;
}else{	
	$info["status"] = true;
	$info["results"] = 1;
	$data["fixed_asset_id"] = $fixedAsset->getFixedAssetId();  
	$data["business_id"] = $fixedAsset->getBusinessId();  
	$data["title"] = $fixedAsset->getTitle();  
	$data["description"] = $fixedAsset->getDescription();  
	$data["amount"] = $fixedAsset->getAmount();  	
	$data["date_time"] = $fixedAsset->getDateTime();  	
}
$content["info"] = array();
$content["fixedAsset"] = array();
$main["content"] = array();

array_push($content["info"], $info);
array_push($content["fixedAsset"], $data);
array_push($main["content"], $content);

echo json_encode($main, true);
