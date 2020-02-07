<?php
require_once("vendor/autoload.php");

use App\Data\Expense;
use App\Repositories\ExpenseRepository; 
use App\Middlewares\AddExpense;

//initialize objects
$expense = new Expense();
$expenseRepository = new ExpenseRepository();

//Data validation

//$businessId = $_POST['business_id'];
$businessId = 1;

//$expenseItem = $_POST['expense_item'];
$expenseItem = "Rent";

//$type = $_POST['type'];
$type = "Recurring";

//$amount = $_POST['amount'];
$amount = "400";

//set data
$expense->setBusinessId($businessId); 
$expense->setExpenseItem($expenseItem); 
$expense->setExpenseType($type); 
$expense->setAmount($amount); 

//set repository
$addExpense = new AddExpense($expenseRepository);
$expense = $addExpense->createExpense($expense);

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
