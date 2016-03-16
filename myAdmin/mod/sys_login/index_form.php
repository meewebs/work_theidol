<?
include("../../lib/session.php");
header("Content-type: text/html; charset=UTF-8");
include("../../lib/config.php");
include("../../lib/function.php");
include("../sys_user/config.php");
if($action == "User_Login"){
	
	$sql = 	" SELECT * ".
				" FROM "._TABLE_.
				" WHERE "._TABLE_."_Username = '".php_encode_html($txt_Username)."' ".
				" AND "._TABLE_."_Password = '".php_encode_html(md5($txt_Password))."' ".
				" AND "._TABLE_."_Status = 'Enable' ";
	
	#echo $sql;			
	$result 	= mysql_query($sql);
	if($rs 	= mysql_fetch_assoc($result)){
		
		$_SESSION["_Language"]				= "th";
		$_SESSION["Like_ID"] 					= $rs[_TABLE_."_ID"];
		$_SESSION["Like_Username"] 		= $rs[_TABLE_."_Username"];
		$_SESSION["Like_Email"] 				= $rs[_TABLE_."_Email"];
		$_SESSION["Like_Level"] 				= $rs[_TABLE_."_LevelID"];
		$_SESSION["Like_SupplierID"] 		= $rs[_TABLE_."_SupplierID"];
		
		echo "OK";
	
	}else if($txt_Username === _SYSTEM_USER_ && $txt_Password === _SYSTEM_PASS_){
		
		$_SESSION["_Language"]				= "th";
		$_SESSION["Like_ID"] 					= -1;
		$_SESSION["Like_Username"] 		= "System Admin";
		$_SESSION["Like_Email"] 				= "krinkhai@gmail.com";
		$_SESSION["Like_Level"] 				= "All_Level";
		
		echo "OK";
	}else{
		echo "False";
	}
	
}else if($action == "Forget_password"){
	
	include_once("../../lib/phpmailer/class.phpmailer.php");
	
	$sql = 	" SELECT * FROM "._TABLE_.
				" WHERE "._TABLE_."_Email = '".$txt_Email."' ".
				" AND "._TABLE_."_Status = 'Enable' ";
				
	$result 	= mysql_query($sql);
	if($rs 	= mysql_fetch_assoc($result)){
		#send email to customer. 
		#mail variable
		$_email 			=	$rs[_TABLE_."_Email"];
		$_name 			=	$rs[_TABLE_."_FirstName"]." ".$rs[_TABLE_."_LastName"];
		$_password 	=	$rs[_TABLE_."_Password"];
		#$_name			=	$txt_Url;
		
		$address	 		= 	$_email;
		$subject			= 	"ลืมรหัสผ่านเข้าใช้งานระบบของคุณ ".$_name;
		
		#echo $subject;
		#exit();
		$data = php_readfile('temp_forgetpassword.html');
				
		$data = str_replace('{EMAIL}',$_email,$data);
		$data = str_replace('{PASSWORD}',$_password,$data);

		$content = $data;
		#echo $coutent;
		$respone = php_sendmail($address,$subject,$content,$name,$bcc);
		/*area send email*/		
		echo $respone;	
		#send email to customer
		
	}else{
		echo "Fail";	
	}
	
}
?>
