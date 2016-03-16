<?

if($_SESSION["_Language"] == "en"){
	$ch 	= "En";	
}else{
	$ch	= "";	
}

$sql_nav 		= 	" SELECT * FROM "._SYS_MENU_SUB_.
						" WHERE "._SYS_MENU_SUB_."_ID = '$menu_id' ";
$result_nav 	= mysql_query($sql_nav);
if($rs_nav 	= mysql_fetch_assoc($result_nav)){
	
	$menu_Name = $rs_nav[_SYS_MENU_SUB_."_Title".$ch];
}
?>