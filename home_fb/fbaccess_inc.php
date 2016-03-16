<?php
//Application Configurations
$app_id			= "1442643672674479";
$app_secret		= "b2a45286ed7afaf0268091a935381a91";
$site_url			= "https://bravocampaign.com";

try{
	include_once "src/facebook.php";
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
		$like 	= $facebook->api("/me/likes/205789412767791");
		/*echo "<pre>";
		print_r($facebook->api("/me/likes"));
		exit();*/
	}catch(FacebookApiException $e){
		error_log($e);
		$user = NULL;
	}
//==================== Single query method ends =================================
}

if($me){
	
	$_like_id 	= $me["id"];

}else{
		
	$loginUrl = $facebook->getLoginUrl(array(
		'scope'	=> 'email,user_likes ,publish_actions,friends_likes'));
}
?>