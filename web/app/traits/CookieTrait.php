<?php

namespace App\Traits;

trait Cookie{
	public $cookieName;
	public $cookieValue; 	

	function setCookie(){
		setcookie($this->cookieName, $this->cookieValue, time() + (86400 * 30), "/");
	}

	function checkIfCookieIsEnabled(){
		if(count($_COOKIE) > 0) {
		    return true;
		}else{
			return 0;
		} 
	}

	function deleteCookie(){
		setcookie($_COOKIE[$this->cookieName], "", time() - 3600);
	}
}