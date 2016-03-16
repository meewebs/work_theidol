<?php
include_once("../../lib/session.php");
include_once("../../lib/config.php");
include_once("../../lib/function.php");

if($delete_file){
	@unlink($delete_file);
}

if (!empty($_FILES)) {
	
	php_setPathForReady($_path);
	$option = array(	"path"	=>js3_pathUpload($_path), 
								"imgW"	=>$_width, 
								"imgH"	=>$_height,
								"fixSizeByWidthHeight"=>true);
	$arrResult = js3_UploadFile($_FILES["userfile"] , $option);				
	
	
	if($g_id){
		
		$insert = "";
		$insert[$table."_GalleryID"] 			= "'".$g_id."'";
		$insert[$table."_Image"] 				= "'".$arrResult['filename']."'";
		
		$insert[$table."_CreateDate"] 		= "NOW()";
		$insert[$table."_LastUpdate"] 		= "NOW()";
		$insert[$table."_PrivateIP"] 			= "'".php_getPrivateIP()."'";
		$insert[$table."_IP"] 					= "'".php_getIP()."'";
		
		$sql	=	" INSERT INTO ".$table."(".implode(",",array_keys($insert)).") VALUES (".implode(",",array_values($insert)).")";
		
		mysql_query($sql);
		echo $arrResult['filename'];
		
	}else{
		
		$insert = "";
		$insert[$table_thumb."_UserID"] 				= "'".$_SESSION["Like_ID"]."'";
		$insert[$table_thumb."_Image"] 				= "'".$arrResult['filename']."'";
		
		$insert[$table_thumb."_CreateDate"] 		= "NOW()";
		$insert[$table_thumb."_LastUpdate"] 		= "NOW()";
		$insert[$table_thumb."_PrivateIP"] 			= "'".php_getPrivateIP()."'";
		$insert[$table_thumb."_IP"] 						= "'".php_getIP()."'";
		
		$sql	=	" INSERT INTO ".$table_thumb."(".implode(",",array_keys($insert)).") VALUES (".implode(",",array_values($insert)).")";
		
		mysql_query($sql);
		echo $arrResult['filename'];
		
	}
	/*end upload image*/
	
}
?>