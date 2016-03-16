<?
include("../../lib/session.php");
header("Content-type: text/html; charset=UTF-8");
include("../../lib/config.php");

if($action == "change_lang"){
	
	$_SESSION["_Language"] = $lang;
	echo $_SESSION["_Language"];

}else if($action == "ChangePage"){
	$_SESSION["_PageSize"] = $page;
	echo "OK";
}
?>
