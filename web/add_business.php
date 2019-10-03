<?php
require_once("vendor/autoload.php");

use App\Data\Business;
use App\Repositories\BusinessRepository; 
use App\Middlewares\AddBusiness;

//initialize objects
$business = new Business();
$businessRepository = new BusinessRepository();

//Data validation
$bName = "Omega enterprise";
$bType = 2;
$bLoc = "Kitengela";
$bCountry = "Kenya";
$bLogo = "none";
$bCreatedBy = 1;

//set data
$business->setBusinessName($bName); 
$business->setBusinessType($bType); 
$business->setBusinessLocation($bLoc); 
$business->setBusinessCountry($bCountry); 
$business->setBusinessLogo($bLogo); 
$business->setCreatedBy($bCreatedBy);

//set repository
$addBusiness = new AddBusiness($businessRepository);
$business = $addBusiness->createBusiness($business);
echo $business->getBusinessId()." ".$business->getBusinessName();
