<?php
namespace App\Common;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Handle input info
*/

class InputValidator{

	/**
	* Input validation
	*
	* @param String ($data)
	* @return String ($data)
	*/
	function validateInput($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8'); //Encodes all characters
	  return $data;
	}
}