<?php
include_once("../myAdmin/lib/session.php");
include_once("../myAdmin/lib/config.php");
include_once("../myAdmin/lib/function.php");
include_once("../myAdmin/mod/_facebook_photo/config.php");

$id = $_GET["id"];


$sql  = " SELECT "._TABLE_."_Like FROM "._TABLE_." WHERE "._TABLE_."_Status = 'Enable' AND "._TABLE_."_ID = '$id' ";
#echo $sql;
$result = mysql_query($sql);
if($rs = mysql_fetch_assoc($result))
{
	#$id 	= $rs[_TABLE_."_ID"];
	#$no 	= $rs[_TABLE_."_No"];
	#$title	= $rs[_TABLE_."_Subject"];
	$_like	= $rs[_TABLE_."_Like"];
}
?>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5&appId=293770350766849";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<?php
$title				= "อยู่ก่อนซื้อ THE  IDOL By Grand U";
$_urlShare 	= _SYSTEM_ROOTPATH_FULL_._SYSTEM_ROOTPATH_."/share.php";
if($id == 1)
{
?>
<!-- block content -->
<div class="popup_vote_box">
    <div class="vdo_block">
        <div class="img">
        	<iframe width="553" height="310" src="https://www.youtube.com/embed/-i7YuVFPh-I" frameborder="0" allowfullscreen></iframe>
        </div>
        <div class="no">gu<span>1</span></div>
        <div class="name">MHUNOIII</div>
        <div class="content">
            อยากได้แรงบันดาลใจใหม่ๆ พอได้มาใช้ชีิวิตอยู่ที่
            ยู ดีไลท์ @ บางซ่อน สเตชั่น รู้สึกเติมเต็มชีวิต
            จะเหมาะแค่ไหน ชมกันเลย...
        </div>
        <div class="vote_box_score">
            <div class="txt_score _left" id="area_like_1"><?=$_like?></div>
            <div class="bnt_vote _left" onClick="js_like_photo('design',<?=$id?>,'<?=encodeURL("row=".$id."&url=".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]."&action=like_image")?>');">โหวต</div>
            <div class="_clear"></div>
        </div>  
        <a href="javascript:void(0);" onClick="$('#vote_popup').hide();"><img class="bnt_close" src="../img/template/bnt-close.png" alt="close"></a>
        
        <div class="social_box">       	
            <div class="_left fb-share-button" data-href="<?=$_urlShare?>" data-layout="button"></div>
            <div class="_left">
            	<span>
				<script type="text/javascript" src="//media.line.me/js/line-button.js?v=20140411" ></script>
                <script type="text/javascript">
                	new media_line_me.LineButton({"pc":true,"lang":"en","type":"a","text":"<?=$title?> <?=$_urlShare?>","withUrl":true});
                </script>
             	</span>

            </div>
           	<div class="_clear"></div>
        </div>
        
    </div>
</div>
<!-- block content -->
<?php
}
else if($id == 2)
{
?>
<!-- block content -->
<div class="popup_vote_box2">
    <div class="vdo_block">
        <div class="img">
        	<iframe width="553" height="310" src="https://www.youtube.com/embed/9jrc1QWaEOg" frameborder="0" allowfullscreen></iframe>
        </div>
        <div class="no">gu<span>2</span></div>
        <div class="name">AUM&nbsp;_&nbsp;NAPAT</div>
        <div class="content">
            รักการทำอาหารเป็นชีวิตจิตใจ แต่จะเจอห้องที่
            ถูกใจ ห้องครัวติดระเบียงนั้นหาได้ยาก ยู ดีไลท์
            @ หัวหมาก สเตชั่น ตรงใจใช่เลย...
        </div>
        <div class="vote_box_score">
            <div class="txt_score _left" id="area_like_2"><?=$_like?></div>
            <div class="bnt_vote _left" onClick="js_like_photo('design',<?=$id?>,'<?=encodeURL("row=".$id."&url=".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]."&action=like_image")?>');">โหวต</div>
            <div class="_clear"></div>
        </div>  
        <a href="javascript:void(0);" onClick="$('#vote_popup').hide();"><img class="bnt_close" src="../img/template/bnt-close.png" alt="close"></a>
        
        <div class="social_box">       	
            <div class="_left fb-share-button" data-href="<?=$_urlShare?>" data-layout="button"></div>
            <div class="_left">
            	<span>
				<script type="text/javascript" src="//media.line.me/js/line-button.js?v=20140411" ></script>
                <script type="text/javascript">
                	new media_line_me.LineButton({"pc":true,"lang":"en","type":"a","text":"<?=$title?> <?=$_urlShare?>","withUrl":true});
                </script>
             	</span>

            </div>
           	<div class="_clear"></div>
        </div>
        
    </div>
</div>
<!-- block content -->
<?php
}
else if($id == 3)
{
?>
<!-- block content -->
<div class="popup_vote_box3">
    <div class="vdo_block">
        <div class="img">
        	<iframe width="553" height="310" src="https://www.youtube.com/embed/WIaHQjG0Vkk" frameborder="0" allowfullscreen></iframe>
        </div>
        <div class="no">gu<span>3</span></div>
        <div class="name">FLORENCE ROOM</div>
        <div class="content">
            เมื่อสาวแฟชั่น ต้องการเปลี่ยนบรรยากาศเดิมๆ
            มาเปลี่ยนลุคการแต่งหน้าที่ ยู ดีไลท์ @ หัวหมาก
            สเตชั่น จะสวย งดงามแค่ไหน ชมกันเลย...
        </div>
        <div class="vote_box_score">
            <div class="txt_score _left" id="area_like_3"><?=$_like?></div>
            <div class="bnt_vote _left" onClick="js_like_photo('design',<?=$id?>,'<?=encodeURL("row=".$id."&url=".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]."&action=like_image")?>');">โหวต</div>
            <div class="_clear"></div>
        </div>  
        <a href="javascript:void(0);" onClick="$('#vote_popup').hide();"><img class="bnt_close" src="../img/template/bnt-close.png" alt="close"></a>
        
        <div class="social_box">       	
            <div class="_left fb-share-button" data-href="<?=$_urlShare?>" data-layout="button"></div>
            <div class="_left">
            	<span>
				<script type="text/javascript" src="//media.line.me/js/line-button.js?v=20140411" ></script>
                <script type="text/javascript">
                	new media_line_me.LineButton({"pc":true,"lang":"en","type":"a","text":"<?=$title?> <?=$_urlShare?>","withUrl":true});
                </script>
             	</span>

            </div>
           	<div class="_clear"></div>
        </div>
        
    </div>
</div>
<!-- block content -->
<?php
}
else if($id == 4)
{
?>
<!-- block content -->
<div class="popup_vote_box4">
    <div class="vdo_block">
        <div class="img"><iframe width="553" height="310" src="https://www.youtube.com/embed/6CQia-HdU1k" frameborder="0" allowfullscreen></iframe></div>
        <div class="no">gu<span>4</span></div>
        <div class="name">IAUMREVIEW</div>
        <div class="content">
            ทุกวันนี้ใช้เวลาข้างนอกเยอะแล้ว จะหามุมดีๆ
			พักผ่อนได้อย่างเต็มที่ก็ยุ่งยาก พอมาเจอ
			ยู ดีไลท์ รัตนาธิเบศก์ ตอบโจทย์ชีวิตเลย...
        </div>
        <div class="vote_box_score">
            <div class="txt_score _left" id="area_like_4"><?=$_like?></div>
            <div class="bnt_vote _left" onClick="js_like_photo('design',<?=$id?>,'<?=encodeURL("row=".$id."&url=".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]."&action=like_image")?>');">โหวต</div>
            <div class="_clear"></div>
        </div>  
        <a href="javascript:void(0);" onClick="$('#vote_popup').hide();"><img class="bnt_close" src="../img/template/bnt-close.png" alt="close"></a>
        
        <div class="social_box">       	
            <div class="_left fb-share-button" data-href="<?=$_urlShare?>" data-layout="button"></div>
            <div class="_left">
            	<span>
				<script type="text/javascript" src="//media.line.me/js/line-button.js?v=20140411" ></script>
                <script type="text/javascript">
                	new media_line_me.LineButton({"pc":true,"lang":"en","type":"a","text":"<?=$title?> <?=$_urlShare?>","withUrl":true});
                </script>
             	</span>

            </div>
           	<div class="_clear"></div>
        </div>
        
    </div>
</div>
<!-- block content -->
<?php
}
else if($id == 5)
{
?>
<!-- block content -->
<div class="popup_vote_box5">
    <div class="vdo_block">
        <div class="img">
        	<iframe width="553" height="310" src="https://www.youtube.com/embed/dezlalfIZkY" frameborder="0" allowfullscreen></iframe>
        </div>
        <div class="no">gu<span>5</span></div>
        <div class="name">INN SARIN</div>
        <div class="content">
            หนุ่มสถาปัตย์ ที่ฮอตที่สุดในจุฬาฯ จะมาใช้ชีวิต
            อยู่ที่คอนโด ยู แคมปัส รังสิต-เมืองเอก ผลลัพธ์
            การอยู่ครั้งนี้จะเป็นอย่างไร ชมกันเลย...
        </div>
        <div class="vote_box_score">
            <div class="txt_score _left" id="area_like_5"><?=$_like?></div>
            <div class="bnt_vote _left" onClick="js_like_photo('design',<?=$id?>,'<?=encodeURL("row=".$id."&url=".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]."&action=like_image")?>');">โหวต</div>
            <div class="_clear"></div>
        </div>  
        <a href="javascript:void(0);" onClick="$('#vote_popup').hide();"><img class="bnt_close" src="../img/template/bnt-close.png" alt="close"></a>
    </div>
</div>
<!-- block content -->
<?php
}
?>