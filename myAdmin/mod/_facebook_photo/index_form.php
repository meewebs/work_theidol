<?php
include_once("../../lib/session.php");
header("Content-type: text/html; charset=UTF-8");
include_once("../../lib/config.php");
include_once("../../lib/function.php");
include_once("../sys_load/lang/".$_Language.".php");
include_once("lang/".$_Language.".php");
include_once("config.php");

php_check_session();

$this_path = "../"._THIS_."/index_form.php";

if($action == "SaveAdd"){
	
	#print_r($_POST);
	
	if($id){

		$update 	= "";
		$update[] = _TABLE_."_FacebookID 	= '".$_SESSION["Like_ID"]."'";
		$update[] = _TABLE_."_No 					= '".php_encode_html($txt_No)."'";
		$update[] = _TABLE_."_Subject 			= '".php_encode_html($subject)."'";
		$update[] = _TABLE_."_Image 			= '".$txt_Image."'";
		
		$update[] = _TABLE_."_LastUpdate 	= NOW()";
		
		$sql	=	"UPDATE "._TABLE_." SET ".implode(",",$update)." WHERE "._TABLE_."_ID = '$id' ";
		
		if(mysql_query($sql)){
			$return = "OK";
		}else{
			$return = "Fail";
		}	
		echo $return;
		
	}else{
		
		
		
		$insert = "";
		$insert[_TABLE_."_FacebookID"] 		= "'".$_SESSION["Like_ID"]."'";
		$insert[_TABLE_."_No"] 						= "'".php_encode_html($txt_No)."'";
		$insert[_TABLE_."_Subject"] 				= "'".php_encode_html($subject)."'";
		$insert[_TABLE_."_Image"] 					= "'".$txt_Image."'";
		
		$insert[_TABLE_."_CreateDate"] 		= "NOW()";
		$insert[_TABLE_."_LastUpdate"] 		= "NOW()";
		$insert[_TABLE_."_PrivateIP"] 			= "'".php_getPrivateIP()."'";
		$insert[_TABLE_."_IP"] 						= "'".php_getIP()."'";
		
		$sql	=	" INSERT INTO "._TABLE_."(".implode(",",array_keys($insert)).") VALUES (".implode(",",array_values($insert)).")";
		#echo $sql;
		if(mysql_query($sql)){
			$return = "OK";
		}else{
			$return = "Fail";
		}	
		echo $return;
		
	}
	exit();
	
}else if($action == "Delete"){		
	
	$sql 			= 	" SELECT "._TABLE_."_Image ".
			   			" FROM "._TABLE_.
			   			" WHERE "._TABLE_."_ID = '$id' ";
	$result 		= 	mysql_query($sql);
	if($rs 		= 	mysql_fetch_assoc($result)){
		
		$path 	= 	_UPLOAD_;
		@unlink($path.$rs[_TABLE_."_Image"]);
		
	}
	
	$sql = "DELETE FROM "._TABLE_." WHERE "._TABLE_."_ID = '$id'";
	if(mysql_query($sql)) echo "OK";
	else echo "Fail";
	exit();
	
}else if($action == "DeleteAll"){

	$count_row = count($txt_no);
	for($i = 0;$i<$count_row;$i++){
		
		$id 			= $txt_no[$i];
		$sql 			= 	" SELECT "._TABLE_."_Image ".
			   				" FROM "._TABLE_.
			   				" WHERE "._TABLE_."_ID = '$id' ";
							
		$result 		= 	mysql_query($sql);
		if($rs 		= 	mysql_fetch_assoc($result)){
			
			$src 		= 	_UPLOAD_;
			@unlink($src.$rs[_TABLE_."_Image"]);
			
		}
		
		$sql = "DELETE FROM "._TABLE_." WHERE "._TABLE_."_ID = '$id'";
		mysql_query($sql);
	}
	
	
}else if($action == "enableDisable"){		
	
	$update 	 	= "";
	$update[] 	= _TABLE_."_Status = '$nextStatus'";
	$sql				= "UPDATE "._TABLE_." SET ".implode(",",$update)." WHERE "._TABLE_."_ID='$id' ";

	#echo $sql;
	if(mysql_query($sql)) echo "OK";
	else echo "Fail";
	
	exit();
	
}else if($action == "Sorting"){
	
	#print_r($_POST);
	if($txt_Order){
		
		$count_order 	= count($txt_Order);
		$i = 0;
		foreach($txt_Order as $val){
			
			$order 		= $count_order - $i;
			$update 	= "";
			$update[] = _TABLE_."_Order = '$order' ";
			$sql 			=	"UPDATE "._TABLE_." SET ".implode(",",$update)." WHERE "._TABLE_."_ID = '{$val}' ";
			unset($update);
			#echo $sql;
			mysql_query($sql);
			
			$i++;
			
		}
		
	}
	
	echo "OK";
	
	exit();
	
	
}
?>
<link href="../../css/css.css" rel="stylesheet" type="text/css" />
<script>
	var this_page = '<?=$this_path?>';
