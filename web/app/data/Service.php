<?php
namespace App\Data;

/**
* @Author: Cecil Migayi
* @Email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* This class assist in handling any service data 
*/

class Service{
	private $serviceId;
	private $serviceCartegoryId;
	private $serviceName;
	private $serviceDesc;
	private $fee;
	private $createdBy;
	private $dateTime;

	/**
	* setter method
	*
	* @param int($serviceId) 
	*/
	public function setServiceId($serviceId){
		$this->serviceId = $serviceId;
	}

	/**
	* getter method
	*
	* @return int(id)
	*/
	public function getServiceId(){
		return $this->serviceId;
	}

	/**
	* setter method
	*
	* @param int($serviceCartegoryId) 
	*/
	public function setServiceCartegoryId($serviceCartegoryId){
		$this->serviceCartegoryId = $serviceCartegoryId;
	}
	
	/**
	* getter method
	*
	* @return int(id)
	*/
	public function getServiceCartegoryId(){
		return $this->serviceCartegoryId;
	}

	/**
	* setter method
	*
	* @param String($serviceName)
	*/
	public function setServiceName($serviceName){
		$this->serviceName = $serviceName;
	}

	/**
	* getter method
	*
	* @return String
	*/
	public function getServiceName(){
		return $this->serviceName; 
	}

	/**
	* setter method
	*
	* @param String($serviceDesc)
	*/
	public function setServiceDesc($serviceDesc){
		$this->serviceDesc = $serviceDesc;
	}

	/**
	* getter method
	*
	* @return String
	*/
	public function getServiceDesc(){
		return $this->serviceDesc; 
	}

	/**
	* setter method
	*
	* @param decimal($free) 
	*/
	public function setFee($fee){
		$this->fee = $fee;
	}

	/**
	* getter method
	*
	* @return decimal(id)
	*/
	public function getFee(){
		return $this->fee;
	}

	/**
	* setter method
	*
	* @param int($createdBy)
	*/
	public function setCreatedBy($createdBy){
		$this->createdBy = $createdBy;
	}

	/**
	* getter method
	*
	* @return String
	*/
	public function getCreatedBy(){
		return $this->createdBy;
	}

	/**
	* setter method
	*
	* @param String($dateTime) 
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