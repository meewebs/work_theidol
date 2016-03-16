<?php
include_once("../../lib/session.php");
$_date = date("d-m-Y G:i:s");
header("Content-type: text/html; charset=UTF-8");
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="report_pbHat('.$_date.').xls"');#ชื่อไฟล์
include_once("../../lib/config.php");
include_once("../../lib/function.php");
include_once("./config.php");
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
    	<td width="3%" align="center">เลขที่</td>
    	<td width="12%" align="center">เฟสบุ๊ก ไอดี</td>
    	<td width="24%" align="center">ชื่อ - นามสกุล</td>
    	<td width="16%" align="center">อีเมล์</td>
    	<td width="12%" align="center">มือถือ</td>
    	<td width="15%" align="center">ที่อยู่</td>
    	<td width="6%" align="center">โหวด 1</td>
    	<td width="6%" align="center">โหวด 2</td>
    	<td width="6%" align="center">โหวด 3</td>
  </tr>
  <?
  $no = 1;
  $sql  = 	" SELECT * ".
				" FROM "._TABLE_REGISTER_.
				" WHERE 1=1 ";
  $sql .= 	" ORDER BY "._TABLE_REGISTER_."_ID ASC ";
  #echo $sql;
  $result = mysql_query($sql);
  while($rs = mysql_fetch_assoc($result))
  {	
  		$_fID 			= $rs[_TABLE_REGISTER_."_FacebookID"];
		
  		$sql_l			= 	" SELECT "._TABLE_."_No  FROM "._TABLE_LIKE_.
								" LEFT JOIN "._TABLE_." ON "._TABLE_."_ID = "._TABLE_LIKE_."_GroupID ".
								" WHERE "._TABLE_LIKE_."_FacebookID = '$_fID' ";
		$result_l		= mysql_query($sql_l);
		$arr_Vote		= "";
		while($rs_l 	= mysql_fetch_assoc($result_l))
		{
			$arr_Vote[]	= $rs_l[_TABLE_."_No"];
		}
  ?>
  <tr bgcolor="<?=(($no%2) == 0)?"#CCCCCC":""?>" style="color:<?=(($no%2) == 0)?"#FFFFFF":""?>">
    	<td align="center" valign="top"><?=$rs[_TABLE_REGISTER_."_ID"]?></td>
    	<td align="center" valign="top"><a href="https://www.facebook.com/<?=$rs[_TABLE_REGISTER_."_FacebookID"]?>" target="_blank"><?=$rs[_TABLE_REGISTER_."_FacebookID"]?></a></td>
    	<td align="left" valign="top"><?=$rs[_TABLE_REGISTER_."_FirstName"]." ".$rs[_TABLE_REGISTER_."_LastName"]?>&nbsp;</td>
    	<td align="center" valign="top"><?=$rs[_TABLE_REGISTER_."_Email"]?>&nbsp;</td>
    	<td align="center" valign="top"><?=$rs[_TABLE_REGISTER_."_Phone"]?>&nbsp;</td>
    	<td align="left" valign="top">
		บ้านเลขที่ <?=($rs[_TABLE_REGISTER_."_No"])?$rs[_TABLE_REGISTER_."_No"]:"-"?> หมู่ที่ <?=($rs[_TABLE_REGISTER_."_Moo"])?$rs[_TABLE_REGISTER_."_Moo"]:"-"?> ซอย <?=($rs[_TABLE_REGISTER_."_Soi"])?$rs[_TABLE_REGISTER_."_Soi"]:"-"?> ถนน <?=($rs[_TABLE_REGISTER_."_Road"])?$rs[_TABLE_REGISTER_."_Road"]:"-"?> 
        <br>
        แขวง/ตำบล <?=($rs[_TABLE_REGISTER_."_Tumbon"])?$rs[_TABLE_REGISTER_."_Tumbon"]:"-"?> เขต/อำเภอ <?=($rs[_TABLE_REGISTER_."_Ampure"])?$rs[_TABLE_REGISTER_."_Ampure"]:"-"?> 
        <br>
        จังหวัด <?=($rs[_TABLE_REGISTER_."_Province"])?$rs[_TABLE_REGISTER_."_Province"]:"-"?> <?=$rs[_TABLE_REGISTER_."_Postcode"]?>
        &nbsp;
        </td>
    	<td align="center" valign="top"><?=$arr_Vote[0]?>&nbsp;</td>
    	<td align="center" valign="top"><?=$arr_Vote[1]?>&nbsp;</td>
    	<td align="center" valign="top"><?=$arr_Vote[2]?>&nbsp;</td>
  </tr>
  <?
  $no++;
  }
  ?>
</table>
</body>
</html>
