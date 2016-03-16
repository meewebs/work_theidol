<?php
//Application Configurations
$app_id			= "631364960216648";
$app_secret		= "2bc23cbf37ab25eaa0f6e8ee38d3e48a";
$site_url			= "http://www.bravocampaign.com/";

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
// We may or may not have this data based 
// on whether the user is logged in.
// If we have a $user id here, it means we know 
// the user is logged into
// Facebook, but we don't know if the access token is valid. An access
// token is invalid if the user logged out of Facebook.

if($user){
//==================== Single query method ======================================
	try{
		// Proceed knowing you have a logged in user who's authenticated.
		$me = $facebook->api('/me');
		$like = $facebook->api("/me/likes/205789412767791");
	#	$likes = $facebook->api("/me/likes/205789412767791");
	}catch(FacebookApiException $e){
		error_log($e);
		$user = NULL;
	}
//==================== Single query method ends =================================
}

if($me){
	// Get logout URL
	//$logoutUrl = $facebook->getLogoutUrl();
}else{
	// Get login URL
	/*$loginUrl = $facebook->getLoginUrl(array(
		'scope'			=> 'email,user_likes,publish_stream,read_stream, publish_stream, user_birthday',
		'redirect_uri'	=> $site_url,
		));*/
		
	$loginUrl = $facebook->getLoginUrl(array(
		'scope'			=> 'email,user_likes,publish_stream,read_stream, publish_stream, user_birthday'));
}

if($user){
	
	
}

/*$like = $facebook->api('/me/likes');


	
		$count_like	= count($like["data"]);
		#echo $count_like;
		$status = 'Unlike';
		for($i=0;$i<$count_like;$i++){
			
			
			if($like["data"][$i]["id"] == "122185667822178"){
				#go to question
				$status = 'Like';
				break;
			}
			
		}*/
?>