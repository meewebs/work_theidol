<?php
include_once("../../lib/session.php");
header("Content-type: text/html; charset=UTF-8");
include_once("../../lib/config.php");
include_once("../../lib/function.php");
include_once("../sys_load/lang/".$_Language.".php");
include_once("lang/".$_Language.".php");
include_once("config.php");

$this_path = "../"._THIS_."/index_form.php";

if($_SESSION["_Language"] == "en"){
	$ch 	= "En";	
}else{
	$ch	= "";	
}

if($action == "SaveAdd"){
	
	#print_r($_POST);
	$m_main = "";
	if($txt_Mainmenu){
		
		$i = 0;
		foreach($txt_Mainmenu as $main){
			$m_main .= $main.",".$txt_Mainstatus[$i]."|";
			$i++;
		}
		
	}
	
	
	$s_main = "";
	if($txt_Mainmenu){
		
		$i = 0;
		foreach($txt_Submenu as $sub){
			$s_main .= $sub.",".$txt_Substatus[$i]."|";
			$i++;
		}
		
	}
	
	#echo $m_main."<br>".$s_main;	
	#exit();
	
	if($id){

		$update 	= "";
		$update[] = _TABLE_."_Title 				= '".$txt_Title."'";
		$update[] = _TABLE_."_Menu 				= '".$m_main."'";
		$update[] = _TABLE_."_MenuSub 		= '".$s_main."'";
		
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
		$insert[_TABLE_."_Title"] 					= "'".$txt_Title."'";
		$insert[_TABLE_."_Menu"] 					= "'".$m_main."'";
		$insert[_TABLE_."_MenuSub"] 			= "'".$s_main."'";
		
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
	
	$sql = "DELETE FROM "._TABLE_." WHERE "._TABLE_."_ID = '$id'";
	if(mysql_query($sql)) echo "OK";
	else echo "Fail";
	exit();
	
}else if($action == "DeleteAll"){

	$count_row = count($txt_no);
	for($i = 0;$i<$count_row;$i++){
		
		$id 			= $txt_no[$i];
		
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
			$sql 					= " SELECT * FROM "._TABLE_." WHERE "._TABLE_."_ID = $id ";	
			$result 				= mysql_query($sql);
			$rs					= mysql_fetch_assoc($result);
			
			$main_menu	= explode("|",$rs[_TABLE_."_Menu"]);
			$sub_menu		= explode("|",$rs[_TABLE_."_MenuSub"]);
		}
?>
		<div id="area_input">
    	<form id="myForm" name="myForm" enctype="multipart/form-data" method="post" class="form-horizontal" ng-submit="submit()" ng-controller="js_Save">
          <input name="id" id="id" type="hidden" value="<?=$id?>" />
          
          <div class="control-group">
            <label class="control-label" for="txt_Title"><?=$Mod_Field["txt_Title"]?></label>
            <div class="controls">
              <input type="text" id="txt_Title" name="txt_Title" placeholder="<?=$Mod_Field["txt_Title"]?>" value="<?=$rs[_TABLE_."_Title"]?>" required="required">
            </div>
          </div>
          
          
          <!-- management permission -->
          <div class="control-group">
          <?

             $sql  = 	" SELECT * ".
                            " FROM "._TABLE_MENU_.
                            " WHERE "._TABLE_MENU_."_Status = 'Enable' ";
             $sql .= 	" ORDER BY  IF("._TABLE_MENU_."_Order > 0 , "._TABLE_MENU_."_Order , "._TABLE_MENU_."_ID )  DESC ";
	
             #echo $sql;
             $result	 	=	mysql_query($sql);
             $i 			= 0;
			 
			 while($rs = mysql_fetch_assoc($result)){
				 
				$id 							= $rs[_TABLE_MENU_."_ID"];
				$row_id					=	substr('0000'.$id,-4);
				
				$bnt_class_left	 		= "btn-default";
				$bnt_class_right	 	= "btn-default";
				
				if($main_menu){
					
					foreach($main_menu as $arr_main){
						
						$my_menu = explode(",",$arr_main);
						if($my_menu[0] == $id){
							
							if($my_menu[1] == "on"){
								$bnt_class_left 	= "btn-success";
								$bnt_class_right 	= "btn-default";
							}else{
								$bnt_class_left 	= "btn-default";
								$bnt_class_right 	= "btn-danger";
							}
							
							break;
								
						}
						
					}#end foreach
					
				}#end if menu

             ?>
             <table width="100%" border="0" cellspacing="2" cellpadding="2" class="table table-bordered table-hover">
              <tr class="myStorng">
                <td width="10%"><?=$Mod_Field["txt_Menu"]?></td>
                <td width="74%"><?=$Mod_Field["txt_Menuname"]?></td>
                <td width="16%"><?=$Mod_Text["bnt_Action"] ?></td>
              </tr>
              <tr>
                <td><?=$Mod_Field["txt_Mainmenu"]?></td>
                <td><i class="<?=$rs[_TABLE_MENU_."_Icon"]?>"></i> <?=$rs[_TABLE_MENU_."_Title".$ch]?></td>
                <td>
                	
                    <input name="txt_Mainmenu[]" type="hidden" value="<?=$id?>" />
                    <input name="txt_Mainstatus[]" id="txt_Mainstatus_<?=$id?>"  type="hidden" value="<?=$my_menu[1]?>" />
                	<div class="btn-group">
                       
                       <button type="button" id="bnt_on_<?=$id?>" onclick="js_onoff('main','on','<?=$id?>');" class="btn <?=$bnt_class_left?>"><?=$Mod_Field["txt_Open"]?></button>
                       <button type="button" id="bnt_off_<?=$id?>" onclick="js_onoff('main','off','<?=$id?>');" class="btn <?=$bnt_class_right?>"><?=$Mod_Field["txt_Close"]?></button>
                    </div>
                </td>
              </tr>
              
              <?
				$sql_sub 		= 	" SELECT * FROM "._TABLE_SUB_.
										" WHERE "._TABLE_SUB_."_MenuID = '$id' ";
				$sql_sub 	   .= 	" ORDER BY  IF("._TABLE_SUB_."_Order > 0 , "._TABLE_SUB_."_Order , "._TABLE_SUB_."_ID )  DESC ";
				$result_sub 	= mysql_query($sql_sub);
				while($rs_sub = mysql_fetch_assoc($result_sub)){
						  
					$sub_id	= $rs_sub[_TABLE_SUB_."_ID"];
					
					$bnt_class_sub_left 	= "btn-default";
					$bnt_class_sub_right 	= "btn-default";
					
					if($sub_menu){
					
						foreach($sub_menu as $arr_sub){
						
							$my_submenu = explode(",",$arr_sub);
							if($my_submenu[0] == $sub_id){
								
								if($my_submenu[1] == "on"){
									$bnt_class_sub_left 	= "btn-success";
									$bnt_class_sub_right 	= "btn-default";
								}else{
									$bnt_class_sub_left 	= "btn-default";
									$bnt_class_sub_right 	= "btn-danger";
								}
								
								break;
									
							}
							
						}#end foreach
						
					}#end if menu
				
				
			  ?>
                    
              <tr class="txt_permission_write">
                <td><?=$Mod_Field["txt_Submenu"]?></td>
                <td><i class="<?=$rs_sub[_TABLE_SUB_."_Icon"]?>"></i> <?=$rs_sub[_TABLE_SUB_."_Title".$ch]?></td>
                <td>
                	<input name="txt_Submenu[]" type="hidden" value="<?=$sub_id?>" />
                    <input name="txt_Substatus[]" id="txt_Substatus_<?=$sub_id?>"  type="hidden" value="<?=$my_submenu[1]?>" />
                	<div class="btn-group">
                       <button type="button" id="bnt_sub_on_<?=$sub_id?>" onclick="js_onoff('sub','on','<?=$sub_id?>');" class="btn <?=$bnt_class_sub_left?>"><?=$Mod_Field["txt_Open"]?></button>
                       <button type="button" id="bnt_sub_off_<?=$sub_id?>" onclick="js_onoff('sub','off','<?=$sub_id?>');" class="btn <?=$bnt_class_sub_right?>"><?=$Mod_Field["txt_Close"]?></button>
                    </div>
                </td>
              </tr>
              <?
				}#end while
			  ?>
            </table>
            <?
			 }
			?>
          </div>
          <!-- ./ management permission -->
          
          
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
            <h3 class="panel-title"><?=$Mod_Field["txt_MainMod"]?></h3>
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
                  <tr class="myStorng">
                    <td width="3%" align="center" valign="top"><input type="checkbox" name="txt_All" id="txt_All" onclick="js_main_select_all(this);" /></td>
                    <td width="10%" align="center" valign="top">No</td>
                    <td width="65%" align="center" valign="top"><a href="javascript:js_main_search($('#area_panel') , '<?=$this_path?>' ,'&reorder=_Title');"><?=$Mod_Field["txt_Title"]?></a> 
                    <?
                    if($reorder == "_Title"){
                        
                        if($order == "ASC") echo '<span class="badge"><i class="icon-thumbs-up icon-white"></i></span>';
                        else echo '<span class="badge"><i class="icon-thumbs-down icon-white"></i></span>';
                    }
                    ?>
                    
                    </td>
                    <td width="22%" align="center" valign="top"><?=$Mod_Text["Tool"]?></td>
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
                    <td align="center" valign="top"><?=$rs[_TABLE_."_Title"]?></td>
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