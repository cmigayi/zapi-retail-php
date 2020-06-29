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

//Data validation

$expenseId = $_POST['expense_id'];
//$expenseId = 1;

$businessId = $_POST['business_id'];
//$businessId = 1;

$amount = $_POST['amount'];
//$amount = "405";

$expenseItem = $_POST['expense_item'];
//$expenseItem = "Rent";

$type = $_POST['expense_type'];

//set data
$expense->setExpenseId($expenseId);
$expense->setBusinessId($businessId);
$expense->setExpenseItem($expenseItem);
$expense->setExpenseType($type);
$expense->setAmount($amount);

//set repository
$expenseInfo = new ExpenseInfo($expenseRepository);
$expense = $expenseInfo->updateExpense($expense);

if($expense == null){
	$info["status"] = false;
	$info["results"] = 0;
}else{
	$info["status"] = true;
	$info["results"] = 1;
	$data["expense_id"] = $expense->getExpenseId();
	$data["business_id"] = $expense->getBusinessId();
	$data["expense_item"] = $expense->getExpenseItem();
	$data["type"] = $expense->getExpenseType();
	$data["amount"] = $expense->getAmount();
}
$content["info"] = array();
$content["expense"] = array();
$main["content"] = array();

array_push($content["info"], $info);
array_push($content["expense"], $data);
array_push($main["content"], $content);

echo json_encode($main, true);
