<?php
include_once("../../lib/session.php");
//header("Content-type: text/html; charset=UTF-8");
include_once("../../lib/config.php");
include_once("../sys_load/lang/".$_Language.".php");
include_once("../sys_menu/config.php");

if($_SESSION["Like_ID"]){

	if($_SESSION["_Language"] == "en"){
		$ch 	= "En";	
	}else{
		$ch	= "";	
	}
	
	
	if($_SESSION["Like_Level"] == "All_Level") $pass = true; else $pass = false;
	
	if(!$pass){
		
		$sql 					= " SELECT * FROM "._TABLE_PERMISSION_." WHERE "._TABLE_PERMISSION_."_ID = '".$_SESSION["Like_Level"]."' ";	
		$result 				= mysql_query($sql);
		$rs					= mysql_fetch_assoc($result);
		
		$main_menu	= explode("|",$rs[_TABLE_PERMISSION_."_Menu"]);
		$sub_menu		= explode("|",$rs[_TABLE_PERMISSION_."_MenuSub"]);
			
	}
?>

    <div class="well sidebar-nav">
        <ul class="nav nav-list" style="padding:0px;">
          <?php
         $sql  = 	" SELECT * ".
                        " FROM "._TABLE_.
                        " WHERE "._TABLE_."_Status = 'Enable' ";
         $sql .= 	" ORDER BY  IF("._TABLE_."_Order > 0 , "._TABLE_."_Order , "._TABLE_."_ID )  DESC ";
        
         #echo $sql;
         $result	 	= mysql_query($sql);
         while($rs = mysql_fetch_assoc($result)){
             
             $id 					= $rs[_TABLE_."_ID"];
             $menu_name	= $rs[_TABLE_."_Title".$ch];
			 
			 
			 /* main menu level show/hide */
				if($main_menu){
					
					foreach($main_menu as $arr_main){
						$main_show = false;
						$my_menu = explode(",",$arr_main);
						if($my_menu[0] == $id){
							
							if($my_menu[1] == "on"){
								$main_show 	= true;
							}else{
								$main_show 	= false;
							}
							break;
							
								
						}
						
					}#end foreach
					
				}#end if menu
				
				/* ./ main menu level show/hide */
				
				if($main_show || $pass){
             
					$sql_sub 		= 	" SELECT * FROM "._TABLE_SUB_.
											" LEFT JOIN "._TABLE_MOD_." ON "._TABLE_MOD_."_ID = "._TABLE_SUB_."_ModID ".
											" WHERE "._TABLE_SUB_."_MenuID = '$id' ".
											" AND "._TABLE_SUB_."_Status = 'Enable' ";
					$sql_sub 	   .= 	" ORDER BY  IF("._TABLE_SUB_."_Order > 0 , "._TABLE_SUB_."_Order , "._TABLE_SUB_."_ID )  DESC ";
					$result_sub 	= mysql_query($sql_sub);
					
          ?>
          <li class="nav-header"><?=$menu_name?></li>
          
          <?
				}#end if main show;
				
				while($rs_sub 	= mysql_fetch_assoc($result_sub)){	  
					$sub_id		= $rs_sub[_TABLE_SUB_."_ID"];
					$url				= $rs_sub[_TABLE_MOD_."_Mod"];
					$sub_name	= $rs_sub[_TABLE_SUB_."_Title".$ch];
					
					/* level sub */
					if($sub_menu){
					
						foreach($sub_menu as $arr_sub){
							$sub_show = false;
							$my_submenu = explode(",",$arr_sub);
							if($my_submenu[0] == $sub_id){
								
								if($my_submenu[1] == "on"){
									$sub_show = true;
								}else{
									$sub_show = false;
								}
								break;
									
							}
							
						}#end foreach
						
					}#end if menu
					
					/* ./level sub */
					
								
					if($sub_show  || $pass){
          ?>
              			<li><a href='javascript:js_load_page($("#area_panel") , "<?=$url?>" , "action=View&menu_id=<?=$id?>&s_menu=<?=$sub_id?>");'><i class="<?=$rs_sub[_TABLE_SUB_."_Icon"]?>"></i> <?=$sub_name?></a></li>
          <?
                	}#end sub
					
				}#end show show;
				
         	}#end main
          ?>
      
    </ul>
</div><!--/.well -->

<?
}//End if session id
?>