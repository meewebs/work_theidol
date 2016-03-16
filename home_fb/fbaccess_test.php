<?php
//Application Configurations
$app_id			= "1477458815826711";
$app_secret		= "b0ff291d8ef95fe34c2a2d43b04d8554";
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
		$user = $facebook->getUser();
		
	}catch(FacebookApiException $e){
		error_log($e);
		$user = NULL;
	}
//==================== Single query method ends =================================
}

#print_r($me);

if($me){
	
	$user_id	=	$me['id'];
	
	$query 	= "SELECT uid, page_id FROM page_fan WHERE uid IN (SELECT uid2 FROM friend WHERE uid1 = $user_id) and page_id IN (205789412767791)";

try { 
	$result = $facebook->api(array(
		'method' => 'fql.query',
		'query' => $query,
	));
} catch (FacebookApiException $e) {
	error_log($e);
	$result = 'none';
}
	echo "<pre>";
	print_r($result);
	
	/*$_like_id 	= $me["id"];
	$friends = $facebook->api('/me/friends');
	
	$response = $facebook->api("/701037001/likes/263204197120223");
	echo "<pre>";
	print_r($response);
	print_r($friends);
	exit();
	echo '<ul>';
	foreach ($friends["data"] as $value) {
		
		$response = $facebook->api("/".$value["id"]."/likes/263204197120223");
		if($response["data"]){
			$like = "Like";	
		}else{
			$like = "";	
		}
		
		echo '<li>';
		echo '<div class="pic">';
		echo '<img src="https://graph.facebook.com/' . $value["id"] . '/picture"/>';
		echo '</div>';
		echo '<div class="picName">'.$value["name"].'</div>'; 
		echo '<div class="picName">status : '.$like.'</div>'; 
		echo '</li>';
		
		//exit();
		
	}
	echo '</ul>';*/

}else{
		
	$loginUrl = $facebook->getLoginUrl(array('scope'	=> 'email,user_likes,publish_stream,read_stream, user_birthday ,publish_actions ,friends_likes'));
}
?>