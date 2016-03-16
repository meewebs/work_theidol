<?php
include_once("../../lib/session.php");
include_once("../../lib/config.php");
include_once("../../lib/function.php");
	include_once("../../lib/class.image.php");
if($delete_file){
	@unlink($delete_file);
}

if (!empty($_FILES)) {
	#print_r($_path);
	php_setPathForReady($_path);
	/*$option = array(	"path"	=>js3_pathUpload($_path), 
								"imgW"	=>$_width, 
								"imgH"	=>$_height,
								"fixSizeByWidthHeight"=>true);
	$arrResult = js3_UploadFile($_FILES["userfile"] , $option);				
	
	echo $arrResult['filename'];*/
		$newName			= php_decode_file($_FILES['userfile']['name']);
		$image = new UploadImage();
    $image->load($_FILES['userfile']['tmp_name']);
    
	

	$image->resizeToWidth(400);
    $image->save($_path.$newName);
	echo $newName;
	
	/*end upload image*/
	
}
?>