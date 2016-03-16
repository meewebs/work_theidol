<?php

# Database Configuration
define ("_SYSTEM_DB_TYPE_", "mysql");		// support for [ mysql ]
define ("_SYSTEM_DB_HOSTNAME_", "localhost");
define ("_SYSTEM_DB_USERNAME_", "grandu");
define ("_SYSTEM_DB_PASSWORD_", "BraVo@2015");
define ("_SYSTEM_DB_NAME_", "grandu_idol");

# Path System 
define ("_SYSTEM_ROOTPATH_FULL_", "https://".$_SERVER["SERVER_NAME"]."");
define ("_SYSTEM_ROOTPATH_", "/theidol");
define ("_SYSTEM_FOLDER_","");
# Path Upload
define ("_SYSTEM_ROOTPATH_UPLOAD_", "/upload");
define ("_SYSTEM_RELATIVE_PATH_", "../../upload");

# Set Title
define ("_SYSTEM_SITETITLE_", "อยู่ก่อนซื้อ THE  IDOL | Grand U"); 
define ("_SYSTEM_SITETITLESINGLE_", "อยู่ก่อนซื้อ THE  IDOL | Grand"); 
define ("_SYSTEM_DESCRIPTION_", "อยู่ก่อนซื้อ THE  IDOL | Grand U"); 
define ("_SYSTEM_KEYWORD_", "อยู่ก่อนซื้อ THE  IDOL | Grand U"); 


define ("_SYSTEM_DOMAIN_", ".อยู่ก่อนซื้อ THE  IDOL | Grand U");
define ("_SYSTEM_SITEFOOTER_", 'POWERED : Pixelhouse.biz');
define ("_SYSTEM_SITEFOOTER_LINK_", "http://www.Pixelhouse.biz");

define ("_SYS_MENU_","sys_menu");
define ("_SYS_MENU_SUB_","sys_menu_sub");


define ("_MODULE_TABLE_PROVINCE_", "mod_province");

 
define ("_SYSTEM_USER_","SystemAdmin");
define ("_SYSTEM_PASS_","Admin@Work"); 

# System Veriable ####################
$System_Config_LanguageSupportCode 	= array("","th","en");
# Set Language
$session_Language									= ($_Language)?$_Language:"th";
# Loading Initial variable to Session

if($session_Language == "th") {
	
	$System_Config_MonthName 					= array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
	$System_Config_MonthName_Short 		= array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
	$System_Config_WeekdayName 			= array("","อาทิตย์","จันทร์","อังคาร","พุธ","พฤหัส","ศุกร์","เสาร์");
	$System_Config_WeekdayName_Short 	= array("","อา","จ","อ","พ","พฤ","ศ","ส");
	
}else{
	
	$System_Config_MonthName 					= array("","January","February","March","April","May","June","July","August","September","October","November","December");
	$System_Config_MonthName_Short 		= array("","Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
	$System_Config_WeekdayName 			= array("","Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
	$System_Config_WeekdayName_Short 	= array("","Sun","Mon","Tue","Wed","Thu","Fri","Sat");
}

# Include File
include("regis_global_off.php");
include("connect.php");
?>