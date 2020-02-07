<?php
namespace App\Models;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Handle business credit data from mysql
*/

use App\Databases\Database;
use App\Data\Expense;
use App\Common\ErrorLogger;

class ExpenseModel extends Database{
	private $expense;
	private $dateTime;
	private $result;
	private $log;

	public function __construct(){
		/**
		* Date and time generated for date and time record creation 
		*/		
		$this->dateTime = date("Y-m-d h:i:sa");

		/**
		* initialize logger
		*/
		$this->log = new ErrorLogger('ExpenseModel');
		$this->log = $this->log->initLog();

		try{
			/**
			* Connect to PDO database 
			*/
			$this->pdoConfig();
		}catch(\Exception $e){
			//logger
			$this->log->error("Error ".$e->getMessage());
		}
	}

	public function setData(Expense $expense){
		$this->expense = $expense;
	}

	/**
	* Handle Expense creation	*
	* PDO transaction used because one query depends on another
	*
	* @return Expense data (Expense)
	*/
	public function createExpense(){
		$this->passedData = array(
				$this->expense->getBusinessId(),
				$this->expense->getExpenseItem(),
				$this->expense->getExpenseType(),
				$this->expense->getAmount(),
				$this->dateTime
			);

		$this->expense = new Expense();

		try{
			$this->pdo->beginTransaction();
			$this->sql = "INSERT INTO expenses VALUES(null,?,?,?,?,?)";
			$this->pdoPrepareAndExecute();
			$expenseId = $this->pdo->lastInsertId();
			$this->expense = $this->getExpense($expenseId);
			$this->pdo->commit();

		}catch(\PDOException $e){
			$this->pdo->rollback();
			echo $e;
			//logger required!
		}
		return $this->expense;		
	}	

	/**
	* Handle individual expense data retrieval based on expenseId
	*
	* @param int($expenseId) 
	* @return expense data (Expense)
	*/
	public function getExpense($expenseId){
		$this->passedData = array($expenseId);
		$this->sql = "SELECT * FROM expenses WHERE expense_id=?";
		$this->result = $this->pdoFetchRow();

		$this->expense = new Expense();
		
		if($this->result == null){
			$this->expense = null;
		}else{
			$this->expense->setExpenseId($this->result[0]['expense_id']);
			$this->expense->setBusinessId($this->result[0]['business_id']);
			$this->expense->setExpenseItem($this->result[0]['expense_item']);
			$this->expense->setExpenseType($this->result[0]['expense_type']);
			$this->expense->setAmount($this->result[0]['amount']);
			$this->expense->setDateTime($this->result[0]['date_time']);
		}
		return $this->expense;
	}
	
	/**
	* Handle expenses data retrieval
	*
	* @param int($businessId)
	* @return array expenses info 
	*/
	public function getBusinessExpenses($businessId){
		$this->passedData = array($businessId);

		try{						
			$this->sql = "SELECT * FROM expenses WHERE business_id=?";
			$this->result = $this->pdoFetchRows();
		}catch(\PDOException $e){
			//logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->result;
	}
	
	/**
	* Handle recurring expenses data retrieval
	*
	* @param int($businessId)
	* @return array expenses info 
	*/
	public function getBusinessRecurringExpenses($businessId){
		$this->passedData = array(
			$businessId,
			"Recurring"
		);

		try{						
			$this->sql = "SELECT * FROM expenses WHERE business_id=? AND expense_type=?";
			$this->result = $this->pdoFetchRows();
		}catch(\PDOException $e){
			//logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->result;
	}
	
	/**
	* Handle non-recurring expenses data retrieval
	*
	* @param int($businessId)
	* @return array expenses info 
	*/
	public function getBusinessNonRecurringExpenses($businessId){
		$this->passedData = array(
			$businessId,
			"Non-recurring"
		);

		try{						
			$this->sql = "SELECT * FROM expenses WHERE business_id=? AND expense_type=?";
			$this->result = $this->pdoFetchRows();
		}catch(\PDOException $e){
			//logger
			$this->log->error("Error ".$e->getMessage());
		}
		return $this->result;
	}
	
	/**
	* Handle expense data update
	*
	* @param none
	* @return array expense info 
	*/
	public function updateExpense(){
		$expenseId = $this->expense->getExpenseId();
		$this->passedData = array(
				$this->expense->getAmount(),
				$expenseId
			);

		$this->expense = new Expense();

		try{
			$this->pdo->beginTransaction();
			$this->sql = "UPDATE expenses SET amount=? WHERE expense_id=?";
			$this->pdoPrepareAndExecute();
			$this->expense = $this->getExpense($expenseId);
			$this->pdo->commit();

		}catch(\PDOException $e){
			$this->pdo->rollback();
			
			//logger required!
		}
		return $this->expense;		
	}
	
	/**
	* Handle expense data delete
	*
	* @param expenseId
	* @return boolean 
	*/
	public function deleteExpense($expenseId){
		$this->passedData = array($expenseId);
		try{
			$this->sql = "DELETE FROM expenses WHERE expense_id=?";
			$this->result = $this->pdoPrepareAndExecute();
		}catch(\PDOException $e){
			$this->pdo->rollback();
			
			//logger required!
		}
		return $this->result;		
	}
}