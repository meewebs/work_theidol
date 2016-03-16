
<script type="text/javascript" src="../../oop/_image/js/ajaxupload.js"></script>
<script type="text/javascript">
	var numLow 			= 100000;
	var numHigh 			= 999999;
	var frame 				= "";
	var adjustedHigh 	= (parseFloat(numHigh) - parseFloat(numLow)) + 1;  
	var numRand 			= Math.floor(Math.random()*adjustedHigh) + parseFloat(numLow);

	$(document).ready(function() {
		
			new AjaxUpload('button_upload', {
			   action: '../../oop/_image/uploadpic.php?cid='+numRand+"&_path=<?=_UPLOAD_?>&_width=<?=_WIDTH_?>&_height=<?=_HEIGHT_?>&delete_file=<?=$src?>",
				onSubmit : function(file , ext){
					 image  = $("#txt_Image").val();
					 $("#loadPage").show();
					
					if (ext && /^(jpg|JPG|png|jpeg|gif)$/.test(ext)){
						/* Setting data */
						this.setData({
							'key'		: 'This string will be send with the file',
							'frame' 	: frame,
							'image' : image
						});					

					} else {
						alert("Please select image file (jpg,png,gif)");
						$("#loadPage").hide();
						return false;				
					}		
				},
				onComplete : function(file,data){	
						//alert(data);
						$("#loadPage").hide();
						document.getElementById("profile_picture").style.width 			= '155px';
						document.getElementById("profile_picture").style.height 		= '155px';
						document.getElementById("profile_picture").style.marginTop 	= '0px';
						$('#txt_Image').val(data) ;
						$('#profile_picture').attr('src','');
						$('#profile_picture').attr('src','<?=_UPLOAD_?>'+data);

				}		
			});
		});	
	</script>
<?
$_src = $src?$src:"../../img/image/bnt-browse.png";
?>
<input name="txt_Image" id="txt_Image" value="<?=$txt_Image?>" type="hidden" />
<img src="<?=$_src?>" id="profile_picture" width="155" height="155">
<div id="button_upload"><button class="btn btn-block" type="button"><?=$Mod_Text["bnt_Upload"] ?></button></div>