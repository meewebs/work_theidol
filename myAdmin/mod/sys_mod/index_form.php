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
		$update[] = _TABLE_."_Image 			= '".$txt_Image."'";
		$update[] = _TABLE_."_Mod 				= '".$txt_Mod."'";
		$update[] = _TABLE_."_Title 				= '".$txt_Title."'";
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
		$insert[_TABLE_."_Image"] 					= "'".$txt_Image."'";
		$insert[_TABLE_."_Mod"] 					= "'".$txt_Mod."'";
		$insert[_TABLE_."_Title"] 					= "'".$txt_Title."'";
		
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
	
}else if($action == "SelectMod"){
	
	
	$dir="../../mod/";
	if (is_dir($dir)) {
		if ($dh = opendir($dir)) {
			while (($file = readdir($dh)) !== false) {
				if($file != "." && $file != ".."){
				    $my_file_type = filetype($dir . $file);
					if($my_file_type === "dir")
					{
						$my_dir = $dir.$file."/";
					?>
						<a href="javascript:void(0)" onclick="file_list('<?=$my_dir?>','<?=$this_path?>');" ><i class="icon-folder-open"></i> <?=$file?></a><br>
					<?
                    }
				}
			}
			closedir($dh);
		}
	}
	
	exit();
	
}else if($action == "SelectFile"){
	
?>
    <a href="javascript:void(0);" class="btn" onclick="load_mod('<?=$this_path?>');" ><i class="icon-folder-open"></i> Up folder</a>
    <br>
<?
	
	if (is_dir($dir)) {
		if ($dh = opendir($dir)) {
			while (($file = readdir($dh)) !== false) {
				if($file != "." && $file != ".."){
				    $my_file_type = filetype($dir . $file);
					#echo "$file : filetype: " . filetype($dir . $file) . "\n<br>";
					if($my_file_type === "file")
					{
						$my_dir = $dir.$file;
					?>
						<a href="javascript:void(0);" onclick="select_Items('<?=$my_dir?>');"><i class="icon-file"></i><?=$file?></a><br>
					<?
                    }
				}
			}
			closedir($dh);
		}
	}
	
	exit();
	
}
?>
<link href="../../css/css.css" rel="stylesheet" type="text/css" />
<!--<script src="../../lib/jquery.js"></script>-->
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
			
			$txt_Image	=	$rs[_TABLE_."_Image"];
			
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
            <label class="control-label" for="txt_Title"><?=$Mod_Field["txt_Title"]?></label>
            <div class="controls">
              <input type="text" id="txt_Title" name="txt_Title" placeholder="<?=$Mod_Field["txt_Title"]?>" value="<?=$rs[_TABLE_."_Title"]?>" required="required">
            </div>
          </div>
          
          <div class="control-group">
            <label class="control-label" for="txt_Title"><?=$Mod_Field["txt_Mod"]?></label>
            <div class="controls">
              <input type="text" id="txt_Mod" name="txt_Mod" placeholder="<?=$Mod_Field["txt_Mod"]?>" value="<?=$rs[_TABLE_."_Mod"]?>" required="required"> 
              <a href="#myModal" role="button" class="btn btn-primary" data-toggle="modal" onclick="load_mod('<?=$this_path?>');"><?=$Mod_Field["txt_Select"]?></a>
 
                <!-- Modal -->
                  <div class="modal fade" id="myModal">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title">Select module</h4>
                        </div>
                        
                        <div class="modal-body" id="area_file">
                          <!-- Content -->
                          <!-- /.Content -->
                        </div>
                        
                      </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                  </div><!-- /.modal -->
              
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
            <h3 class="panel-title"><?=$Mod_Text["create_mod"]?></h3>
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
                            " WHERE 1=1 ";
            
             if($txt_Search){
				 
                $sql .= " AND ( "._TABLE_."_Title like'%$txt_Search%' ";
                $sql .= " OR "._TABLE_."_Code like '%$txt_Search%' ";
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
                    <td width="3%" align="center" valign="top"><input type="checkbox" name="txt_All" id="txt_All" onclick="js_main_select_all(this);" /></td>
                    <td width="6%" align="center" valign="top">No</td>
                    <td width="11%" align="center" valign="top"><?=$Mod_Field["txt_Img"]?></td>
                    <td width="21%" align="center" valign="top"><a href="javascript:js_main_search($('#area_panel') , '<?=$this_path?>' ,'&reorder=_Title');"><?=$Mod_Field["txt_Title"]?></a> 
                    <?
                    if($reorder == "_Title"){
                        
                        if($order == "ASC") echo '<span class="badge"><i class="icon-thumbs-up icon-white"></i></span>';
                        else echo '<span class="badge"><i class="icon-thumbs-down icon-white"></i></span>';
                    }
                    ?>
                    
                    </td>
                    <td width="38%" align="center" valign="top"><a href="javascript:js_main_search($('#area_panel') , '<?=$this_path?>' ,'&reorder=_Mod');"><?=$Mod_Field["txt_Mod"]?></a>
                    <?
                    if($reorder == "_Mod"){
                        
                        if($order == "ASC") echo '<span class="badge"><i class="icon-thumbs-up icon-white"></i></span>';
                        else echo '<span class="badge"><i class="icon-thumbs-down icon-white"></i></span>';
                    }
                    ?>
                    </td>
                    <td width="21%" align="center" valign="top"><?=$Mod_Text["Tool"]?></td>
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
                    <td align="center" valign="top"><img src="<?=$src?>" width="80" class="img-rounded"></td>
                    <td align="center" valign="top"><?=$rs[_TABLE_."_Title"]?></td>
                    <td align="center" valign="top"><?=$rs[_TABLE_."_Mod"]?></td>
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