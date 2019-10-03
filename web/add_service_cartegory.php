<?php
require_once("vendor/autoload.php");

use App\Data\ServiceCartegory;
use App\Repositories\ServiceCartegoryRepository; 
use App\Middlewares\AddServiceCartegory;
use App\Common\ErrorLogger;

//initialize objects
$serviceCartegory = new ServiceCartegory();
$serviceCartegoryRepository = new ServiceCartegoryRepository();
$log = new ErrorLogger("add_service_cartegory");
$log = $log->initLog();

//Data validation
$businessId = 1;
$cartegoryName = "Lab services";
$cartegoryDesc = "";
$createdBy = 1;

//set data
$serviceCartegory->setBusinessId($businessId);
$serviceCartegory->setCartegoryName($cartegoryName);
$serviceCartegory->setCartegoryDesc($cartegoryDesc);
$serviceCartegory->setCreatedBy($createdBy);

//set repository
$addServiceCartegory = new AddServiceCartegory($serviceCartegoryRepository);

try{
	$serviceCartegory = $addServiceCartegory->createServiceCartegory($serviceCartegory);
	echo $serviceCartegory->getServiceCartegoryId()." ".$serviceCartegory->getCartegoryName();

}catch(\Exception $e){
	// logger
	$log->error("Error ".$e->getMessage());
}