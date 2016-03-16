<?php
include_once("../../lib/session.php");
$_date = date("d-m-Y G:i:s");
header("Content-type: text/html; charset=UTF-8");
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="report_pbHat('.$_date.').xls"');#ชื่อไฟล์

include_once("../../lib/config.php");
include_once("../../lib/function.php");
include_once("./config.php");
include_once("lang/".$session_Language.".php");


$sql  = 	" SELECT "._TABLE_."_ID , "._TABLE_."_No , "._TABLE_."_Image , "._TABLE_."_Subject , "._TABLE_."_Like , "._TABLE_."_Status , ".
			" ( SELECT COUNT("._TABLE_LIKE_."_ID) FROM "._TABLE_LIKE_." WHERE "._TABLE_LIKE_."_GroupID = "._TABLE_."_ID ) AS "._TABLE_."_CLike ".
			" FROM "._TABLE_.
			" WHERE 1=1 ";

if($txt_Search){
 
$sql .= " AND ( "._TABLE_."_Title like'%$txt_Search%' ";
$sql .= " OR "._TABLE_."_Subject like '%$txt_Search%' ";

$sql .= " OR "._TABLE_REGISTER_."_FullName like '%$txt_Search%' ";
$sql .= " OR "._TABLE_REGISTER_."_Email like '%$txt_Search%' ";
$sql .= " ) ";

}


if($txt_BeginDate && $txt_EndDate){
	$sql .= " AND ";
	$sql .= " ( "._TABLE_."_CreateDate BETWEEN '".$txt_BeginDate." 00:00:00' AND '".$txt_EndDate." 00:00:00' )"; 
}

if($reorder){
 
 $sql .= 	" ORDER BY  "._TABLE_.$reorder."  ".$order;
 
}else{
 
$sql .= 	" ORDER BY "._TABLE_."_NO ";

}

#echo $sql;
$result = mysql_query($sql);
?>
<html xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:x="urn:schemas-microsoft-com:office:excel"
xmlns="http://www.w3.org/TR/REC-html40">


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Export Excel</title>
</head>

<body>
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#1A429A">
  <tr style="color:#FFFFFF; background-color:#1A429A">
    	<td width="5%" align="center">No</td>
    	<td width="12%" align="center">รุปภาพ</td>
    	<td width="75%" align="center">รายละเอียด</td>
    	<td width="8%" align="center">คะแนนโหวต</td>
  </tr>
  <?
  $no = 1;
  while($rs = mysql_fetch_assoc($result)){
	  
		#$id 			= $rs[_TABLE_."_ID"];
		#$row_id	=	substr('0000'.$row_index,-4);
		$src 			= _SYSTEM_ROOTPATH_FULL_._SYSTEM_ROOTPATH_."/myAdmin/upload/"._TABLE_."/".$rs[_TABLE_."_Image"];
		#echo $src;
		
  ?>
  <tr bgcolor="<?=(($no%2) == 0)?"#CCCCCC":""?>" style="color:<?=(($no%2) == 0)?"#FFFFFF":""?>">
    	<td align="center" valign="top"><?=$rs[_TABLE_."_No"]?></td>
    	<td align="center" valign="top"><img src="<?=$src?>" width="120" /></td>
    	<td align="left" valign="top"><?=$rs[_TABLE_."_Subject"]?>&nbsp;</td>
    	<td align="center" valign="top"><?=$rs[_TABLE_."_CLike"]?>&nbsp;</td>
     	
  </tr>
  <?
  $no++;
  }
  ?>
</table>
</body>
</html>
