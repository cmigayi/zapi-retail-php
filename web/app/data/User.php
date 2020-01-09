<?php
namespace App\Data;

/**
* @Author: Cecil Migayi
* @Email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* This class assist in handling any user data 
*/

class User{

	private $userId;
	private $fname;
	private $lname;
	private $email;
	private $phone;
	private $username;
	private $password;
	private $userSession;
	private $dateTime;

	public function setUserId($userId){
		$this->userId = $userId;
	}

	public function getUserId(){
		return $this->userId;
	}

	public function setFname($fname){
		$this->fname = $fname;
	}

	public function getFname(){
		return $this->fname;
	}

	public function setLname($lname){
		$this->lname = $lname;
	}

	public function getLname(){
		return $this->lname;
	}

	public function setEmail($email){
		$this->email = $email;
	}

	public function getEmail(){
		return $this->email;
	}

	public function setPhone($phone){
		$this->phone = $phone;
	}

	public function getPhone(){
		return $this->phone;
	}

	public function setUsername($username){
		$this->username = $username;
	}

	public function getUsername(){
		return $this->username;
	}

	public function setPassword($password){
		$this->password = $password;
	}

	public function getPassword(){
		return $this->password;
	}
	
	public function setUserSession($userSession){
		$this->userSession = $userSession;
	}

	public function getUserSession(){
		return $this->userSession;
	}

	public function setDateTime($dateTime){
		$this->dateTime = $dateTime;
	}

	public function getDateTime(){
		return $this->dateTime;
	}
}