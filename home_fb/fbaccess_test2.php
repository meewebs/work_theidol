<?php
session_start();
 
// Facebook PHP SDK v4.0.8
//require_once( 'Facebook/FacebookSession.php' );
// path of these files have changes
//require_once( 'Facebook/HttpClients/FacebookHttpable.php' );
//require_once( 'Facebook/HttpClients/FacebookCurl.php' );
//require_once( 'Facebook/HttpClients/FacebookCurlHttpClient.php' );
 
/*require_once( 'Facebook/Entities/AccessToken.php' );
require_once( 'Facebook/Entities/SignedRequest.php' );*/
 
// other files remain the same
#require_once( 'Facebook/FacebookSession.php' );
#require_once( 'Facebook/FacebookRedirectLoginHelper.php' );
require_once( 'Facebook/FacebookRequest.php' );
#require_once( 'Facebook/FacebookResponse.php' );
#require_once( 'Facebook/FacebookSDKException.php' );
require_once( 'Facebook/GraphUser.php' );
require_once( 'Facebook/FacebookRequestException.php' );
#require_once( 'Facebook/FacebookOtherException.php' );
#require_once( 'Facebook/FacebookAuthorizationException.php' );
#require_once( 'Facebook/GraphObject.php' );

#require_once( 'Facebook/GraphSessionInfo.php' );
#require_once( 'Facebook/GraphLocation.php' );
 

$id 			= '1477458815826711';
$secret 	= 'b0ff291d8ef95fe34c2a2d43b04d8554';
// init app with app id (APPID) and secret (SECRET)
FacebookSession::setDefaultApplication($id,$secret);

// login helper with redirect_uri
$helper = new FacebookRedirectLoginHelper( 'http://localhost/fb/test.php' );

try{
	//get Session after Login Direct
	$session = $helper->getSessionFromRedirect();
}catch(Exception $e){
	//Error
	echo $e->getMessage();
}

//if set session token
if(isset($_SESSION['token'])){
	//set session by token for continue working.
	$session = new FacebookSession($_SESSION['token']);
	try{
		//check Validate session
		$session->Validate();
	}catch(FacebookAuthorizationException $e){
		$session = "";
	}
}

//if session set 
if(isset($session)){
	//store token
	$_SESSION['token'] = $session->getToken();
	echo "Login Successful<br />";
	
	//set Request and execute 
	$request = new FacebookRequest($session,'GET','/me');
	$response = $request->execute();
	
	//get Object for using
	$user = $response->getGraphObject(GraphUser::className());
	$loc = $response->getGraphObject(GraphLocation::className());
	
	// User example
	echo $user->getName()."<br />";

	// Location example
	echo $loc->getCountry()."<br />";

	// SessionInfo example
	$info = $session->getSessionInfo();
	//echo $info->getExpiresAt();
}else{
	//not session set Show Login URL
	echo "<a href=".$helper->getLoginUrl().">Login</a>";
}

?>