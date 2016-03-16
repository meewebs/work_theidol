<?php
include_once("../../myAdmin/lib/session.php");
include_once("../../myAdmin/lib/config.php");
include_once("../../myAdmin/lib/function.php");
include_once("../../myAdmin/mod/_facebook_rank/config.php");

//Application Configurations
$app_id			= "439124362793076";
$app_secret		= "87c07ec728b70f6f1a2202cfdad9f886";
$site_url			= "https://bravocampaign.com/fb_certainty/";

try{
	include_once "facebook_library/facebook.php";
}catch(Exception $e){
	error_log($e);
}
// Create our application instance
$facebook = new Facebook(array(
	'appId'		=> $app_id,
	'secret'		=> $app_secret,
	));

// Get User ID
$user = $facebook->getUser();

if($user){
//==================== Single query method ======================================
	try{
		// Proceed knowing you have a logged in user who's authenticated.
		$me 		= $facebook->api('/me');
		$user 	= $facebook->getUser();
		
	}catch(FacebookApiException $e){
		error_log($e);
		$user = NULL;
	}
//==================== Single query method ends =================================
}

#print_r($me);

if($me){

	//$friends = $facebook->api('/me/friends');
	$query 	= "SELECT uid,name FROM user WHERE uid IN (SELECT uid2 FROM friend WHERE uid1 = ".$me["id"].") ";

	try { 
		$result = $facebook->api(array(
			'method' => 'fql.query',
			'query' => $query,
		));
	} catch (FacebookApiException $e) {
		error_log($e);
		$result = 'none';
	}	
	
	#echo count($result);
	#echo"<pre>";
	#print_r($result);
	foreach ($result as $value) {
		
		$sql 		=  " SELECT "._TABLE_FRIENDS_."_ID FROM "._TABLE_FRIENDS_." WHERE "._TABLE_FRIENDS_."_FriendID = '".$value["uid"]."' ".
						" AND "._TABLE_FRIENDS_."_FacebookID = '".$_SESSION["facebook_id"]."' ";
		$result 	= mysql_query($sql);
		if($rs 	= mysql_fetch_assoc($result)){
			
			$update 	= "";
			$update[] = _TABLE_FRIENDS_."_Name 			= '".$value["name"]."'";
			$update[] = _TABLE_FRIENDS_."_Like 				= 0 ";
			$update[] = _TABLE_FRIENDS_."_LastUpdate 	= NOW()";
			
			$sql	=	" UPDATE "._TABLE_FRIENDS_." SET ".implode(",",$update)." WHERE "._TABLE_FRIENDS_."_FriendID = '".$value["uid"]."' ".
						" AND "._TABLE_FRIENDS_."_FacebookID = '".$_SESSION["facebook_id"]."' ";
			mysql_query($sql);
			
		}else{
			
			$insert = "";
			$insert[_TABLE_FRIENDS_."_FacebookID"] 		= "'".$_SESSION["facebook_id"]."'";
			$insert[_TABLE_FRIENDS_."_FriendID"] 			= "'".$value["uid"]."'";
			$insert[_TABLE_FRIENDS_."_Name"] 				= "'".$value["name"]."'";
			$insert[_TABLE_FRIENDS_."_Like"] 					= "0";
			
			$insert[_TABLE_FRIENDS_."_CreateDate"] 		= "NOW()";
			$insert[_TABLE_FRIENDS_."_LastUpdate"] 		= "NOW()";
			$insert[_TABLE_FRIENDS_."_PrivateIP"] 			= "'".php_getPrivateIP()."'";
			$insert[_TABLE_FRIENDS_."_IP"] 						= "'".php_getIP()."'";
			
			$sql	=	" INSERT INTO "._TABLE_FRIENDS_."(".implode(",",array_keys($insert)).") VALUES (".implode(",",array_values($insert)).")";
			mysql_query($sql);
			
		}
		
	}//end foreach
	
	
	$query 	= " SELECT uid, page_id FROM page_fan WHERE uid IN (SELECT uid2 FROM friend WHERE uid1 = ".$me["id"].") and page_id = '205789412767791' ";

	try { 
		$result = $facebook->api(array(
			'method' => 'fql.query',
			'query' => $query,
		));
	} catch (FacebookApiException $e) {
		error_log($e);
		$result = 'none';
	}
	#echo "<pre>";
	#print_r($result);
	$i = 0;
	foreach ($result as $value) {
		
		$update 	= "";
		$update[] = _TABLE_FRIENDS_."_Like 				= 1 ";
		$update[] = _TABLE_FRIENDS_."_LastUpdate 	= NOW()";
		
		$sql	=	" UPDATE "._TABLE_FRIENDS_." SET ".implode(",",$update)." WHERE "._TABLE_FRIENDS_."_FriendID = '".$value["uid"]."' ".
					" AND "._TABLE_FRIENDS_."_FacebookID = '".$_SESSION["facebook_id"]."' ";
		mysql_query($sql);
		$i++;
		
	}
	
	// update friend count
	$update 	= "";
	$update[] = _TABLE_."_Friends 			= '".count($result)."'";
	$update[] = _TABLE_."_LastUpdate 	= NOW()";
	
	$sql	=	"UPDATE "._TABLE_." SET ".implode(",",$update)." WHERE "._TABLE_."_FacebookID = '".$_SESSION["facebook_id"]."' ";
	mysql_query($sql);
	
	$_SESSION["facebook_update"] = "Yes";
	
	
}else{
	$loginUrl = $facebook->getLoginUrl(array(
	//'scope'	=> 'email,user_likes,publish_stream,read_stream, user_birthday ,publish_actions ,friends_likes'
	'scope'	=> 'email,user_likes ,publish_actions,friends_likes'
	));
	
}
?>