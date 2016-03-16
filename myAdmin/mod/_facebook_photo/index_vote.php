<?php
include_once("../../lib/session.php");
include_once("../../lib/config.php");
include_once("../../lib/function.php");
include_once("./config.php");
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>มีใครโหวตบ้าง</title>
<link href="../../lib/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="../../css/css.css" rel="stylesheet" type="text/css" />

<style>
body{
	background:#FFF;
}
</style>
</head>

<body>
<?php
$sql  = 	" SELECT * ".
            " FROM "._TABLE_.
			" WHERE "._TABLE_."_ID = '$id' ";
$result = mysql_query($sql);
$rs		= mysql_fetch_assoc($result);

$src 		= _UPLOAD_.$rs[_TABLE_."_Image"];
(file_exists($src) && strlen($rs[_TABLE_."_Image"])>4) ?  $src : $src="../../img/image/bnt-browse.png";
?>
<table width="100%" border="0" cellspacing="0" cellpadding="2" class="table table-bordered">
  <tr>
    <td width="14%"><img src="<?=$src?>" width="200px" class="img-rounded" alt="<?=$rs[_TABLE_."_ID"]?>"></td>
    <td width="86%"><?=php_decode_html($rs[_TABLE_."_Subject"])?></td>
  </tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="2" class="table table-bordered table-striped">
  <tr class="tb_header info">
    <td width="6%" align="center" valign="middle">No.</td>
    <td width="23%" align="left" valign="middle">Facebook</td>
    <td width="35%" align="left" valign="middle">Name</td>
    <td width="22%" align="left" valign="middle">Province</td>
    <td width="14%" align="left" valign="middle">Time</td>
  </tr>
  <?php
  	$i = 1;
	
  	$sql = 	" SELECT * ".
			 	" FROM "._TABLE_LIKE_.
				" LEFT JOIN "._TABLE_REGISTER_." ON "._TABLE_REGISTER_."_FacebookID = "._TABLE_LIKE_."_FacebookID ".
				" WHERE "._TABLE_LIKE_."_GroupID = '$id' ".
				" ORDER BY "._TABLE_LIKE_."_CreateDate ASC ";
	$result = mysql_query($sql);
	while($rs	= mysql_fetch_assoc($result))
	{
  ?>
  <tr>
    <td align="left" valign="middle"><?=$i?></td>
    <td align="left" valign="middle"><a href="https://www.facebook.com/<?=$rs[_TABLE_LIKE_."_FacebookID"]?>" target="_blank"><?=$rs[_TABLE_LIKE_."_FacebookID"]?></a></td>
    <td align="left" valign="middle"><?=$rs[_TABLE_REGISTER_."_FirstName"]." ".$rs[_TABLE_REGISTER_."_LastName"]?></td>
    <td align="left" valign="middle"><?=$rs[_TABLE_REGISTER_."_Province"]?></td>
    <td align="left" valign="middle"><?=php_FormatDate("1 Jan XX",$rs[_TABLE_LIKE_."_CreateDate"],true)?></td>
  </tr>
  <?php
  		$i++;
	}//end while
  ?>
</table>
</body>
</html>