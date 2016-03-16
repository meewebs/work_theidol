<?php
include_once("../../lib/session.php");
header("Content-type: text/html; charset=UTF-8");
include_once("../../lib/config.php");
include_once("../../lib/function.php");
include_once("../sys_load/lang/".$_Language.".php");
include_once("lang/".$_Language.".php");
include_once("config.php");

$this_path = "../"._THIS_."/index_form.php";

if($action == "SaveAdd"){
	
	#print_r($_POST);
	
	if($id){

		$update 	= "";
		$update[] = _TABLE_."_LevelID 			= '".$txt_LevelID."'";
		$update[] = _TABLE_."_Image 			= '".$txt_Image."'";
		$update[] = _TABLE_."_Username 		= '".$txt_Username."'";
		$update[] = _TABLE_."_Password 		= '".md5($txt_Password)."'";
		$update[] = _TABLE_."_Firstname 		= '".$txt_Firstname."'";
		$update[] = _TABLE_."_Lastname 		= '".$txt_Lastname."'";
		$update[] = _TABLE_."_Email 				= '".$txt_Email."'";
		$update[] = _TABLE_."_Phone 			= '".$txt_Phone."'";
		
		$update[] = _TABLE_."_SupplierID 		= '".$txt_SupplierID."'";
		
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
		$insert[_TABLE_."_LevelID"] 				= "'".$txt_LevelID."'";
		$insert[_TABLE_."_Image"] 					= "'".$txt_Image."'";
		$insert[_TABLE_."_Username"] 			= "'".$txt_Username."'";
		$insert[_TABLE_."_Password"] 			= "'".md5($txt_Password)."'";
		$insert[_TABLE_."_Firstname"] 			= "'".$txt_Firstname."'";
		$insert[_TABLE_."_Lastname"] 			= "'".$txt_Lastname."'";
		$insert[_TABLE_."_Email"] 					= "'".$txt_Email."'";
		$insert[_TABLE_."_Phone"] 				= "'".$txt_Phone."'";
		
		$insert[_TABLE_."_SupplierID"] 			= "'".$txt_SupplierID."'";
		
		$insert[_TABLE_."_CreateDate"] 		= "NOW()";
		$insert[_TABLE_."_LastUpdate"] 		= "NOW()";
		$insert[_TABLE_."_PrivateIP"] 			= "'".php_getPrivateIP()."'";
		$insert[_TABLE_."_IP"] 						= "'".php_getIP()."'";
		
		$sql	=	" INSERT INTO "._TABLE_."(".implode(",",array_keys($insert)).") VALUES (".implode(",",array_values($insert)).")";
		
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
<script src="../../lib/angular.min.js"></script>
<script src="../<?=_THIS_?>/function.js"></script>
<script>
	this_page = '<?=$this_path?>';
</script>
<?php


if($_SESSION["Like_ID"]){
	
	
	if($action == "OK"){
		
?>
	<div id="message" class="alert alert-success">
		<h4><?=$Mod_Text["mes_OK"]?></h4>
        <br>
        <p>
        <button type="button" class="btn" onclick='js_load_page($("#area_panel") ,"<?=$this_path?>" , "action=View");'><?=$Mod_Text["bnt_OK"]?></button>
        </p>
    </div>
    
<?		
	}else if($action == "Fail"){	
?>
	<div id="message" class="alert alert-danger">
		<h4><?=$Mod_Text["mes_Fail"]?></h4>
        <br>
        <p>
        <button type="button" class="btn" onclick='js_load_page($("#area_panel") ,"<?=$this_path?>" , "action=View");'><?=$Mod_Text["bnt_OK"]?></button>
        </p>
    </div>
    
<?	
	}else if($action == "Add"){
		
		if($id){
			$sql 				= " SELECT * FROM "._TABLE_." WHERE "._TABLE_."_ID = $id ";	
			$result 			= mysql_query($sql);
			$rs				= mysql_fetch_assoc($result);
			
			$txt_Level	= $rs[_TABLE_."_LevelID"];
			$txt_Image	= $rs[_TABLE_."_Image"];
			$supplierID	= $rs[_TABLE_."_SupplierID"];
			
			if($rs[_TABLE_."_Image"]) $src = _UPLOAD_.$rs[_TABLE_."_Image"];
			else $src = "";
			#echo $_src;
		}
?>
		<div id="area_input">
    	<form id="myForm" name="myForm" enctype="multipart/form-data" method="post" class="form-horizontal" ng-submit="submit()" ng-controller="js_Save">
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
            <label class="control-label" for="txt_LevelID"><?=$Mod_Field["txt_permission"]?></label>
            <div class="controls">
            
              <?
                $sql_per  = 	" SELECT * FROM "._TABLE_PERMISSION_." WHERE "._TABLE_PERMISSION_."_Status = 'Enable' ".
				$sql_per .= 	" ORDER BY  IF("._TABLE_PERMISSION_."_Order > 0 , "._TABLE_PERMISSION_."_Order , "._TABLE_PERMISSION_."_ID )  DESC ";
				#echo $sql_per;
				$result_per 		= mysql_query($sql_per);
			  ?>
              
              
              <select name="txt_LevelID" >
              	<option value="0"><?=$Mod_Field["txt_permission"]?></option>
                <?
				while($rs_per 	= mysql_fetch_assoc($result_per)){
					if($txt_Level == $rs_per[_TABLE_PERMISSION_."_ID"]) $sel = "selected"; else $sel = "";
				?>
                	<option value="<?=$rs_per[_TABLE_PERMISSION_."_ID"]?>" <?=$sel?>><?=$rs_per[_TABLE_PERMISSION_."_Title"]?></option>
                <?	
					
				}#end while
				?>
              </select>
            </div>
          </div>
          
          
          <div class="control-group">
            <label class="control-label" for="txt_SupplierID">บริษัท</label>
            <div class="controls">
              
              <select id="txt_SupplierID" name="txt_SupplierID">
                <option value="0">บริษัท</option>
                <?php
                $sql_f  = " SELECT * FROM "._SUPPLIER_." WHERE "._SUPPLIER_."_Status = 'Enable' ";
                $sql_f .= " ORDER BY  IF("._SUPPLIER_."_Order > 0 , "._SUPPLIER_."_Order , "._SUPPLIER_."_ID )  DESC ";
                $result_f = mysql_query($sql_f);
                while($rs_f = mysql_fetch_assoc($result_f))
                {
                    if($supplierID == $rs_f[_SUPPLIER_."_ID"]) $sel = "selected"; else $sel = "";
                ?>
                    <option value="<?=$rs_f[_SUPPLIER_."_ID"]?>" <?=$sel?>><?=$rs_f[_SUPPLIER_."_Title"]?></option>
                <?php
                }
                ?>
              </select>
            </div>
          </div>
          
          <div class="control-group">
            <label class="control-label" for="txt_Username"><?=$Mod_Field["txt_Username"]?></label>
            <div class="controls">
              <input type="text" id="txt_Username" name="txt_Username" placeholder="<?=$Mod_Field["txt_Username"]?>" value="<?=$rs[_TABLE_."_Username"]?>" required="required">
            </div>
          </div>
          
          <div class="control-group">
            <label class="control-label" for="txt_Password"><?=$Mod_Field["txt_Pass"]?></label>
            <div class="controls">
              <input type="password" id="txt_Password" name="txt_Password" placeholder="<?=$Mod_Field["txt_Pass"]?>" value="<?=$rs[_TABLE_."_Password"]?>" required="required">
            </div>
          </div>
          
          <div class="control-group">
            <label class="control-label" for="txt_Firstname"><?=$Mod_Field["txt_Firstname"]?></label>
            <div class="controls">
              <input type="text" id="txt_Firstname" name="txt_Firstname" placeholder="<?=$Mod_Field["txt_Firstname"]?>" value="<?=$rs[_TABLE_."_Firstname"]?>" required="required">
            </div>
          </div>
          
          <div class="control-group">
            <label class="control-label" for="txt_Lastname"><?=$Mod_Field["txt_Lastname"]?></label>
            <div class="controls">
              <input type="text" id="txt_Lastname" name="txt_Lastname" placeholder="<?=$Mod_Field["txt_Lastname"]?>" value="<?=$rs[_TABLE_."_Lastname"]?>" required="required">
            </div>
          </div>
          
          <div class="control-group">
            <label class="control-label" for="txt_Email"><?=$Mod_Field["txt_Email"]?></label>
            <div class="controls">
              <input type="text" id="txt_Email" name="txt_Email" placeholder="<?=$Mod_Field["txt_Email"]?>" value="<?=$rs[_TABLE_."_Email"]?>" required="required">
            </div>
          </div>
          
          <div class="control-group">
            <label class="control-label" for="txt_Phone"><?=$Mod_Field["txt_Phone"]?></label>
            <div class="controls">
              <input type="text" id="txt_Phone" name="txt_Phone" placeholder="<?=$Mod_Field["txt_Phone"]?>" value="<?=$rs[_TABLE_."_Phone"]?>" required="required">
            </div>
          </div>
          
          
          
          <div class="control-group">
            <div class="controls">
              <button type="submit" class="btn btn-success"><?=$Mod_Text["save_data"]?></button>
              <button type="button" class="btn" onclick='js_load_page($("#area_panel") ,"<?=$this_path?>" , "action=View");'><?=$Mod_Text["cancel_data"]?></button>
            </div>
          </div>
        </form>
        </div>


<?		

	}else if($action == "View" || $action == ""){
		
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
    <script>
	  $(function() {
		$('.sorted_table').sortable({
		  containerSelector: 'table',
		  itemPath: '> tbody',
		  itemSelector: 'tr',
		  placeholder: '<tr class="placeholder"/>'
		})
		
		// Sortable column heads
		var oldIndex
		$('.sorted_head tr').sortable({
		  containerSelector: 'tr',
		  itemSelector: 'th',
		  placeholder: '<th class="placeholder"/>',
		  vertical: false,
		  onDragStart: function (item, group, _super) {
			oldIndex = item.index()
			item.appendTo(item.parent())
			_super(item)
		  },
		  onDrop: function  (item, container, _super) {
			var field,
			newIndex = item.index()

			if(newIndex != oldIndex)
			  item.closest('table').find('tbody tr').each(function (i, row) {
				row = $(row)
				field = row.children().eq(oldIndex)
				if(newIndex)
				  field.before(row.children()[newIndex])
				else
				  row.prepend(field)
				  
			  })
			  
			 
		
			_super(item)
		  }
		})
	  });
	</script>
        
	<form action="index_form.php" method="post" name="dataForm" id="dataForm">	
    	<input type="hidden" name="action" id="action" value="<?=$action?>" />
        <input type="hidden" name="reorder" id="reorder" value="<?=$reorder?>" />
        <input type="hidden" name="order" id="order" value="<?=$order?>" />
        <div class="panel">
          <div class="panel-heading">
            <h3 class="panel-title"><?=$Mod_Text["create_user"]?></h3>
            <p>
                <div class="p_left input_top">
                <a href='javascript:js_load_page($("#area_data") ,"<?=$this_path?>" , "action=Add");' class="btn btn-info"><i class="icon-plus-sign icon-plus-sign  icon-white"></i> <?=$Mod_Text["create_data"]?></a>
                
                <a href="javascript:void(0);" class="btn btn-danger" onClick=" if (confirm('<?=$Mod_Text["Delete_Form"]?>')) {  js_main_delete_all('<?=$this_path?>','id=<?=$rs[_TABLE_."_ID"]?>&page=<?=$page?>'); }"><i class="icon-trash icon-white"></i> <?=$Mod_Text["delete_data"]?></a>
                
                <a href='javascript:js_main_sorting($("#area_data") ,"<?=$this_path?>");' class="btn"><i class="icon-th-list"></i> <?=$Mod_Text["bnt_Order"]?></a>
                </div>
                
                <div class="p_right">
                    <input type="text" id="txt_Search" name="txt_Search" value="<?=$txt_Search?>" class="input_top" placeholder="<?=$Mod_Text["txt_Search"]?>">
                    <button type="button" class="btn btn-default" onclick="js_main_search($('#area_panel') , '<?=$this_path?>');" ><i class="icon-search"></i> <?=$Mod_Text["txt_Search"]?></button>
                    <?
                    if($txt_Search){
                    ?>
                    <button type="button" class="btn btn-danger" onclick='js_load_page($("#area_panel") , "<?=$this_path?>" , "action=View");' ><?=$Mod_Text["cancel_data"]?></button>
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
             
             
             
             $sql  = 	" SELECT * ".
                            " FROM "._TABLE_.
							" LEFT JOIN "._TABLE_PERMISSION_." ON "._TABLE_PERMISSION_."_ID = "._TABLE_."_LevelID ".
                            " WHERE 1=1 ";
            
             if($txt_Search){
				 
                $sql .= " AND ( "._TABLE_."_Username like'%$txt_Search%' ";
                $sql .= " OR "._TABLE_."_Email like '%$txt_Search%' ";
				$sql .= " OR "._TABLE_."_Firstname like '%$txt_Search%' ";
				$sql .= " OR "._TABLE_."_Lastname like '%$txt_Search%' ";
				$sql .= " OR "._TABLE_."_Phone like '%$txt_Search%' ";
                $sql .= " ) ";
				
             }
             
             if($reorder){
                 
                 $sql .= 	" ORDER BY  "._TABLE_.$reorder."  ".$order;
                 
             }else{
				 
                $sql .= 	" ORDER BY  IF("._TABLE_."_Order > 0 , "._TABLE_."_Order , "._TABLE_."_ID )  DESC ";
				
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
             <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered table-hover table-striped sorted_table">
                  <tr>
                    <td width="2%" align="center" valign="top"><input type="checkbox" name="txt_All" id="txt_All" onclick="js_main_select_all(this);" /></td>
                    <td width="2%" align="center" valign="top">No</td>
                    <td width="5%" align="center" valign="top"><?=$Mod_Field["txt_Img"]?></td>
                    <td width="14%" align="center" valign="top">
					<?=$Mod_Field["txt_permission"]?>
                    </td>
                    <td width="10%" align="center" valign="top"><a href="javascript:js_main_search($('#area_panel') , '<?=$this_path?>' ,'&reorder=_Username');"><?=$Mod_Field["txt_Username"]?></a> 
                    <?
                    if($reorder == "_Username"){
                        
                        if($order == "ASC") echo '<span class="badge"><i class="icon-thumbs-up icon-white"></i></span>';
                        else echo '<span class="badge"><i class="icon-thumbs-down icon-white"></i></span>';
                    }
                    ?>
                    
                    </td>
                    <td width="12%" align="center" valign="top"><a href="javascript:js_main_search($('#area_panel') , '<?=$this_path?>' ,'&reorder=_Firstname');"><?=$Mod_Field["txt_Firstname"]?></a>
                    <?
                    if($reorder == "_Firstname"){
                        
                        if($order == "ASC") echo '<span class="badge"><i class="icon-thumbs-up icon-white"></i></span>';
                        else echo '<span class="badge"><i class="icon-thumbs-down icon-white"></i></span>';
                    }
                    ?>
                    </td>
                     <td width="12%" align="center" valign="top"><a href="javascript:js_main_search($('#area_panel') , '<?=$this_path?>' ,'&reorder=_Lastname');"><?=$Mod_Field["txt_Lastname"]?></a>
                    <?
                    if($reorder == "_Lastname"){
                        
                        if($order == "ASC") echo '<span class="badge"><i class="icon-thumbs-up icon-white"></i></span>';
                        else echo '<span class="badge"><i class="icon-thumbs-down icon-white"></i></span>';
                    }
                    ?>
                    </td>
                     <td width="18%" align="center" valign="top"><a href="javascript:js_main_search($('#area_panel') , '<?=$this_path?>' ,'&reorder=_Email');"><?=$Mod_Field["txt_Email"]?></a>
                    <?
                    if($reorder == "_Email"){
                        
                        if($order == "ASC") echo '<span class="badge"><i class="icon-thumbs-up icon-white"></i></span>';
                        else echo '<span class="badge"><i class="icon-thumbs-down icon-white"></i></span>';
                    }
                    ?>
                    </td>
                    <td width="25%" align="center" valign="top"><?=$Mod_Text["Tool"]?></td>
                  </tr>
                  <?
                  while($rs = mysql_fetch_assoc($result)){
                    ++$row_index;
                    ++$_my_index;
                    $id 				= $rs[_TABLE_."_ID"];
                    $row_id		=	substr('0000'.$row_index,-4);
                    
                    $src 				= _UPLOAD_.$rs[_TABLE_."_Image"];
                    (file_exists($src) && strlen($rs[_TABLE_."_Image"])>4) ?  $src : $src="../../img/image/bnt-browse.png";
                    #echo $src;
                  ?>
                  <tr>
                    <td align="center" valign="top">
                    	<input type="checkbox" name="txt_no[]" id="txt_no_<?=$i?>" value="<?=$id?>" />
                        <input type="hidden" name="txt_Order[]" id="txt_Order_<?=$i?>" value="<?=$id?>" />
                    </td>
                    <td align="center" valign="top"><?=$row_id?></td>
                    <td align="center" valign="top"><img src="<?=$src?>" width="50" class="img-rounded"></td>
                    <td align="center" valign="top"><?=$rs[_TABLE_PERMISSION_."_Title"]?></td>
                    <td align="center" valign="top"><?=$rs[_TABLE_."_Username"]?></td>
                    <td align="center" valign="top"><?=$rs[_TABLE_."_Firstname"]?></td>
                    <td align="center" valign="top"><?=$rs[_TABLE_."_Lastname"]?></td>
                    <td align="center" valign="top"><?=$rs[_TABLE_."_Email"]?></td>
                    <td align="center" valign="top">
                        <div class="btn-group">
                          <?
                          if($rs[_TABLE_."_Status"] == "Enable") $class = "btn-default"; else $class = "btn-warning";
                          ?>
                          <a class="btn <?=$class?>" href="javascript:void(0);" onclick="js_main_enable(this,'<?=$this_path?>','id=<?=$id?>&page=<?=$page?>')"><?=$rs[_TABLE_."_Status"]?></a>
                        </div>
    
                        <!-- Split button -->
                        <div class="btn-group">
                          <button type="button" class="btn btn-default"><?=$Mod_Text["bnt_Action"] ?></button>
                          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                          </button>
                          <ul class="dropdown-menu">
                            <li><a href='javascript:js_load_page($("#area_data") ,"<?=$this_path?>" , "action=Add&id=<?=$id?>");'>
                            <i class="icon-pencil"></i>
                            <?=$Mod_Text["edit_data"]?>
                            </a></li>
                            <li><a href="javascript:void(0);" onClick=" if (confirm('<?=$Mod_Text["Delete_Form"]?>')) {  js_main_delete('<?=$this_path?>','id=<?=$id?>&page=<?=$page?>'); }">
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