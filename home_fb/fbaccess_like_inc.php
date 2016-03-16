<?php
//Application Configurations
$app_id			= "784747011541235";
$app_secret		= "cf622150eabb7f6be5803d0d0a89b04f";
$site_url			= "http://www.pixelhouse.biz";

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

if(isset($user)){
	
	 
		 
		try {
			
			$statusUpdate = $facebook->api('/me/feed', 'post', 
			array(	
				'link'=> $link,
				'message'=> $title, 
				'description'=> $description,
				'picture'=> $src,
				


			));
			
		}catch (FacebookApiException $e) {
			error_log($e);
			echo $e;
		}
	
}


#	print_r($statusUpdate);

if($me){
	// Get logout URL
	$logoutUrl = $facebook->getLogoutUrl();
}else{
	// Get login URL
	$loginUrl = $facebook->getLoginUrl(array(
		//'scope'			=> 'email,user_likes,publish_stream,read_stream, user_birthday ,publish_actions ,friends_likes'));
		'scope'	=> 'email,user_likes ,publish_actions'));
}

if($user){
	
	
}
?>