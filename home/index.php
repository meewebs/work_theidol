<?php
	include_once("../myAdmin/lib/session.php");
	include_once("../myAdmin/lib/config.php");
	$menu  = 1;
	
	if($txt_Send)
	{
		$_SESSION["S_Send"] = $txt_Send;
	}
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
            	<a href="index.php"><img src="../img/template/img-header-logo.png"></a>
            </div> 
        	<div class="tp_menu">
            	<a href="index.php"><div class="nav_pic<?=($menu == 1)?"-active":""?> nav1<?=($menu == 1)?"-active":""?>">หน้าแรก</div></a>
                <a href="../vote/index.php"><div class="nav_pic<?=($menu == 2)?"-active":""?> nav2<?=($menu == 2)?"-active":""?>">โหวตอยู่ก่อนซื้อ THE IDOL</div></a>
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
    
    <div class="home_bloger">
    	<div class="box_content">
        	<div class="box_inner">
            	<!--content-->
            	<div class="no">gu1</div>
            	<div class="title">mhunoiii</div>
                <div class="content">
                	อยากได้แรงบันดาลใจใหม่ๆ พอได้มาใช้ชีิวิตอยู่ที่
                    ยู ดีไลท์ @ บางซ่อน สเตชั่น รู้สึกเติมเต็มชีวิต
                    จะเหมาะแค่ไหน ชมกันเลย...
                </div>
                <div class="bnt">
                	<a href="javascript:void(0);" onClick="js_clip(1);"><img src="../img/template/bnt-clip.png" alt="ชมคลิป"></a>
                </div>
                <!--content-->
            </div>
        </div>
        <div class="box_content2">
        	<div class="box_inner2">
            	<!--content-->
            	<div class="no">gu2</div>
            	<div class="title">aum&nbsp;_&nbsp;napat</div>
                <div class="content">
                	รักการทำอาหารเป็นชีวิตจิตใจ แต่จะเจอห้องที่
                    ถูกใจ ห้องครัวติดระเบียงนั้นหาได้ยาก ยู ดีไลท์
                    @ หัวหมาก สเตชั่น ตรงใจใช่เลย...
                </div>
                <div class="bnt">
                	<a href="javascript:void(0);" onClick="js_clip(2);"><img src="../img/template/bnt-clip.png" alt="ชมคลิป"></a>
                </div>
                <!--content-->
            </div>
        </div>
        <div class="box_content3">
        	<div class="box_inner3">
            	<!--content-->
            	<div class="no">gu3</div>
            	<div class="title">florence room</div>
                <div class="content">
                	เมื่อสาวแฟชั่น ต้องการเปลี่ยนบรรยากาศเดิมๆ
                    มาเปลี่ยนลุคการแต่งหน้าที่ ยู ดีไลท์ @ หัวหมาก
                    สเตชั่น จะสวย งดงามแค่ไหน ชมกันเลย...
                </div>
                <div class="bnt">
                	<a href="javascript:void(0);" onClick="js_clip(3);"><img src="../img/template/bnt-clip.png" alt="ชมคลิป"></a>
                </div>
                <!--content-->
            </div>
        </div>
        <div class="box_content4">
        	<div class="box_inner4">
            	<!--content-->
            	<div class="no">gu4</div>
            	<div class="title">iaumreview</div>
                <div class="content">
                	ทุกวันนี้ใช้เวลาข้างนอกเยอะแล้ว จะหามุมดีๆ
					พักผ่อนได้อย่างเต็มที่ก็ยุ่งยาก พอมาเจอ
					ยู ดีไลท์ รัตนาธิเบศก์ ตอบโจทย์ชีวิตเลย...
                </div>
                <div class="bnt">
                	<a href="javascript:void(0);" onClick="js_clip(4);"><img src="../img/template/bnt-clip.png" alt="ชมคลิป"></a>
                </div>
                <!--content-->
            </div>
        </div>
        <div class="box_content5">
        	<div class="box_inner5">
            	<!--content-->
            	<div class="no">gu5</div>
            	<div class="title">inn sarin</div>
                <div class="content">
                	หนุ่มสถาปัตย์ ที่ฮอตที่สุดในจุฬาฯ จะมาใช้ชีวิต
                    อยู่ที่คอนโด ยู แคมปัส รังสิต-เมืองเอก ผลลัพธ์
                    การอยู่ครั้งนี้จะเป็นอย่างไร ชมกันเลย...
                </div>
                <div class="bnt">
                	<a href="javascript:void(0);" onClick="js_clip(5);"><img src="../img/template/bnt-clip.png" alt="ชมคลิป"></a>
                </div>
                <!--content-->
            </div>
        </div>
    </div>
    
    <div class="home_content">
    	<img class="_left" src="../img/template/img-title.png">
        <a href="../facebook_login.php?page=vote"><img class="_right" src="../img/template/bnt-votenow.png"></a>
        <div class="_clear"></div>
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
