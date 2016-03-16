<?php
include_once("../lib/session.php");
include_once("../lib/config.php");
?>
<!doctype html>
<html lang="en" ng-app>
<head>
<meta charset="UTF-8">
<title><?=_SYSTEM_SITETITLE_?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="<?=_SYSTEM_DESCRIPTION_?>">
<meta name="author" content="">

<link rel="shortcut icon" href="../../img/template/icon.png">
<link href="../lib/bootstrap-v3/css/bootstrap.css" rel="stylesheet">
<link href="../lib/bootstrap/css/bootstrap.css" rel="stylesheet">
<link href="../lib/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
<link href="../css/css.css" rel="stylesheet" type="text/css" />

<script src="../lib/bootstrap/js/jquery.js"></script>
<script src="../lib/bootstrap/js/bootstrap.js"></script>
<script src="../lib/angular.min.js"></script>
<script src="sys_login/function.js"></script>

<style>
body{
	margin:0; padding:0;
	background:#e5e5e5;
	/*background:url(../img/wallpaper.jpg) no-repeat center top;*/
}
.login_box{
	margin:10px;
	width:100%; max-width:400px; margin:auto; margin-top:8%;
	background-color:#FFF;
	border:1px #EBEBEB solid;
	
	-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=90)";
	
	/* This works in IE 8 & 9 too */
	/* ... but also 5, 6, 7 */
	filter: alpha(opacity=90);
	
	/* Older than Firefox 0.9 */
	-moz-opacity:0.9;
	
	/* Safari 1.x (pre WebKit!) */
	-khtml-opacity: 0.9;
    
	/* Modern!
	/* Firefox 0.9+, Safari 2?, Chrome any?
	/* Opera 9+, IE 9+ */
	opacity: 0.9;
}
.login_Header{
	margin:3px;
	height:40px;
	background-color:#EBEBEB;
	border-bottom:1px #C1C1C1 solid;
}
.login_Header h3{
	margin:0; padding:0;
	font-size:20px; font-weight:normal;
	text-align:center;
	color:#333;
}
form{
	color:#666;
}
</style>
</head>

<body>
<?php
if($_COOKIE["G_Username"] && $_COOKIE["G_Password"])
{
?>
<script>
	js_auto_login('<?=$_COOKIE["G_Username"]?>','<?=$_COOKIE["G_Password"]?>');
</script>
<?php
}else{
?>
<div class="panel-default login_box">
  <div class="panel-body" style="margin-bottom:30px;">
	<div class="login_Header">
    	<h3>Sign In to PB Staff Account</h3>
    </div>
	<div class="container" id="container-form">
      <form id="myForm" name="myForm" method="post" ng-submit="submit()" ng-controller="js_login" class="form-signin">
        <label>ชื่อผู้ใช้งาน</label>
        <input type="text" id="txt_Username" name="txt_Username" class="input-block-level" placeholder="Username" autofocus required>
        <label>รหัสผ่าน</label>
        <input type="password" id="txt_Password" name="txt_Password" data-loading-text="Loading..." class="input-block-level" placeholder="Password" required>
        <div class="p_left input_right"><input name="txt_Remember" id="txt_Remember" type="checkbox" value="Yes" checked></div>
        <div class="p_left" style="margin-top:7px; margin-left:5px;"><label for="txt_Remember">จำข้อมูลการล๊อคอิน</label></div>
        <div class="p_clear"></div>
        <button id="bnt-save" class="btn btn-block" type="submit">Sign In</button>
      </form>

    </div> 
    <!-- /container -->
   
   </div>
</div> 

<div class="footer">
	<a href="http://www.pixelhouse.biz" target="_blank">Copyright @ 2015 pixelhouse Co., Ltd & bravohub Co., Ltd. All Rights Reserved</a>
</div>
<?php
}
?>
</body>
</html>
