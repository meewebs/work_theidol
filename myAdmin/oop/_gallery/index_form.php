<?
include_once("../../lib/session.php");
header("Content-type: text/html; charset=UTF-8");
include_once("../../lib/config.php");
include_once("../../lib/function.php");
include_once("../../mod/sys_load/lang/".$_Language.".php");
include_once("../../mod/_gallery/config.php");

?>
<script type="text/javascript" src="../../oop/_image/js/ajaxupload.js"></script>
<script type="text/javascript">
	var numLow 			= 100000;
	var numHigh 			= 999999;
	var frame 				= "";
	var adjustedHigh 	= (parseFloat(numHigh) - parseFloat(numLow)) + 1;  
	var numRand 			= Math.floor(Math.random()*adjustedHigh) + parseFloat(numLow);

	$(document).ready(function() {
		
			new AjaxUpload('button_gallery', {
			   action: '../../oop/_gallery/uploadpic.php?cid='+numRand+"&_path=<?=_UPLOAD_GALLERY_?>&_width=<?=_WIDTH_?>&_height=<?=_HEIGHT_?>&delete_file=<?=$gallery?>&g_id=<?=$id?>&table=<?=_TABLE_GALLERY_?>&table_thumb=<?=_TABLE_GALLERY_?>",
				onSubmit : function(file , ext){
					 image  = $("#txt_Gallery").val();
					 $("#loadPage").show();
					
					if (ext && /^(jpg|JPG|png|jpeg|gif)$/.test(ext)){
						/* Setting data */
						this.setData({
							'key'		: 'This string will be send with the file',
							'frame' 	: frame,
							'image' : image
						});					

					}else{
						
						alert("Please select image file (jpg,png,gif)");
						$("#loadPage").hide();
						return false;				
						
					}		
				},
				onComplete : function(file,data){	
						//alert(data);
						js_load_bnt_gallery();
						$("#loadPage").hide();
						document.getElementById("profile_gallery").style.width 			= '155px';
						document.getElementById("profile_gallery").style.height 		= '155px';
						document.getElementById("profile_gallery").style.marginTop 	= '0px';
						$('#txt_Gallery').val(data) ;
						$('#profile_gallery').attr('src','');
						$('#profile_gallery').attr('src','<?=_UPLOAD_GALLERY_?>'+data);
						
						

				}		
			});
		});	
	</script>
<?
$_gallery = "../../img/image/bnt-browse.png";
?>
<div class="block_gallery">

    <div class="gallery">
        <input name="txt_Gallery" id="txt_Gallery" value="<?=$txt_Gallery?>" type="hidden" />
        <img src="<?=$_gallery?>" id="profile_gallery" width="155" height="155">
        <div id="button_gallery" style="margin-bottom:20px;">
        <button class="btn btn-block" type="button"><?=$Mod_Text["bnt_Upload"] ?></button>
        </div>
    </div>
    
    <?
    if($id){
		
		$sql_gallery = 	" SELECT * FROM "._TABLE_GALLERY_.
								" WHERE 1=1";
		$sql_gallery .= " ORDER BY  IF("._TABLE_GALLERY_."_Order > 0 , "._TABLE_GALLERY_."_Order , "._TABLE_GALLERY_."_ID )  DESC ";
		$result_gallery	= mysql_query($sql_gallery);
		$i = 0;
		while($rs_gallery = mysql_fetch_assoc($result_gallery)){
			
			$_gallery 	= _UPLOAD_GALLERY_.$rs_gallery[_TABLE_GALLERY_."_Image"];
			#echo $_gallery;
            (file_exists($_gallery) && strlen($rs_gallery[_TABLE_GALLERY_."_Image"])>4) ?  $_gallery : $_gallery="../../img/image/bnt-browse.png";
	
	?>		
			<div class="gallery">
                <input name="txt_img[]" id="txt_img_<?=$i?>" value="<?=$rs[_TABLE_GALLERY_."_ID"]?>" type="hidden" />
                <img src="<?=$_gallery?>" id="profile_gallery" class="img-polaroid" width="155">
                <div id="button_gallery" style="margin-bottom:20px;">
                <button class="btn btn-danger btn-block" type="button"><?=$Mod_Text["delete_data"]?></button>
                </div>
            </div>
	<?		
		$i++;
		}#end while
		
	}else{
		
		
		
	}
	?>
    
</div> 
