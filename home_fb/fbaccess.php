<?php
//Application Configurations
$app_id			= "536708069756700";
$app_secret		= "be0c607c42210d8d1ab1aa733dd049ef";
$site_url			= "http://www.grandu.co.th/theidol/";

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
		#$like 	= $facebook->api("/me/likes/126628670690902");
		/*echo "<pre>";
		print_r($facebook->api("/me/likes"));
		exit();*/
	}catch(FacebookApiException $e){
		error_log($e);
		$user = NULL;
	}
	
	
	/* if($action == "add_matt"){
			try {
			
			$statusUpdate = $facebook->api('/me/feed', 'post', 
			array(	
				'link'=> 'http://dutchmillselected.com/super-games/index.php',
														'message'=> 'Dutchmill Selected ท้าประลองความไวของสายตา
คลิกเลย http://bit.ly/1sm7xUZ', 
														'description'=>  'คุณ '.$_SESSION["facebook_Fullname"].'  ได้ร่วมสนุกกับกิจกรรม Dutchmill Selected Super Games แล้วค่ะ',
													'picture'=> 'http://dutchmillselected.com/super-games/img/share.jpg',
				


			));
			
		}catch (FacebookApiException $e) {
			error_log($e);
			echo $e;
		}	
	}*/
	
//==================== Single query method ends =================================
}

if($me){
	
	$_like_id 	= $me["id"];

}else{
		
	$loginUrl = $facebook->getLoginUrl(array(
		//'scope'	=> 'email,user_likes,publish_stream,read_stream, user_birthday ,publish_actions ,friends_likes'));
		'scope'	=> 'email,public_profile'));
}
?>