<?php
include_once("../myAdmin/lib/session.php");
include_once("../myAdmin/lib/config.php");
include_once("../myAdmin/lib/function.php");
include_once("../myAdmin/mod/_facebook_photo/config.php");

#$_SESSION["facebook_id"] = 1;
$menu  = 2;
#if($_SESSION["facebook_id"])
#{
?>
<!doctype html>
<html><!-- InstanceBegin template="/Templates/template.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="UTF-8">
<!-- InstanceBeginEditable name="doctitle" -->
<title>อยู่ก่อนซื้อ THE  IDOL | Grand U</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<link href="../css/styles.css" rel="stylesheet" type="text/css">
<script src="../lib/bootstrap/js/jquery.js"></script>
<script src="../lib/function.js"></script>

<!-- analytics -->
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-6934746-20']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<!-- analytics -->
</head>

<body>

<div id="loadPage"></div>

<div class="popup" id="connect_facebook"> 
	<div class="popup_box">
    	<div class="popup_bnt"><a href="../facebook_login.php"><img src="../img/template/bnt-facebook.png"></a></div>
        <a href="javascript:void(0);" onClick="$('#connect_facebook').hide();"><img class="popup_close" src="../img/template/bnt-close.png"></a>
    </div>
</div>


<div class="popup" id="vote_popup">
	<div id="area_content">
    	
   </div>
</div>

<!-- template menu -->
<div class="tp">
	<div class="tp_nav_bg">
		<div class="tp_width">
        	<div class="logo">
            	<a href="../home/index.php"><img src="../img/template/img-header-logo.png"></a>
            </div> 
        	<div class="tp_menu">
            	<a href="../home/index.php"><div class="nav_pic<?=($menu == 1)?"-active":""?> nav1<?=($menu == 1)?"-active":""?>">หน้าแรก</div></a>
                <a href="index.php"><div class="nav_pic<?=($menu == 2)?"-active":""?> nav2<?=($menu == 2)?"-active":""?>">โหวตอยู่ก่อนซื้อ THE IDOL</div></a>
                <a href="../rule/index.php"><div class="nav_pic<?=($menu == 3)?"-active":""?> nav3<?=($menu == 3)?"-active":""?>">กติกาและรางวัล</div></a>
                <a href="../result/index.php"><div class="nav_pic<?=($menu == 4)?"-active":""?> nav4<?=($menu == 4)?"-active":""?>">ประกาศผล</div></a>
                <div class="_clear"></div>
            </div>
    		
            
    	</div>
    </div>
</div>
<!-- template menu -->

