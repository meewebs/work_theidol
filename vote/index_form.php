<?php
include_once("../myAdmin/lib/session.php");
header("Content-type: text/html; charset=UTF-8");
include_once("../myAdmin/lib/config.php");
include_once("../myAdmin/lib/function.php");
include_once("../myAdmin/mod/_facebook_photo/config.php");

function DateTimeDiff($strDateTime1,$strDateTime2){
	return (strtotime($strDateTime2) - strtotime($strDateTime1))/  ( 60 * 60 ); // 1 Hour =  60*60
}


if($_POST["action"] == "registerSave"){
	
	$insert = "";
	$insert[_TABLE_REGISTER_."_FacebookID"] 			= "'".$_SESSION["facebook_id"]."'";
	$insert[_TABLE_REGISTER_."_FirstName"] 				= "'".$txt_FirstName."'";
	$insert[_TABLE_REGISTER_."_LastName"] 				= "'".$txt_LastName."'";
	$insert[_TABLE_REGISTER_."_Email"] 						= "'".$txt_Email."'";
	$insert[_TABLE_REGISTER_."_Phone"] 					= "'".$txt_Phone."'";
	
	$insert[_TABLE_REGISTER_."_No"] 							= "'".$txt_No."'";
	$insert[_TABLE_REGISTER_."_Moo"] 						= "'".$txt_Moo."'";
	#$insert[_TABLE_REGISTER_."_Village"] 					= "'".$txt_Village."'";
	$insert[_TABLE_REGISTER_."_Soi"] 							= "'".$txt_Soi."'";
	$insert[_TABLE_REGISTER_."_Road"] 						= "'".$txt_Road."'";
	$insert[_TABLE_REGISTER_."_Tumbon"] 					= "'".$txt_Tumbon."'";
	$insert[_TABLE_REGISTER_."_Ampure"] 					= "'".$txt_Ampure."'";
	$insert[_TABLE_REGISTER_."_Province"] 					= "'".$txt_Province."'";
	$insert[_TABLE_REGISTER_."_Postcode"] 				= "'".$txt_Postcode."'";
	
	$insert[_TABLE_REGISTER_."_CreateDate"] 				= "NOW()";
	$insert[_TABLE_REGISTER_."_LastUpdate"] 			= "NOW()";
	$insert[_TABLE_REGISTER_."_PrivateIP"] 					= "'".php_getPrivateIP()."'";
	$insert[_TABLE_REGISTER_."_IP"] 							= "'".php_getIP()."'";
	
	$sql = " INSERT INTO "._TABLE_REGISTER_."(".implode(",",array_keys($insert)).") VALUES (".implode(",",array_values($insert)).")";
	
	#echo $sql;
	
	if(mysql_query($sql)){
		echo "OK";	
	}else{
		echo "Fail";	
	}
		
}

?>