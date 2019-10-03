<?php

namespace App\Traits;

trait Image{

	public $imageFile;
	public $targetFile;
	public $uploadOk;

	public function setImageFile($imageFile){
		$this->imageFile = $imageFile; 
	}

	public function setImageTargetDirectoryAndFile($targetFile){
		$this->targetFile = $targetFile;
	} 

	public function validImageFile(){
		$check = getimagesize($this->imageFile);
		$imageFileType = pathinfo(basename($_FILES["fileToUpload"]["name"]),PATHINFO_EXTENSION);

		if($check !== false) {
		//     throw new \Exception("File is an image - " . $check["mime"] . ".");
				$this->uploadOk = 1;
		} else {
		    throw new \Exception("File is not an image.");
		    $this->uploadOk = 0;
		}

		// Check if file already exists
		if (file_exists($this->targetFile)) {
		    throw new \Exception("Sorry, file already exists.");
		    $this->uploadOk = 0;
		}

		// Check if file format is correct
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
			throw new \Exception("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
			$this->uploadOkk = 0;
		}

		return $this->targetFile;				
	}

	public function uploadImage(){
		// Upload Image
		if($this->uploadOk > 0){
			if(move_uploaded_file($this->imageFile, $this->targetFile)){				
				return true;
			}
		}
	}

	public function deleteImage(){
		if(!empty($this->targetFile)){
			if(unlink($this->targetFile)){
				return true;
			}else{
				return false;
			}
		}
	}

	function compressImage() {
		$source_file = $this->targetFile; 
		$target_file = $this->targetFile; 
		$nwidth=0; 
		$nheight=0; 
		$quality=90;

	  //Return an array consisting of image type, height, widh and mime type.
	  $image_info = getimagesize($source_file);
	  if(!($nwidth > 0)) $nwidth = $image_info[0];
	  if(!($nheight > 0)) $nheight = $image_info[1];
	  
	  if(!empty($image_info)) {
	  	switch($image_info['mime']) {
	    	case 'image/jpeg' :
	        	if($quality == '' || $quality < 0 || $quality > 100) $quality = 75; //Default quality
	        	// Create a new image from the file or the url.
	        	$image = imagecreatefromjpeg($source_file);
	        	$thumb = imagecreatetruecolor($nwidth, $nheight);
	        	//Resize the $thumb image
	        	imagecopyresized($thumb, $image, 0, 0, 0, 0, $nwidth, $nheight, $image_info[0], $image_info[1]);
	        	//Output image to the browser or file.
	        	return imagejpeg($thumb, $target_file, $quality); 	        
	        break;
	      
	      	case 'image/png' :
	        	if($quality == '' || $quality < 0 || $quality > 9) $quality = 6; //Default quality
	        	// Create a new image from the file or the url.
	        	$image = imagecreatefrompng($source_file);
	        	$thumb = imagecreatetruecolor($nwidth, $nheight);
	        	//Resize the $thumb image
	        	imagecopyresized($thumb, $image, 0, 0, 0, 0, $nwidth, $nheight, $image_info[0], $image_info[1]);
	        	// Output image to the browser or file.
	        	return imagepng($thumb, $target_file, $quality);
	        break;
	        
	      	case 'image/gif' :
	        	if($quality == '' || $quality < 0 || $quality > 100) $quality = 75; //Default quality
	        	// Create a new image from the file or the url.
	        	$image = imagecreatefromgif($source_file);
	        	$thumb = imagecreatetruecolor($nwidth, $nheight);
	        	//Resize the $thumb image
	        	imagecopyresized($thumb, $image, 0, 0, 0, 0, $nwidth, $nheight, $image_info[0], $image_info[1]);
	        	// Output image to the browser or file.
	        	return imagegif($thumb, $target_file, $quality); //$success = true;
	        break;
	        
	      	default:
	        	throw new \Exception("File type not supported!");
	        break;
	    }
	  }
	}
	
}