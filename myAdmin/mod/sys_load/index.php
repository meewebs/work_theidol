<?
include_once("../../lib/session.php");
include_once("../../lib/config.php");
include_once("lang/".$_Language.".php");
?>
<!doctype html>
<html lang="en" ng-app>
<head>
<meta charset="UTF-8">
<title><?=_SYSTEM_SITETITLE_?></title>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="../../../img/template/icon.png" />
<meta name="description" content="<?=_SYSTEM_DESCRIPTION_?>">
<meta name="author" content="<?=_SYSTEM_EMAIL_?>">

<link rel="shortcut icon" href="../../assets/ico/favicon.png">
<link href="../../lib/bootstrap-v3/css/bootstrap.css" rel="stylesheet">
<link href="../../lib/bootstrap/css/bootstrap.css" rel="stylesheet">

<link href="../../lib/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
<link href="../../css/css.css" rel="stylesheet" type="text/css" />

<script src="../../lib/jquery.js"></script>
<script src="../../lib/bootstrap/js/bootstrap.min.js"></script>
<script src="../../lib/angular.min.js"></script>

<link href="../../lib/colorbox/colorbox.css" rel="stylesheet">
<script src="../../lib/colorbox/jquery.colorbox.js"></script>

<script src="../../lib/angular.min.js"></script>
<script src="../../lib/js3-handlers.js"></script>
<script src="../../lib/function.js"></script>
<script src="function.js"></script>

<script type="text/javascript" src="../../lib/datepicker/javascript/zebra_datepicker.js"></script>
<link rel="stylesheet" href="../../lib/datepicker/css/bootstrap.css" type="text/css">
        
<script>
	var this_page 		= "";
	var count_submit = true;
</script>

</head>

<body>
<?
if($_SESSION["Like_ID"]){
?>
    <div id="loadPage"><img src="../../img/load/loading3.gif" alt="Loading" align="absmiddle"> <?=$Mod_Text["Loading"] ?> </div>
    
	<!-- begin nav top -->
	<div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="../sys_load/index.php"><?=_SYSTEM_SITETITLE_?></a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              
              <?
              if($_SESSION["Like_ID"] == -1){
			  ?>
              <!-- begin for system -->
              <li class="dropdown">
              	<a href="#" class="dropdown-toggle" data-toggle="dropdown">System <b class="caret"></b></a>
              	<ul class="dropdown-menu">
                	<li><a href='javascript:js_load_page($("#area_panel") , "../sys_user/index_form.php" , "action=View");'>Create user</a></li>
              		<li><a href='javascript:js_load_page($("#area_panel") , "../sys_menu/index_form.php" , "action=View");'>Create menu</a></li>
                    <li><a href='javascript:js_load_page($("#area_panel") , "../sys_mod/index_form.php" , "action=View");'>Create mod</a></li>
                </ul>
              </li>
              <!-- end for system -->
              <?
			  }#end if
			  ?>
              
            </ul>
            
              <ul class="nav navbar-nav pull-right">
              	<li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Language <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li><a href="javascript:js_language('th');">ไทย</a></li>
                    <li><a href="javascript:js_language('en');">English</a></li>
                  </ul>
                </li>
                <li class="active"><a href="../logout.php"><i class="icon-off"></i> <?=$Mod_Text["Log-out"]?></a></li>
              </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
    <!-- end nav top -->
    
    <div class="container" style="padding-top:60px;">
    
    	<div class="row">
        
          <div class="col-lg-2" id="area_menu">
          	<?
            	include_once("../sys_menu/index_menu.php");
			?>
          </div>
          
          <div class="col-lg-10"><div id="area_panel"></div></div>
        </div>
	
      
      
      

    </div><!-- /.container -->
    
    
    <script type="text/javascript">
		js_load_page($("#area_panel") , "../sys_preview/index_form.php" , "action=View");
	</script>
<?
}else{
?>	
<script>
	js_return_login();
</script>
<?	
}
?>

<div class="footer">
	<a href="http://www.pixelhouse.biz" target="_blank">Copyright @ 2015 pixelhouse Co., Ltd & bravohub Co., Ltd. All Rights Reserved</a>
</div>
</body>
</html>
