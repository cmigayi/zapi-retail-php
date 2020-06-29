<?php
require_once("vendor/autoload.php");

use App\Data\Expense;
use App\Repositories\ExpenseRepository;
use App\Middlewares\ExpenseInfo;

//initialize objects
$expense = new Expense();
$expenseRepository = new ExpenseRepository();
$expenseInfo = new ExpenseInfo($expenseRepository);

$verb = $_SERVER['REQUEST_METHOD'];
$url_pieces = explode('/', $_SERVER['PATH_INFO']);
if($url_pieces[1] != "zapi-v1"){
	return http_response_code(404);
}

$userId = $url_pieces[3];

$expenseId = $url_pieces[5];

// Data validation

//$expenseId = 1;

$data = $expenseInfo->deleteExpense($expenseId);

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
