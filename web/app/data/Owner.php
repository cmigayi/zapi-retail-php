<?php
namespace App\Data;

/**
* @Author: Cecil Migayi
* @Email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* This class assist in handling any owner data 
*/

class Owner{

	private $ownerId;
	private $fname;
	private $lname;
	private $email;
	private $phone;
	private $username;
	private $password;
	private $dateTime;

	public function setOwnerId($ownerId){
		$this->ownerId = $ownerId;
	}

	public function getOwnerId(){
		return $this->ownerId;
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

	public function setDateTime($dateTime){
		$this->dateTime = $dateTime;
	}

	public function getDateTime(){
		return $this->dateTime;
	}
}