<?php 
include_once("./myAdmin/lib/session.php");
header("Content-type: text/html; charset=UTF-8");
include_once("./myAdmin/lib/config.php");
#include_once("./myAdmin/lib/function.php");
include_once("home_fb/fbaccess.php");


$url = "https://www.grandu.co.th/theidol/";
if($id)
{
	$return_url 	= $url."vote/index.php?id=".$id." ";
}
else if($page == "vote")
{
	$return_url 	= $url."vote/";
}
else
{
	$return_url 	= $url."home/";
}
#echo $return_url;
#exit();
if($me)
{
	 #variable
	 $_SESSION["facebook_id"] 				= $me["id"];
	 $_SESSION["facebook_user"] 			= $me["username"];
	 $_SESSION["facebook_email"] 			= $me["email"];
	 $_SESSION["facebook_Firstname"] 	= $me["first_name"];
	 $_SESSION["facebook_Lastname"] 	= $me["last_name"];
	 $_SESSION["facebook_Image"] 			= "https://graph.facebook.com/".$me["id"]."/picture";
	 echo "<script>window.location='$return_url';</script>";
}
 
?>

<script type="text/javascript">
	window.location = "<?php echo $loginUrl; ?>";
</script>