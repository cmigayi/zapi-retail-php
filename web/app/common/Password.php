<?php
namespace App\Common;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Handle password info
*/

class Password{
	protected $password;

	private $log;

	public function __construct(){
		$this->log = new ErrorLogger("Password");
		$this->log = $this->log->initLog();
	}

	/**
	* Setter
	*
	* @param String (password)
	* @return void
	*/
	public function setPassword($password){
		$this->password = $password;
	}

	/**
	* Password validation
	*
	* @param void
	* @return String (password)
	*/
	public function validPassword(){
		if(empty($this->password)){
			$this->log->error("Password cannot be empty!");
			//throw new \Exception("Password cannot be empty!");
		}

		if(strlen($this->password) < 5){
			$this->log->error("Password characters must be more than 5!");
			//throw new \Exception("Password characters must be more than 5!");
		}

		return $this->password;
	}

	/**
	* Password confirmation
	*
	* @param String ($confirmPassword)
	* @return String ($confirmPassword)
	*/
	public function validConfirmPassword($confirmPassword){
		if(empty($confirmPassword)){
			$this->log->error("Confirm password is empty");
			//throw new \Exception("Confirm password is empty");
		}

		if($this->password != $confirmPassword){
			$this->log->error("Confirm password does not match password!");	
			//throw new \Exception("Confirm password does not match password!");
		}

		return $confirmPassword;
	}

	/**
	* Encrypt password with password_hash
	*
	* @param void
	* @return String password_hash(Password)
	*/
	public function encryptPassword(){
		$options = ['cost' => 12];
		$this->password = password_hash($this->password, PASSWORD_DEFAULT, $options);

		return $this->password;
	}

	/**
	* Generate a random string, using a cryptographically secure 
	* pseudorandom number generator (random_int)
	* 
	* For PHP 7, random_int is a PHP core function
	* For PHP 5.x, depends on https://github.com/paragonie/random_compat
	* 
	* @param int $length How many characters do we want?
	* @param string $keyspace A string of all possible characters
	*                         to select from
	* @return string
	*/
	public function generatePassword($length = 8, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'){
	    $pieces = [];
	    $max = mb_strlen($keyspace, '8bit') - 1;
	    for ($i = 0; $i < $length; ++$i) {
	        $pieces []= $keyspace[random_int(0, $max)];
	    }
	    return implode('', $pieces);
	}
}