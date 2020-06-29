<?php
require_once("vendor/autoload.php");

use App\Middlewares\ExpenseInfo;
use App\Repositories\ExpenseRepository;
use App\Data\Expense;

$verb = $_SERVER['REQUEST_METHOD'];
$url_pieces = explode('/', $_SERVER['PATH_INFO']);
if($url_pieces[1] != "zapi-v1"){
	return http_response_code(404);
}

$userId = $url_pieces[3];

$expenseId = $url_pieces[5];

//$expenseId = 1;

$expenseRepo = new ExpenseRepository();

$expense = new Expense();
$expenseInfo = new ExpenseInfo($expenseRepo);
$expense = $expenseInfo->getExpense($expenseId);

if($expense == null){
	$info["status"] = false;
	$info["records"] = 0;
}else{
	$info["status"] = true;
	$info["results"] = 1;
	$data["expense_id"] = $expense->getExpenseId();
	$data["business_id"] = $expense->getBusinessId();
	$data["expense_item"] = $expense->getExpenseItem();
	$data["type"] = $expense->getExpenseType();
	$data["amount"] = $expense->getAmount();
}

$main["content"] = array();
$content["info"] = array();
$content["expense"] = array();

array_push($content["info"],$info);
array_push($content["expense"],$data);
array_push($main["content"],$content);

echo json_encode($main, true);
