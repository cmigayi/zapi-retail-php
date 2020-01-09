<?php
namespace App\Traits;

use App\Data\User;

trait Session{

	public $user;

	public function startSession(){			
		if (session_status() == PHP_SESSION_NONE){
		    session_start();
		}
	}

	public function initializeSessionData($user){
		$this->user = $user;
		$_SESSION['sess_id'] = session_id();
		$_SESSION['user_id'] = $this->user->getUserId();
		$_SESSION['fname'] = $this->user->getFname();
		$_SESSION['lname'] = $this->user->getLname();
		$_SESSION['email'] = $this->user->getEmail();		
	} 

	public function getSessionData(){
		$this->user = new User();
		
		$this->user->setUserId($_SESSION['user_id']);
		$this->user->setUserSession($_SESSION['sess_id']);
		$this->user->setFname($_SESSION['fname']);
		$this->user->setLname($_SESSION['lname']);
		$this->user->setEmail($_SESSION['email']);

		return $this->user;
	}

	public function authenticateSessionData(){
		if(isset($_SESSION['user_id'])){
			return true;
		}else{
			return false;
		}
	}

	public function destroySession(){
		unset($_SESSION['user_id']);
		unset($_SESSION['fname']);
		unset($_SESSION['lname']);
		unset($_SESSION['email']);

		$this->user = null;

		if(session_destroy()){
			return true;
		}
	}
} 