<!-- template body -->
<div class="tp">
	<div class="tp_width">
    <!-- InstanceBeginEditable name="EditRegion3" -->
    <div class="vote_box">
    	<img src="../img/vote/img-header.png">
        <div class="vote_border">
        	<!--bock-->
            <div class="vote_block1">
            	<!--content-->
                <?php
					$id = 1;
                	$sql  = " SELECT "._TABLE_."_Like FROM "._TABLE_." WHERE "._TABLE_."_Status = 'Enable' AND "._TABLE_."_ID = '$id' ";
					#echo $sql;
					$result = mysql_query($sql);
					if($rs = mysql_fetch_assoc($result))
					{
						$_like	= $rs[_TABLE_."_Like"];
					}
				?>
            	<div class="name">MHUNOIII</div>
                <div class="content">
                	อยากได้แรงบันดาลใจใหม่ๆ พอได้มาใช้ชีิวิตอยู่ที่<br>
                    ยู ดีไลท์ @ บางซ่อน สเตชั่น รู้สึกเติมเต็มชีวิต<br>
                    จะเหมาะแค่ไหน ชมกันเลย...
                </div>
                <div class="vote_box_score">
                	<div class="txt_score _left" id="area_like_<?=$id?>"><?=$_like?></div>
                    <div class="bnt_vote _left" onClick="js_like_photo('design',<?=$id?>,'<?=encodeURL("row=".$id."&url=".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]."&action=like_image")?>');">โหวต</div>
                    <div class="_clear"></div>
                </div>
                <div class="bnt_clip" onClick="js_clip(1);">ชมคลิป</div>
                <!--content-->
            </div>
            <!--bock-->
            <!--bock-->
            <div class="vote_block2">
            	<!--content-->
                <?php
					$id = 2;
                	$sql  = " SELECT "._TABLE_."_Like FROM "._TABLE_." WHERE "._TABLE_."_Status = 'Enable' AND "._TABLE_."_ID = '$id' ";
					#echo $sql;
					$result = mysql_query($sql);
					if($rs = mysql_fetch_assoc($result))
					{
						$_like	= $rs[_TABLE_."_Like"];
					}
				?>
            	<div class="name">AUM&nbsp;_&nbsp;NAPAT</div>
                <div class="content">
                	รักการทำอาหารเป็นชีวิตจิตใจ แต่จะเจอห้องที่<br>
                    ถูกใจ ห้องครัวติดระเบียงนั้นหาได้ยาก ยู ดีไลท์<br>
                    @ หัวหมาก สเตชั่น ตรงใจใช่เลย...
                </div>
                <div class="vote_box_score">
                	<div class="txt_score _left" id="area_like_<?=$id?>"><?=$_like?></div>
                    <div class="bnt_vote _left" onClick="js_like_photo('design',<?=$id?>,'<?=encodeURL("row=".$id."&url=".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]."&action=like_image")?>');">โหวต</div>
                    <div class="_clear"></div>
                </div>
                <div class="bnt_clip"  onClick="js_clip(2);">ชมคลิป</div>
                <!--content-->
            </div>
            <!--bock-->
            <!--bock-->
            <div class="vote_block3">
            	<!--content-->
                <?php
					$id = 3;
                	$sql  = " SELECT "._TABLE_."_Like FROM "._TABLE_." WHERE "._TABLE_."_Status = 'Enable' AND "._TABLE_."_ID = '$id' ";
					#echo $sql;
					$result = mysql_query($sql);
					if($rs = mysql_fetch_assoc($result))
					{
						$_like	= $rs[_TABLE_."_Like"];
					}
				?>
            	<div class="name">FLORENCE ROOM</div>
                <div class="content">
                	เมื่อสาวแฟชั่น ต้องการเปลี่ยนบรรยากาศเดิมๆ<br>
                    มาเปลี่ยนลุคการแต่งหน้าที่ ยู ดีไลท์ @ หัวหมาก<br>
                    สเตชั่น จะสวย งดงามแค่ไหน ชมกันเลย...
                </div>
                <div class="vote_box_score">
                	<div class="txt_score _left" id="area_like_<?=$id?>"><?=$_like?></div>
                    <div class="bnt_vote _left" onClick="js_like_photo('design',<?=$id?>,'<?=encodeURL("row=".$id."&url=".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]."&action=like_image")?>');">โหวต</div>
                    <div class="_clear"></div>
                </div>
                <div class="bnt_clip"  onClick="js_clip(3);">ชมคลิป</div>
                <!--content-->
            </div>
            <!--bock-->
            <!--bock-->
            <div class="vote_block4">
            	<!--content-->
                <?php
					$id = 4;
                	$sql  = " SELECT "._TABLE_."_Like FROM "._TABLE_." WHERE "._TABLE_."_Status = 'Enable' AND "._TABLE_."_ID = '$id' ";
					#echo $sql;
					$result = mysql_query($sql);
					if($rs = mysql_fetch_assoc($result))
					{
						$_like	= $rs[_TABLE_."_Like"];
					}
				?>
            	<div class="name">IAUMREVIEW</div>
                <div class="content">
                	ทุกวันนี้ใช้เวลาข้างนอกเยอะแล้ว จะหามุมดีๆ<br>
					พักผ่อนได้อย่างเต็มที่ก็ยุ่งยาก พอมาเจอ<br>
					ยู ดีไลท์ รัตนาธิเบศก์ ตอบโจทย์ชีวิตเลย...
                </div>
                <div class="vote_box_score">
                	<div class="txt_score _left" id="area_like_<?=$id?>"><?=$_like?></div>
                    <div class="bnt_vote _left" onClick="js_like_photo('design',<?=$id?>,'<?=encodeURL("row=".$id."&url=".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]."&action=like_image")?>');">โหวต</div>
                    <div class="_clear"></div>
                </div>
                <div class="bnt_clip" onClick="js_clip(4);">ชมคลิป</div>
                <!--content-->
            </div>
            <!--bock-->
            <!--bock-->
            <div class="vote_block5">
            	<!--content-->
                <?php
					$id = 5;
                	$sql  = " SELECT "._TABLE_."_Like FROM "._TABLE_." WHERE "._TABLE_."_Status = 'Enable' AND "._TABLE_."_ID = '$id' ";
					#echo $sql;
					$result = mysql_query($sql);
					if($rs = mysql_fetch_assoc($result))
					{
						$_like	= $rs[_TABLE_."_Like"];
					}
				?>
            	<div class="name">INN SARIN</div>
                <div class="content">
                	หนุ่มสถาปัตย์ ที่ฮอตที่สุดในจุฬาฯ จะมาใช้ชีวิต<br>
                    อยู่ที่คอนโด ยู แคมปัส รังสิต-เมืองเอก ผลลัพธ์<br>
                    การอยู่ครั้งนี้จะเป็นอย่างไร ชมกันเลย...
                </div>
                <div class="vote_box_score">
                	<div class="txt_score _left" id="area_like_<?=$id?>"><?=$_like?></div>
                    <div class="bnt_vote _left" onClick="js_like_photo('design',<?=$id?>,'<?=encodeURL("row=".$id."&url=".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]."&action=like_image")?>');">โหวต</div>
                    <div class="_clear"></div>
                </div>
                <div class="bnt_clip" onClick="js_clip(5);">ชมคลิป</div>
                <!--content-->
            </div>
            <!--bock-->
        </div>
    </div>
    <!-- InstanceEndEditable -->
    </div>
</div>
<!-- template body -->

<!-- template footer -->
<div class="tp">
	<div class="tp_footer_bg">
		<div class="tp_width">
        	<div class="copyright">
            	Copyright © 2016 Grand Unity Development Co. Ltd., All Rights Reserved.
                
                <!--BEGIN WEB STAT CODE-->
				<script type="text/javascript" src="https://lvs.truehits.in.th/datasecure/t0030211.js"></script>
                <!-- END WEBSTAT CODE --> 
            </div>
            <div class="footer_logo"><a href="http://www.grandu.co.th"><img src="../img/template/img-grandu-logo.png" alt="Grand U"></a></div>
            <div class="_clear"></div>
        </div>
    </div>
</div>
<!-- template footer -->
<script src="../lib/script.js"></script>
</body>
<!-- InstanceEnd --></html>
<?php /*?><?php
}
else
{
?>
	<script> window.location = "../facebook_login.php"; </script>
<?php		
}
?><?php */?>