</script>
<script src="../../lib/angular.min.js"></script>
<script src="../<?=_THIS_?>/function.js"></script>

<?php


if($_SESSION["Like_ID"]){
	
	
	if($action == "OK"){
		
?>
	<div id="message" class="alert alert-success">
		<h4><?=$Mod_Text["mes_OK"]?></h4>
        <br>
        <p>
        <button type="button" class="btn" onclick='js_load_page($("#area_panel") ,"<?=$this_path?>" , "action=View&menu_id=<?=$menu_id?>&s_menu=<?=$s_menu?>");'><?=$Mod_Text["bnt_OK"]?></button>
        </p>
    </div>
    
<?		
	}else if($action == "Fail"){	
?>
	<div id="message" class="alert alert-danger">
		<h4><?=$Mod_Text["mes_Fail"]?></h4>
        <br>
        <p>
        <button type="button" class="btn" onclick='js_load_page($("#area_panel") ,"<?=$this_path?>" , "action=View&menu_id=<?=$menu_id?>&s_menu=<?=$s_menu?>");'><?=$Mod_Text["bnt_OK"]?></button>
        </p>
    </div>
    
<?	
	}else if($action == "Add"){
		
		if($id){
			$sql 				= " SELECT * FROM "._TABLE_." WHERE "._TABLE_."_ID = $id ";	
			$result 			= mysql_query($sql);
			$rs				= mysql_fetch_assoc($result);
			$txt_Image	=	$rs[_TABLE_."_Image"];
			
			if($rs[_TABLE_."_Image"]) $src = _UPLOAD_.$rs[_TABLE_."_Image"];
			else $src = "";
			#echo $_src;
		}
?>
		<link href="../../object/obj_fckeditor/sample.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="../../object/obj_fckeditor/fckeditor.js"></script>
        
    
		<div id="area_input">
    	<form id="myForm" name="myForm" enctype="multipart/form-data" method="post" class="form-horizontal" ng-submit="submit()" ng-controller="js_Save">
          <input name="menu_id" id="menu_id" type="hidden" value="<?=$menu_id?>" />
          <input type="hidden" name="s_menu" id="s_menu" value="<?=$s_menu?>" />
          <input name="id" id="id" type="hidden" value="<?=$id?>" />
          
          <div class="control-group">
            <label class="control-label"><?=$Mod_Field["txt_Img"]?></label>
            <div class="controls">
              <?
              include("../../oop/_image/index_form.php");
			  ?>
            </div>
          </div>
          
          <div class="control-group">
            <label class="control-label" for="txt_Title">ลำดับที่</label>
            <div class="controls">
              <input type="text" id="txt_No" name="txt_No" placeholder="ลำดับที่" value="<?=php_decode_html($rs[_TABLE_."_No"])?>" onkeypress="return CheckNumericKeyInfo(event.keyCode, event.which);" style="width:600px;" required="required">
            </div>
          </div>
 
          
          <div class="control-group">
            <label class="control-label" for="txt_Subject"><?=$Mod_Field["txt_Subject"]?></label>
            <div class="controls">
              <textarea name="txt_Subject" id="txt_Subject"><?=php_decode_html($rs[_TABLE_."_Subject"])?></textarea>
			  <div style="display:none">
            	<input name="subject" id="subject" type="hidden" value="<?=php_decode_html($rs[_TABLE_."_Subject"])?>" />
              </div>
            </div>
          </div>
          
          
          
          <div class="control-group">
            <div class="controls">
              <button type="submit" class="btn btn-success"><?=$Mod_Text["save_data"]?></button>
              <button type="button" class="btn" onclick='js_load_page($("#area_panel") ,"<?=$this_path?>" , "action=View&menu_id=<?=$menu_id?>");'><?=$Mod_Text["cancel_data"]?></button>
            </div>
          </div>
        </form>
        </div>
        
        
        <script type="text/javascript">
				
				var sBasePath					= "<?=_SYSTEM_ROOTPATH_FULL_._SYSTEM_ROOTPATH_."/myAdmin/object/obj_fckeditor/"?>";
				var oFCKeditor 				= new FCKeditor( 'txt_Subject' );
				
				
				oFCKeditor.BasePath		= sBasePath;
				oFCKeditor.ToolbarSet 	= "Basic";
				oFCKeditor.Width 			= '600px';
                oFCKeditor.Height 			= '200px';
				oFCKeditor.ReplaceTextarea() ;
		
        </script>


<?		

	}else if($action == "View" || $action == ""){
		
		// Read navigator menu na.
		include_once("../../oop/_navigator/index_form.php");
		
		if(empty($order) && $reorder){
			 $order = "ASC";
		 }else if($reorder){
			 
			if($order == "ASC"){
				$order = "DESC";	
			}else{
				$order = "ASC";	
			}
		 }
?>
	<script src="../../lib/jquery-sortable.js"></script>
    
    
    
    <?php
     //echo date("d-m-Y H:i:s");
	?>    
	<form action="index_form.php" method="post" name="dataForm" id="dataForm">	
    	<input type="hidden" name="action" id="action" value="<?=$action?>" />
        <input type="hidden" name="reorder" id="reorder" value="<?=$reorder?>" />
        <input type="hidden" name="order" id="order" value="<?=$order?>" />
        <input type="hidden" name="menu_id" id="menu_id" value="<?=$menu_id?>" />
        <input type="hidden" name="s_menu" id="s_menu" value="<?=$s_menu?>" />
        <div class="panel">
          <div class="panel-heading">
            <h3 class="panel-title"><?=$menu_Name?></h3>
            <p>
                <div class="p_left input_top">
                <a href='javascript:js_load_page($("#area_data") ,"<?=$this_path?>" , "action=Add&menu_id=<?=$menu_id?>&s_menu=<?=$s_menu?>");' class="btn btn-info"><i class="icon-plus-sign icon-plus-sign  icon-white"></i> <?=$Mod_Text["create_data"]?></a>
                
                
                <a href="javascript:void(0);" class="btn btn-danger" onClick=" if (confirm('<?=$Mod_Text["Delete_Form"]?>')) {  js_main_delete_all('<?=$this_path?>','id=<?=$rs[_TABLE_."_ID"]?>&page=<?=$page?>&menu_id=<?=$menu_id?>&s_menu=<?=$s_menu?>'); }"><i class="icon-trash icon-white"></i> <?=$Mod_Text["delete_data"]?></a>
                
                 <a href='javascript:void(0);' onClick="
                        var search = document.getElementById('txt_Search').value;
                        //var txt_begindate = document.getElementById('txt_BeginDate').value;
                        //var txt_enddate = document.getElementById('txt_EndDate').value;
                        //var txt_week = document.getElementById('txt_Week').value;
                        window.location='../<?=_THIS_?>/index_excel.php';" class="btn"><i class="icon-th-list"></i> Excel</a>
                        
                 
                 <a href='javascript:void(0);' onClick="window.location='../<?=_THIS_?>/user_excel.php';" class="btn"><i class="icon-th-list"></i> Excel ผู้ร่วมโหวต</a>
                
                </div>
                
                <div class="p_right">
                	<?php /*?><select name="txt_Week" id="txt_Week" class="input_top" style="width:150px;">
                    	<option value="0">เลือกสัปดาห์</option>
                        <option value="1" <?=($txt_Week == 1)?"selected":""?>>สัปดาห์ที่ 1 (3-9 เมษายน 57)</option>
                        <option value="2" <?=($txt_Week == 2)?"selected":""?>>สัปดาห์ที่ 2 (10-16 เมษายน 57)</option>
                        <option value="3" <?=($txt_Week == 3)?"selected":""?>>สัปดาห์ที่ 3 (17-23 เมษายน 57)</option>
                        <option value="4" <?=($txt_Week == 4)?"selected":""?>>สัปดาห์ที่ 4 (24-30 เมษายน 57)</option>
                    </select>
                
                	<input name="txt_BeginDate" id="txt_BeginDate" onclick="if(self.gfPop)gfPop.fPopCalendar(document.dataForm.txt_BeginDate);return false;" type="text" class="input_top"  style="width:100px;" maxlength="400" value="<?=$txt_BeginDate?>" placeholder="วันที่เริ่มต้น" />                   
                     
                  	<input name="txt_EndDate" id="txt_EndDate" onclick="if(self.gfPop)gfPop.fPopCalendar(document.dataForm.txt_EndDate);return false;" type="text" class="input_top"  style="width:100px;" maxlength="400" value="<?=$txt_EndDate?>" placeholder="วันที่สิ้นสุด" />  
                    <?php */?>
                    <input type="text" id="txt_Search" name="txt_Search" value="<?=$txt_Search?>" class="input_top" style="width:150px;" placeholder="<?=$Mod_Text["txt_Search"]?>">
                    <button type="button" class="btn btn-default" onclick="js_main_search($('#area_panel') , '<?=$this_path?>');" ><i class="icon-search"></i> <?=$Mod_Text["txt_Search"]?></button>
                    <?
                    if($txt_Search || $txt_BeginDate || $txt_EndDate || $txt_Week){
                    ?>
                    <button type="button" class="btn btn-danger" onclick='js_load_page($("#area_panel") , "<?=$this_path?>" , "action=View&menu_id=<?=$menu_id?>&s_menu=<?=$s_menu?>");' ><?=$Mod_Text["cancel_data"]?></button>
                    <?
                    }
                    ?>
                </div>
                <div class="p_clear"></div>
                  
            </p>
          </div>
          
          <!-- Begin Data -->
          <div id="area_data">
             <?
             require_once "../../lib/class.page_split.php";
			 
			 $_myPage = $_SESSION["_PageSize"]?$_SESSION["_PageSize"]:_PAGE_SIZE_;
			  
             $obj = new page_split();
             $obj->_setPageSize($_myPage); 
             $obj->_setFile($this_path); 
             $obj->_setPage($page); 
             
             
             
             $sql  = 	" SELECT "._TABLE_."_ID , "._TABLE_."_No , "._TABLE_."_Image , "._TABLE_."_Subject , "._TABLE_."_Like , "._TABLE_."_Status , ".
			 				" ( SELECT COUNT("._TABLE_LIKE_."_ID) FROM "._TABLE_LIKE_." WHERE "._TABLE_LIKE_."_GroupID = "._TABLE_."_ID ) AS "._TABLE_."_CLike ".
                            " FROM "._TABLE_.
							#" LEFT JOIN "._TABLE_REGISTER_." ON "._TABLE_REGISTER_."_FacebookID = "._TABLE_."_FacebookID ".
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
				 
                #$sql .= 	" ORDER BY  IF("._TABLE_."_Order > 0 , "._TABLE_."_Order , "._TABLE_."_ID )  DESC ";
				$sql .= 	" ORDER BY "._TABLE_."_NO ";
				
             }
              
             #echo $sql;
             $result	 	=	$obj->_query($sql);
             $link 		= "txt_Search=$txt_Search";
             
             if($page)	$row_index 	= ($_myPage * $page) - $_myPage;
             else $row_index 			= 0;
             $_my_index 				= 0;
             
             $i 								= 0;
             ?>
             
             <div><? $obj->_displayPage($link);?></div>
             <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered table-hover table-striped ">
                  <tr>
                    <td width="2%" align="center" valign="top"><input type="checkbox" name="txt_All" id="txt_All" onclick="js_main_select_all(this);" /></td>
                    <td width="4%" align="center" valign="top">No</td>
                    <td width="10%" align="center" valign="top"><?=$Mod_Field["txt_Img"]?></td>
                    <td width="50%" align="center" valign="top"><a href="javascript:js_main_search($('#area_panel') , '<?=$this_path?>' ,'&reorder=_Subject');"><?=$Mod_Field["txt_Subject"]?></a>
                    <?
                    if($reorder == "_Subject"){
                        
                        if($order == "ASC") echo '<span class="badge"><i class="icon-thumbs-up icon-white"></i></span>';
                        else echo '<span class="badge"><i class="icon-thumbs-down icon-white"></i></span>';
                    }
                    ?>
                    </td>
                    <td width="12%" align="center" valign="top">คะแนนโหวด</td>
                    <td width="22%" align="center" valign="top"><?=$Mod_Text["Tool"]?></td>
                  </tr>
                  <?
                  while($rs = mysql_fetch_assoc($result)){
                    ++$row_index;
                    ++$_my_index;
                    $id 				= $rs[_TABLE_."_ID"];
                    $row_id		=	substr('00'.$rs[_TABLE_."_No"],-2);
                    
                    $src 				= _UPLOAD_.$rs[_TABLE_."_Image"];
                    (file_exists($src) && strlen($rs[_TABLE_."_Image"])>4) ?  $src : $src="../../img/image/bnt-browse.png";
					//$src 				= _SYSTEM_ROOTPATH_FULL_._SYSTEM_ROOTPATH_."/photo/upload/dna-".$id.".png";
                    #echo $src;
                  ?>
                  <tr>
                    <td align="center" valign="top">
                    	<input type="checkbox" name="txt_no[]" id="txt_no_<?=$i?>" value="<?=$id?>" />
                        <input type="hidden" name="txt_Order[]" id="txt_Order_<?=$i?>" value="<?=$id?>" />
                    </td>
                    <td align="center" valign="top"><?=$row_id?></td>
                    <td align="center" valign="top"><img src="<?=$src?>" width="70" class="img-rounded" alt="<?=$rs[_TABLE_."_ID"]?>"></td>
                    <td align="center" valign="top">
					<div class="content_cms"><?=php_decode_html($rs[_TABLE_."_Subject"])?></div>
                    </td>
                    <td align="center" valign="top"><?=$rs[_TABLE_."_CLike"]?> <a href="../<?=_THIS_?>/index_vote.php?id=<?=$id?>" target="_blank" >ดูคนโหวต</a></td>
                    <td align="center" valign="top">
                        <div class="btn-group">
                          <?
                          if($rs[_TABLE_."_Status"] == "Enable") $class = "btn-default"; else $class = "btn-warning";
                          ?>
                          <a class="btn <?=$class?>" href="javascript:void(0);" onclick="js_main_enable(this,'<?=$this_path?>','id=<?=$id?>&page=<?=$page?>&menu_id=<?=$menu_id?>&s_menu=<?=$s_menu?>')"><?=$rs[_TABLE_."_Status"]?></a>
                        </div>
    
                        <!-- Split button -->
                        <div class="btn-group">
                          <button type="button" class="btn btn-default"><?=$Mod_Text["bnt_Action"] ?></button>
                          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                          </button>
                          <ul class="dropdown-menu">
                            <li><a href='javascript:js_load_page($("#area_data") ,"<?=$this_path?>" , "action=Add&id=<?=$id?>&menu_id=<?=$menu_id?>&s_menu=<?=$s_menu?>");'>
                            <i class="icon-pencil"></i>
                            <?=$Mod_Text["edit_data"]?>
                            </a></li>
                            <li><a href="javascript:void(0);" onClick=" if (confirm('<?=$Mod_Text["Delete_Form"]?>')) {  js_main_delete('<?=$this_path?>','id=<?=$id?>&page=<?=$page?>&menu_id=<?=$menu_id?>&s_menu=<?=$s_menu?>'); }">
                            <i class="icon-trash"></i>
                            <?=$Mod_Text["delete_data"]?>
                            </a></li> 
                            <li class="divider"></li>
                            <li class="txt_time"><a href="#"><?=$Mod_Text["txt_Update"]?> <?=php_FormatDate("1 Jan XX",$rs[_TABLE_."_LastUpdate"],true)?></a></li>
                            <li class="txt_time"><a href="#"><?=$Mod_Text["txt_Create"]?> <?=php_FormatDate("1 Jan XX",$rs[_TABLE_."_CreateDate"],true)?></a></li>
                            
                          </ul>
                        </div>
                    </td>
                  </tr>
                  <?
                    $i++;
                  }#end while
                  ?>
                </table>
                <input name="txt_colum" id="txt_colum" type="hidden" value="<?=$i?>" /> 
                <div><? $obj->_displayPage($link);?></div>
    
          </div>
          <!-- End Data -->
          
        </div>	
	</form>	
<?	
	}#end if action

}#end if main
?>