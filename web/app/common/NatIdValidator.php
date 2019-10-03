<?php
namespace App\Common;

class NatIdValidator{

	public function validateNatId($natId){
		if(empty($natId) || strlen($natId) < 6){
			return false;
		}else{
			if (is_numeric($natId)) {
				return true;
			}else{
				return false;
			}
		}
	}

	public function validatePassportNumner($ppId){
		if(empty($ppId) || strlen($ppId) < 6){
			return false;
		}else{
			if (preg_match('^(?!^0+$)[a-zA-Z0-9]{3,20}$', $ppId)) {
				return true;
			}else{
				return false;
			}
		}
	}

}