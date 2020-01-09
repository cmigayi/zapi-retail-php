<?php
namespace App\Data;

/**
* @Author: Cecil Migayi
* @Email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* This class assist in handling any business data 
*/

class Business{
	private $businessId;
	private $businessName;
	private $businessType;
	private $businessLocation;
	private $businessCountry;
	private $businessLogo;
	private $ownerId;
	private $dateTime;

	/**
	* setter method
	*
	* @param int($id) 
	*/
	public function setBusinessId($id){
		$this->businessId = $id;
	}

	/**
	* getter method
	*
	* @return int
	*/
	public function getBusinessId(){
		return $this->businessId;
	}

	/**
	* setter method
	*
	* @param String($name) 
	*/
	public function setBusinessName($name){
		$this->businessName = $name;
	}

	/**
	* getter method
	*
	* @return String
	*/
	public function getBusinessName(){
		return $this->businessName;
	}

	/**
	* setter method
	*
	* @param String($type) Description of the business or business cartegory info
	*/
	public function setBusinessType($type){
		$this->businessType = $type;
	}

	/**
	* getter method
	*
	* @return String
	*/
	public function getBusinessType(){
		return $this->businessType;
	}

	/**
	* setter method
	*
	* @param String($type) Where the business is located
	*/
	public function setBusinessLocation($location){
		$this->businessLocation= $location;
	}

	/**
	* getter method
	*
	* @return String
	*/
	public function getBusinessLocation(){
		return $this->businessLocation;
	}

	/**
	* setter method
	*
	* @param String($type) which country is the business located
	*/
	public function setBusinessCountry($country){
		$this->businessCountry = $country;
	}

	/**
	* getter method
	*
	* @return String
	*/
	public function getBusinessCountry(){
		return $this->businessCountry;
	}

	/**
	* setter method
	*
	* @param String($type) URL to the business logo
	*/
	public function setBusinessLogo($logo){
		$this->businessLogo = $logo;
	}

	/**
	* getter method
	*
	* @return String
	*/
	public function getBusinessLogo(){
		return $this->businessLogo;
	}

	/**
	* setter method
	*
	* @param int($ownerId) 
	*/
	public function setOwnerId($ownerId){
		$this->ownerId = $ownerId;
	}

	/**
	* getter method
	*
	* @return int
	*/
	public function getOwnerId(){
		return $this->ownerId;
	}

	/**
	* setter method
	*
	* @param String($type) Date and time the business was inserted to app db
	*/
	public function setDateTime($dateTime){
		$this->dateTime = $dateTime;
	}

	/**
	* getter method
	*
	* @return String
	*/
	public function getDateTime(){
		return $this->dateTime;
	}
}

