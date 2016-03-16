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
		$update[] = _TABLE_."_Title 				= '".$txt_Title."'";
		$update[] = _TABLE_."_TitleEn 			= '".$txt_TitleEn."'";
		$update[] = _TABLE_."_Icon 				= '".$txt_Icon."'";
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
		$insert[_TABLE_."_TitleEn"] 				= "'".$txt_TitleEn."'";
		$insert[_TABLE_."_Icon"] 					= "'".$txt_Icon."'";
		
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
	

}else if($action == "SaveAddSub"){
	
	#print_r($_POST);
	
	if($id){

		$update 	= "";
		$update[] = _TABLE_SUB_."_MenuID 			= '".$menu_id."'";
		$update[] = _TABLE_SUB_."_ModID 			= '".$txt_Modhide."'";
		$update[] = _TABLE_SUB_."_Title 				= '".$txt_Title."'";
		$update[] = _TABLE_SUB_."_TitleEn 			= '".$txt_TitleEn."'";
		$update[] = _TABLE_SUB_."_Icon 				= '".$txt_Icon."'";
		
		$update[] = _TABLE_SUB_."_LastUpdate 	= NOW()";
		
		$sql	=	"UPDATE "._TABLE_SUB_." SET ".implode(",",$update)." WHERE "._TABLE_SUB_."_ID = '$id' ";
		#echo $sql;
		if(mysql_query($sql)){
			$return = "OK";
		}else{
			$return = "Fail";
		}	
		echo $return;
		
	}else{
		
		$insert = "";
		$insert[_TABLE_SUB_."_MenuID"] 				= "'".$menu_id."'";
		$insert[_TABLE_SUB_."_ModID"] 				= "'".$txt_Modhide."'";
		$insert[_TABLE_SUB_."_Title"] 					= "'".$txt_Title."'";
		$insert[_TABLE_SUB_."_TitleEn"] 				= "'".$txt_TitleEn."'";
		$insert[_TABLE_SUB_."_Icon"] 					= "'".$txt_Icon."'";
		
		$insert[_TABLE_SUB_."_CreateDate"] 		= "NOW()";
		$insert[_TABLE_SUB_."_LastUpdate"] 		= "NOW()";
		$insert[_TABLE_SUB_."_PrivateIP"] 			= "'".php_getPrivateIP()."'";
		$insert[_TABLE_SUB_."_IP"] 						= "'".php_getIP()."'";
		
		$sql	=	" INSERT INTO "._TABLE_SUB_."(".implode(",",array_keys($insert)).") VALUES (".implode(",",array_values($insert)).")";
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
	
	$sql = "DELETE FROM "._TABLE_SUB_." WHERE "._TABLE_SUB_."_MenuID = '$id'";
	mysql_query($sql);
	
	$sql = "DELETE FROM "._TABLE_." WHERE "._TABLE_."_ID = '$id'";
	if(mysql_query($sql)) echo "OK";
	else echo "Fail";
	exit();
	
}else if($action == "DeleteSub"){		
	
	$sql = "DELETE FROM "._TABLE_SUB_." WHERE "._TABLE_SUB_."_ID = '$id'";
	if(mysql_query($sql)) echo "OK";
	else echo "Fail";
	exit();
	
	
}else if($action == "enableDisable"){		
	
	$update 	 	= "";
	$update[] 	= _TABLE_."_Status = '$nextStatus'";
	$sql				= "UPDATE "._TABLE_." SET ".implode(",",$update)." WHERE "._TABLE_."_ID='$id' ";

	#echo $sql;
	if(mysql_query($sql)) echo "OK";
	else echo "Fail";
	
	exit();
	
}else if($action == "enableDisableSub"){		
	
	$update 	 	= "";
	$update[] 	= _TABLE_SUB_."_Status = '$nextStatus'";
	$sql				= "UPDATE "._TABLE_SUB_." SET ".implode(",",$update)." WHERE "._TABLE_SUB_."_ID = '$id' ";

	#echo $sql;
	if(mysql_query($sql)) echo "OK";
	else echo "Fail";
	
	exit();

	
}else if($action == "Sorting"){
	
	//print_r($_POST);
	if($txt_Order){
		
		$arr_order = explode(":",$txt_Order);
		//print_r($arr_order);
		foreach($arr_order as $val1){
			
			$arr_menu 	= explode("|",$val1);
			$row 			= count($arr_menu);
			#print_r($arr_menu);
			if($arr_menu[0]){
				#echo $arr_menu[0];
				$my_menu[] 		= $arr_menu[0];
				$my_submenu[]	= $arr_menu[1];
			}

			
		}
		
		#print_r($my_menu);
		#print_r($my_submenu);
		#exit();
		$count_order 	= count($my_menu);
		$i = 0;
		foreach($my_menu as $val){
			
			$order 		= $count_order - $i;
			$update 	= "";
			$update[] = _TABLE_."_Order = '$order' ";
			$sql 			=	"UPDATE "._TABLE_." SET ".implode(",",$update)." WHERE "._TABLE_."_ID = '{$val}' ";
			#echo $sql;
			mysql_query($sql);
			
			
			$j = 0;
			$_submenu				= explode(",",$my_submenu[$i]);
			#print_r($_submenu);
			$count_sub_menu 	= count($_submenu);
			#echo $count_sub_menu;
			if($count_sub_menu > 0){
				foreach($_submenu as $sub_id){
					
					if($sub_id){
						$sub_order 		= $count_sub_menu - $j;
						$update 			= "";
						$update[] 		= _TABLE_SUB_."_MenuID = '{$val}' ";
						$update[] 		= _TABLE_SUB_."_Order = '$sub_order' ";
						$sql 					=	"UPDATE "._TABLE_SUB_." SET ".implode(",",$update)." WHERE "._TABLE_SUB_."_ID = '{$sub_id}' ";
						#echo $sql."<br>";
						mysql_query($sql);
						$j++;	
					}
				}
			}
			
			$i++;
			
		}
		
		
		
	}
	
	echo "OK";
	
	exit();
	
}else if($action == "SelectIcon"){
	
?>
	
    <div class="row">
      <div class="col-lg-6">
      	<ul class="the-icons">
            <li><a href="javascript:js_select_icon('icon-glass');"><i class="icon-glass"></i> icon-glass</a></li>
            <li><a href="javascript:js_select_icon('icon-music');"><i class="icon-music"></i> icon-music</a></li>
            <li><a href="javascript:js_select_icon('icon-search');"><i class="icon-search"></i> icon-search</a></li>
            <li><a href="javascript:js_select_icon('icon-envelope');"><i class="icon-envelope"></i> icon-envelope</a></li>
            <li><a href="javascript:js_select_icon('icon-heart');"><i class="icon-heart"></i> icon-heart</a></li>
            <li><a href="javascript:js_select_icon('icon-star');"><i class="icon-star"></i> icon-star</a></li>
            <li><a href="javascript:js_select_icon('icon-star-empty');"><i class="icon-star-empty"></i> icon-star-empty</a></li>
            <li><a href="javascript:js_select_icon('icon-user');"><i class="icon-user"></i> icon-user</a></li>
            <li><a href="javascript:js_select_icon('icon-film');"><i class="icon-film"></i> icon-film</a></li>
            <li><a href="javascript:js_select_icon('icon-th-large');"><i class="icon-th-large"></i> icon-th-large</a></li>
            <li><a href="javascript:js_select_icon('icon-th');"><i class="icon-th"></i> icon-th</a></li>
            <li><a href="javascript:js_select_icon('icon-th-list');"><i class="icon-th-list"></i> icon-th-list</a></li>
            <li><a href="javascript:js_select_icon('icon-ok');"><i class="icon-ok"></i> icon-ok</a></li>
            <li><a href="javascript:js_select_icon('icon-remove');"><i class="icon-remove"></i> icon-remove</a></li>
            <li><a href="javascript:js_select_icon('icon-zoom-in');"><i class="icon-zoom-in"></i> icon-zoom-in</a></li>
            <li><a href="javascript:js_select_icon('icon-zoom-out');"><i class="icon-zoom-out"></i> icon-zoom-out</a></li>
            <li><a href="javascript:js_select_icon('icon-off');"><i class="icon-off"></i> icon-off</a></li>
            <li><a href="javascript:js_select_icon('icon-signal');"><i class="icon-signal"></i> icon-signal</a></li>
            <li><a href="javascript:js_select_icon('icon-cog');"><i class="icon-cog"></i> icon-cog</a></li>
            <li><a href="javascript:js_select_icon('icon-trash');"><i class="icon-trash"></i> icon-trash</a></li>
            <li><a href="javascript:js_select_icon('icon-home');"><i class="icon-home"></i> icon-home</a></li>
            <li><a href="javascript:js_select_icon('icon-file');"><i class="icon-file"></i> icon-file</a></li>
            <li><a href="javascript:js_select_icon('icon-time');"><i class="icon-time"></i> icon-time</a></li>
            <li><a href="javascript:js_select_icon('icon-road');"><i class="icon-road"></i> icon-road</a></li>
            <li><a href="javascript:js_select_icon('icon-download-alt');"><i class="icon-download-alt"></i> icon-download-alt</a></li>
            <li><a href="javascript:js_select_icon('icon-download');"><i class="icon-download"></i> icon-download</a></li>
            <li><a href="javascript:js_select_icon('icon-upload');"><i class="icon-upload"></i> icon-upload</a></li>
            <li><a href="javascript:js_select_icon('icon-inbox');"><i class="icon-inbox"></i> icon-inbox</a></li>
            <li><a href="javascript:js_select_icon('icon-question-sign');"><i class="icon-question-sign"></i> icon-question-sign</a></li>
            <li><a href="javascript:js_select_icon('icon-info-sign');"><i class="icon-info-sign"></i> icon-info-sign</a></li>
            <li><a href="javascript:js_select_icon('icon-screenshot');"><i class="icon-screenshot"></i> icon-screenshot</a></li>
            <li><a href="javascript:js_select_icon('icon-remove-circle');"><i class="icon-remove-circle"></i> icon-remove-circle</a></li>
            <li><a href="javascript:js_select_icon('icon-ok-circle');"><i class="icon-ok-circle"></i> icon-ok-circle</a></li>
            <li><a href="javascript:js_select_icon('icon-ban-circle');"><i class="icon-ban-circle"></i> icon-ban-circle</a></li>
            <li><a href="javascript:js_select_icon('icon-arrow-left');"><i class="icon-arrow-left"></i> icon-arrow-left</a></li>
            <li><a href="javascript:js_select_icon('icon-arrow-right');"><i class="icon-arrow-right"></i> icon-arrow-right</a></li>
            <li><a href="javascript:js_select_icon('icon-arrow-up');"><i class="icon-arrow-up"></i> icon-arrow-up</a></li>
            <li><a href="javascript:js_select_icon('icon-arrow-down');"><i class="icon-arrow-down"></i> icon-arrow-down</a></li>
            <li><a href="javascript:js_select_icon('icon-share-alt');"><i class="icon-share-alt"></i> icon-share-alt</a></li>
            <li><a href="javascript:js_select_icon('icon-resize-full');"><i class="icon-resize-full"></i> icon-resize-full</a></li>
            <li><a href="javascript:js_select_icon('icon-resize-small');"><i class="icon-resize-small"></i> icon-resize-small</a></li>
            <li><a href="javascript:js_select_icon('icon-plus');"><i class="icon-plus"></i> icon-plus</a></li>
            <li><a href="javascript:js_select_icon('icon-minus');"><i class="icon-minus"></i> icon-minus</a></li>
            <li><a href="javascript:js_select_icon('icon-asterisk');"><i class="icon-asterisk"></i> icon-asterisk</a></li>
            <li><a href="javascript:js_select_icon('icon-exclamation-sign');"><i class="icon-exclamation-sign"></i> icon-exclamation-sign</a></li>
            <li><a href="javascript:js_select_icon('icon-gift');"><i class="icon-gift"></i> icon-gift</a></li>
            <li><a href="javascript:js_select_icon('icon-leaf');"><i class="icon-leaf"></i> icon-leaf</a></li>
            <li><a href="javascript:js_select_icon('icon-fire');"><i class="icon-fire"></i> icon-fire</a></li>
            <li><a href="javascript:js_select_icon('icon-eye-open');"><i class="icon-eye-open"></i> icon-eye-open</a></li>
            <li><a href="javascript:js_select_icon('icon-eye-close');"><i class="icon-eye-close"></i> icon-eye-close</a></li>
            <li><a href="javascript:js_select_icon('icon-warning-sign');"><i class="icon-warning-sign"></i> icon-warning-sign</a></li>
            <li><a href="javascript:js_select_icon('icon-plane');"><i class="icon-plane"></i> icon-plane</a></li>
            <li><a href="javascript:js_select_icon('icon-calendar');"><i class="icon-calendar"></i> icon-calendar</a></li>
            <li><a href="javascript:js_select_icon('icon-random');"><i class="icon-random"></i> icon-random</a></li>
            <li><a href="javascript:js_select_icon('icon-comment');"><i class="icon-comment"></i> icon-comment</a></li>
            <li><a href="javascript:js_select_icon('icon-magnet');"><i class="icon-magnet"></i> icon-magnet</a></li>
            <li><a href="javascript:js_select_icon('icon-indent-left');"><i class="icon-indent-left"></i> icon-indent-left</a></li>
            <li><a href="javascript:js_select_icon('icon-indent-right');"><i class="icon-indent-right"></i> icon-indent-right</a></li>
            <li><a href="javascript:js_select_icon('icon-facetime-video');"><i class="icon-facetime-video"></i> icon-facetime-video</a></li>
            <li><a href="javascript:js_select_icon('icon-picture');"><i class="icon-picture"></i> icon-picture</a></li>
            <li><a href="javascript:js_select_icon('icon-pencil');"><i class="icon-pencil"></i> icon-pencil</a></li>
            <li><a href="javascript:js_select_icon('icon-map-marker');"><i class="icon-map-marker"></i> icon-map-marker</a></li>
            <li><a href="javascript:js_select_icon('icon-adjust');"><i class="icon-adjust"></i> icon-adjust</a></li>
            <li><a href="javascript:js_select_icon('icon-tint');"><i class="icon-tint"></i> icon-tint</a></li>
            <li><a href="javascript:js_select_icon('icon-edit');"><i class="icon-edit"></i> icon-edit</a></li>
            <li><a href="javascript:js_select_icon('icon-share');"><i class="icon-share"></i> icon-share</a></li>
            <li><a href="javascript:js_select_icon('icon-check');"><i class="icon-check"></i> icon-check</a></li>
            <li><a href="javascript:js_select_icon('icon-move');"><i class="icon-move"></i> icon-move</a></li>
            <li><a href="javascript:js_select_icon('icon-step-backward');"><i class="icon-step-backward"></i> icon-step-backward</a></li>
            <li><a href="javascript:js_select_icon('icon-fast-backward');"><i class="icon-fast-backward"></i> icon-fast-backward</a></li>
  
       </ul>
      </div>
      <div class="col-lg-6">
      	<ul class="the-icons">
        	<li><a href="javascript:js_select_icon('icon-backward');"><i class="icon-backward"></i> icon-backward</a></li>
        	<li><a href="javascript:js_select_icon('icon-play-circle');"><i class="icon-play-circle"></i> icon-play-circle</a></li>
            <li><a href="javascript:js_select_icon('icon-repeat');"><i class="icon-repeat"></i> icon-repeat</a></li>
            <li><a href="javascript:js_select_icon('icon-refresh');"><i class="icon-refresh"></i> icon-refresh</a></li>
            <li><a href="javascript:js_select_icon('icon-list-alt');"><i class="icon-list-alt"></i> icon-list-alt</a></li>
            <li><a href="javascript:js_select_icon('icon-lock');"><i class="icon-lock"></i> icon-lock</a></li>
            <li><a href="javascript:js_select_icon('icon-flag');"><i class="icon-flag"></i> icon-flag</a></li>
            <li><a href="javascript:js_select_icon('icon-headphones');"><i class="icon-headphones"></i> icon-headphones</a></li>
            <li><a href="javascript:js_select_icon('icon-volume-off');"><i class="icon-volume-off"></i> icon-volume-off</a></li>
            <li><a href="javascript:js_select_icon('icon-volume-down');"><i class="icon-volume-down"></i> icon-volume-down</a></li>
            <li><a href="javascript:js_select_icon('icon-volume-up');"><i class="icon-volume-up"></i> icon-volume-up</a></li>
            <li><a href="javascript:js_select_icon('icon-qrcode');"><i class="icon-qrcode"></i> icon-qrcode</a></li>
            <li><a href="javascript:js_select_icon('icon-barcode');"><i class="icon-barcode"></i> icon-barcode</a></li>
            <li><a href="javascript:js_select_icon('icon-tag');"><i class="icon-tag"></i> icon-tag</a></li>
            <li><a href="javascript:js_select_icon('icon-tags');"><i class="icon-tags"></i> icon-tags</a></li>
            <li><a href="javascript:js_select_icon('icon-book');"><i class="icon-book"></i> icon-book</a></li>
            <li><a href="javascript:js_select_icon('icon-bookmark');"><i class="icon-bookmark"></i> icon-bookmark</a></li>
            <li><a href="javascript:js_select_icon('icon-print');"><i class="icon-print"></i> icon-print</a></li>
            <li><a href="javascript:js_select_icon('icon-camera');"><i class="icon-camera"></i> icon-camera</a></li>
            <li><a href="javascript:js_select_icon('icon-font');"><i class="icon-font"></i> icon-font</a></li>
            <li><a href="javascript:js_select_icon('icon-bold');"><i class="icon-bold"></i> icon-bold</a></li>
            <li><a href="javascript:js_select_icon('icon-italic');"><i class="icon-italic"></i> icon-italic</a></li>
            <li><a href="javascript:js_select_icon('icon-text-height');"><i class="icon-text-height"></i> icon-text-height</a></li>
            <li><a href="javascript:js_select_icon('icon-text-width');"><i class="icon-text-width"></i> icon-text-width</a></li>
            <li><a href="javascript:js_select_icon('icon-align-left');"><i class="icon-align-left"></i> icon-align-left</a></li>
            <li><a href="javascript:js_select_icon('icon-align-center');"><i class="icon-align-center"></i> icon-align-center</a></li>
            <li><a href="javascript:js_select_icon('icon-align-right');"><i class="icon-align-right"></i> icon-align-right</a></li>
            <li><a href="javascript:js_select_icon('icon-align-justify');"><i class="icon-align-justify"></i> icon-align-justify</a></li>
            <li><a href="javascript:js_select_icon('icon-list');"><i class="icon-list"></i> icon-list</a></li>
            <li><a href="javascript:js_select_icon('icon-chevron-up');"><i class="icon-chevron-up"></i> icon-chevron-up</a></li>
            <li><a href="javascript:js_select_icon('icon-chevron-down');"><i class="icon-chevron-down"></i> icon-chevron-down</a></li>
            <li><a href="javascript:js_select_icon('icon-retweet');"><i class="icon-retweet"></i> icon-retweet</a></li>
            <li><a href="javascript:js_select_icon('icon-shopping-cart');"><i class="icon-shopping-cart"></i> icon-shopping-cart</a></li>
            <li><a href="javascript:js_select_icon('icon-folder-close');"><i class="icon-folder-close"></i> icon-folder-close</a></li>
            <li><a href="javascript:js_select_icon('icon-folder-open');"><i class="icon-folder-open"></i> icon-folder-open</a></li>
            <li><a href="javascript:js_select_icon('icon-resize-vertical');"><i class="icon-resize-vertical"></i> icon-resize-vertical</a></li>
            <li><a href="javascript:js_select_icon('icon-resize-horizontal');"><i class="icon-resize-horizontal"></i> icon-resize-horizontal</a></li>
            <li><a href="javascript:js_select_icon('icon-hdd');"><i class="icon-hdd"></i> icon-hdd</a></li>
            <li><a href="javascript:js_select_icon('icon-bullhorn');"><i class="icon-bullhorn"></i> icon-bullhorn</a></li>
            <li><a href="javascript:js_select_icon('icon-bell');"><i class="icon-bell"></i> icon-bell</a></li>
            <li><a href="javascript:js_select_icon('icon-certificate');"><i class="icon-certificate"></i> icon-certificate</a></li>
            <li><a href="javascript:js_select_icon('icon-thumbs-up');"><i class="icon-thumbs-up"></i> icon-thumbs-up</a></li>
            <li><a href="javascript:js_select_icon('icon-thumbs-down');"><i class="icon-thumbs-down"></i> icon-thumbs-down</a></li>
            <li><a href="javascript:js_select_icon('icon-hand-right');"><i class="icon-hand-right"></i> icon-hand-right</a></li>
            <li><a href="javascript:js_select_icon('icon-hand-left');"><i class="icon-hand-left"></i> icon-hand-left</a></li>
            <li><a href="javascript:js_select_icon('icon-hand-up');"><i class="icon-hand-up"></i> icon-hand-up</a></li>
            <li><a href="javascript:js_select_icon('icon-hand-down');"><i class="icon-hand-down"></i> icon-hand-down</a></li>
            <li><a href="javascript:js_select_icon('icon-circle-arrow-right');"><i class="icon-circle-arrow-right"></i> icon-circle-arrow-right</a></li>
            <li><a href="javascript:js_select_icon('icon-circle-arrow-left');"><i class="icon-circle-arrow-left"></i> icon-circle-arrow-left</a></li>
            <li><a href="javascript:js_select_icon('icon-circle-arrow-up');"><i class="icon-circle-arrow-up"></i> icon-circle-arrow-up</a></li>
            <li><a href="javascript:js_select_icon('icon-circle-arrow-down');"><i class="icon-circle-arrow-down"></i> icon-circle-arrow-down</a></li>
            <li><a href="javascript:js_select_icon('icon-globe');"><i class="icon-globe"></i> icon-globe</a></li>
            <li><a href="javascript:js_select_icon('icon-globe');"><i class="icon-wrench"></i> icon-wrench</a></li>
            <li><a href="javascript:js_select_icon('icon-tasks');"><i class="icon-tasks"></i> icon-tasks</a></li>
            <li><a href="javascript:js_select_icon('icon-filter');"><i class="icon-filter"></i> icon-filter</a></li>
            <li><a href="javascript:js_select_icon('icon-briefcase');"><i class="icon-briefcase"></i> icon-briefcase</a></li>
            <li><a href="javascript:js_select_icon('icon-fullscreen');"><i class="icon-fullscreen"></i> icon-fullscreen</a></li>
            <li><a href="javascript:js_select_icon('icon-play');"><i class="icon-play"></i> icon-play</a></li>
            <li><a href="javascript:js_select_icon('icon-pause');"><i class="icon-pause"></i> icon-pause</a></li>
            <li><a href="javascript:js_select_icon('icon-stop');"><i class="icon-stop"></i> icon-stop</a></li>
            <li><a href="javascript:js_select_icon('icon-forward');"><i class="icon-forward"></i> icon-forward</a></li>
    	  <li><a href="javascript:js_select_icon('icon-fast-forward');"><i class="icon-fast-forward"></i> icon-fast-forward</a></li>
            <li><a href="javascript:js_select_icon('icon-step-forward');"><i class="icon-step-forward"></i> icon-step-forward</a></li>
            <li><a href="javascript:js_select_icon('icon-eject');"><i class="icon-eject"></i> icon-eject</a></li>
            <li><a href="javascript:js_select_icon('icon-chevron-left');"><i class="icon-chevron-left"></i> icon-chevron-left</a></li>
            <li><a href="javascript:js_select_icon('icon-chevron-right');"><i class="icon-chevron-right"></i> icon-chevron-right</a></li>
            <li><a href="javascript:js_select_icon('icon-plus-sign');"><i class="icon-plus-sign"></i> icon-plus-sign</a></li>
            <li><a href="javascript:js_select_icon('icon-minus-sign');"><i class="icon-minus-sign"></i> icon-minus-sign</a></li>
            <li><a href="javascript:js_select_icon('icon-remove-sign');"><i class="icon-remove-sign"></i> icon-remove-sign</a></li>
            <li><a href="javascript:js_select_icon('icon-ok-sign');"><i class="icon-ok-sign"></i> icon-ok-sign</a></li>
        </ul>
      </div>

    </div>

	
<?	
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
			$sql 		= " SELECT * FROM "._TABLE_." WHERE "._TABLE_."_ID = $id ";	
			$result 	= mysql_query($sql);
			$rs		= mysql_fetch_assoc($result);
			
			if($rs[_TABLE_."_Image"]) $src = _UPLOAD_.$rs[_TABLE_."_Image"];
			else $src = "";
			#echo $_src;
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
          
          <div class="control-group">
            <label class="control-label" for="txt_TitleEn"><?=$Mod_Field["txt_TitleEn"]?></label>
            <div class="controls">
              <input type="text" id="txt_TitleEn" name="txt_TitleEn" placeholder="<?=$Mod_Field["txt_TitleEn"]?>" value="<?=$rs[_TABLE_."_TitleEn"]?>" required="required">
            </div>
          </div>
          
          <div class="control-group">
            <label class="control-label" for="txt_Icon"><span id="icon_show"><i class='<?=$rs[_TABLE_."_Icon"]?>'></i></span> <?=$Mod_Field["txt_Img"]?></label>
            <div class="controls">
              <input type="text" id="txt_Icon" name="txt_Icon" placeholder="<?=$Mod_Field["txt_Img"]?>" value="<?=$rs[_TABLE_."_Icon"]?>" required="required"> 
              <a href="#myModal" role="button" class="btn btn-primary" data-toggle="modal" onclick="load_mod('<?=$this_path?>');"><?=$Mod_Field["txt_Select"]?></a>
 
                <!-- Modal -->
                  <div class="modal fade" id="myModal">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title">Select Icon</h4>
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
	}else if($action == "AddSub"){
		
		if($id){
			$sql 		= " SELECT * FROM "._TABLE_SUB_." WHERE "._TABLE_SUB_."_ID = $id ";	
			$result 	= mysql_query($sql);
			$rs		= mysql_fetch_assoc($result);
			
		}
?>
		<div id="area_input">
    	<form id="myForm" name="myForm" enctype="multipart/form-data" method="post" class="form-horizontal" ng-submit="submit()" ng-controller="js_SaveSub">
          
          <input name="menu_id" id="menu_id" type="hidden" value="<?=$menu_id?>" />
          <input name="id" id="id" type="hidden" value="<?=$id?>" />
          

          <div class="control-group">
            <label class="control-label" for="txt_Title"><?=$Mod_Field["txt_Title"]?></label>
            <div class="controls">
              <input type="text" id="txt_Title" name="txt_Title" placeholder="<?=$Mod_Field["txt_Title"]?>" value="<?=$rs[_TABLE_SUB_."_Title"]?>" required="required">
            </div>
          </div>
          
          <div class="control-group">
            <label class="control-label" for="txt_TitleEn"><?=$Mod_Field["txt_TitleEn"]?></label>
            <div class="controls">
              <input type="text" id="txt_TitleEn" name="txt_TitleEn" placeholder="<?=$Mod_Field["txt_TitleEn"]?>" value="<?=$rs[_TABLE_SUB_."_TitleEn"]?>" required="required">
            </div>
          </div>
          
          <div class="control-group">
            <label class="control-label" for="txt_Icon"><span id="icon_show"><i class='<?=$rs[_TABLE_SUB_."_Icon"]?>'></i></span> <?=$Mod_Field["txt_Img"]?></label>
            <div class="controls">
              <input type="text" id="txt_Icon" name="txt_Icon" placeholder="<?=$Mod_Field["txt_Img"]?>" value="<?=$rs[_TABLE_SUB_."_Icon"]?>" required="required"> 
              <a href="#myModal" role="button" class="btn btn-primary" data-toggle="modal" onclick="load_mod('<?=$this_path?>');"><?=$Mod_Field["txt_Select"]?></a>
 
                <!-- Modal -->
                  <div class="modal fade" id="myModal">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title">Select Icon</h4>
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
          
          
          <?
          $sql_m		= " SELECT * FROM "._TABLE_MOD_." WHERE "._TABLE_MOD_."_ID = '".$rs[_TABLE_SUB_."_ModID"]."' ";
		  $result_m 	= mysql_query($sql_m);
		  if($rs_m		= mysql_fetch_assoc($result_m)){
			$_modName = $rs_m[_TABLE_MOD_."_Title"];  
		  }
		  ?>
          
          <div class="control-group">
            <label class="control-label" for="txt_Mod"><?=$Mod_Field["txt_Mod"]?></label>
            <div class="controls">
              <input type="hidden" id="txt_Modhide" name="txt_Modhide" value="<?=$rs[_TABLE_SUB_."_ModID"]?>"> 
              <input type="text" id="txt_Mod" name="txt_Mod" placeholder="<?=$Mod_Field["txt_Mod"]?>" value="<?=$_modName?>" required="required"> 
              <a href="#myModule" role="button" class="btn btn-primary" data-toggle="modal"><?=$Mod_Field["txt_Select"]?></a>
 
                <!-- Modal -->
                  <div class="modal fade" id="myModule">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title">Select Module</h4>
                        </div>
                        
                        <div class="modal-body" id="area_file">
                          <!-- Content -->
                          <?
                          $sql_m	= " SELECT * FROM "._TABLE_MOD_." WHERE "._TABLE_MOD_."_Status = 'Enable' ";
						  $sql_m  .= " ORDER BY  IF("._TABLE_MOD_."_Order > 0 , "._TABLE_MOD_."_Order , "._TABLE_MOD_."_ID )  DESC ";
						  
						  $result_m = mysql_query($sql_m);
						  
						  ?>	
                          <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-striped">
                              <tr>
                                <td width="10%"><strong>No</strong></td>
                                <td width="73%"><strong><?=$Mod_Field["txt_Mod"]?></strong></td>
                                <td width="17%"><strong><?=$Mod_Field["txt_Select"]?></strong></td>
                              </tr>
                              <?
							  $i = 1;
                              while($rs_m = mysql_fetch_assoc($result_m)){
							  ?>
                              <tr>
                                <td>#<?=$i?></td>
                                <td><?=$rs_m[_TABLE_MOD_."_Title"]?></td>
                                <td><a href="javascript:js_select_mod('<?=$rs_m[_TABLE_MOD_."_ID"]?>','<?=$rs_m[_TABLE_MOD_."_Title"]?>');" class="btn btn-primary"><?=$Mod_Field["txt_Select"]?></a></td>
                              </tr>
                              <?
							  	$i++;
							  }#end while
							  ?>
                            </table>

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

	}else if($action == "Sort"){
	
?>
	<link href="../../lib/css_sort.css" rel="stylesheet" type="text/css" />
    <script src="../../lib/jquery-sortable.js"></script>
    <script>
	  $(function() {
			var oldContainer
			$("ol.nested_with_switch").sortable({
			  group: 'nested',
			  afterMove: function (placeholder, container) {
				if(oldContainer != container){
				  if(oldContainer)
					oldContainer.el.removeClass("active")
				  container.el.addClass("active")
				  
				  oldContainer = container
				}
			  },
			  onDrop: function (item, container, _super) {
				container.el.removeClass("active")
				_super(item)
				//alert(item.css(container));
			  }
			})
			
			$(".switch-container").on("click", ".switch", function  (e) {
			  var method = $(this).hasClass("active") ? "enable" : "disable"
			  $(e.delegateTarget).next().sortable(method)
			})
	  });
	</script>

	<ol id="main_order" class='nested_with_switch vertical'>
    <?
     $sql  = 	" SELECT * ".
					" FROM "._TABLE_.
					" WHERE "._TABLE_."_Status = 'Enable' ";
	 $sql .= 	" ORDER BY  IF("._TABLE_."_Order > 0 , "._TABLE_."_Order , "._TABLE_."_ID )  DESC ";
	
	 #echo $sql;
	 $result	 	= mysql_query($sql);
	 $i 			= 0;
	 
	 while($rs = mysql_fetch_assoc($result)){
		 $id 		= $rs[_TABLE_."_ID"];
	?>
    <li rel="<?=$id?>">
		<?=$rs[_TABLE_."_Title"]?>
        <ol id="sub_<?=$id?>">
        <?
        $sql_sub 		= 	" SELECT * FROM "._TABLE_SUB_.
								" LEFT JOIN "._TABLE_MOD_." ON "._TABLE_MOD_."_ID = "._TABLE_SUB_."_ModID ".
								" WHERE "._TABLE_SUB_."_MenuID = '$id' ".
								" AND "._TABLE_SUB_."_Status = 'Enable' ";
		$sql_sub 	   .= 	" ORDER BY  IF("._TABLE_SUB_."_Order > 0 , "._TABLE_SUB_."_Order , "._TABLE_SUB_."_ID )  DESC ";
		
		$result_sub 		= mysql_query($sql_sub);
		while($rs_sub 	= mysql_fetch_assoc($result_sub)){
		?>
        	<li id="<?=$rs_sub[_TABLE_SUB_."_ID"]?>">
				<i class="<?=$rs_sub[_TABLE_SUB_."_Icon"]?>"></i> <?=$rs_sub[_TABLE_SUB_."_Title"]?>
            </li>
         <?
		}#end sub
		 ?>
        </ol>
    </li>
    <?
		$i++;
	 }#end main
	?>
      
    </ol>
    
    <div>
        
        <button type="button" class="btn btn-success" onclick="js_check_order('<?=$this_path?>');"><?=$Mod_Text["save_data"]?></button>
              <button type="button" class="btn" onclick='js_load_page($("#area_panel") ,"<?=$this_path?>" , "action=View");'><?=$Mod_Text["cancel_data"]?></button>
    </div>

<?		

	}else if($action == "View" || $action == ""){
	
?>
        
	<form action="index_form.php" method="post" name="dataForm" id="dataForm">	
    	<input type="hidden" name="action" id="action" value="<?=$action?>" />
        <input type="hidden" name="reorder" id="reorder" value="<?=$reorder?>" />
        <input type="hidden" name="order" id="order" value="<?=$order?>" />
        <div class="panel">
          <div class="panel-heading">
            <h3 class="panel-title"><?=$Mod_Field["create_Menu"]?></h3>
            <p>
            <div class="p_left input_top">
                <a href='javascript:js_load_page($("#area_data") ,"<?=$this_path?>" , "action=Add");' class="btn btn-info"><i class="icon-plus-sign icon-plus-sign  icon-white"></i> <?=$Mod_Text["create_data"]?></a>
                
                
                <a href='javascript:js_load_page($("#area_data") ,"<?=$this_path?>" , "action=Sort");' class="btn"><i class="icon-th-list"></i> <?=$Mod_Text["bnt_Order"]?></a>
            </div>
                
                
             <div class="p_clear"></div>
                  
            </p>
          </div>
          
          <!-- Begin Data -->
          <div id="area_data">
             <?

             $sql  = 	" SELECT * ".
                            " FROM "._TABLE_.
                            " WHERE 1=1 ";
             $sql .= 	" ORDER BY  IF("._TABLE_."_Order > 0 , "._TABLE_."_Order , "._TABLE_."_ID )  DESC ";
	
             #echo $sql;
             $result	 	=	mysql_query($sql);
             $i 			= 0;
			 
			 while($rs = mysql_fetch_assoc($result)){
				 
				++$row_index;
				++$_my_index;
				$id 				= $rs[_TABLE_."_ID"];
				$row_id		=	substr('0000'.$id,-4);
             ?>
             
             
             <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered table-hover table-striped sorted_table">
                  <tr class="myStorng">
                    <td width="6%" align="center" valign="top">ID</td>
                    <td width="8%" align="center" valign="top"><?=$Mod_Field["txt_Img"]?></td>
                    <td width="24%" align="center" valign="top"><?=$Mod_Field["txt_Title"]?></td>
                    <td width="25%" align="center" valign="top"><?=$Mod_Field["txt_TitleEn"]?></td>
                    <td width="34%" align="center" valign="top"><?=$Mod_Text["Tool"]?></td>
                  </tr>
                  <?
                  
                  ?>
                  <tr>
                    <td align="center" valign="top"><?=$row_id?></td>
                    <td align="center" valign="top"><i class="<?=$rs[_TABLE_."_Icon"]?>"></i></td>
                    <td align="center" valign="top"><?=$rs[_TABLE_."_Title"]?></td>
                    <td align="center" valign="top"><?=$rs[_TABLE_."_TitleEn"]?></td>
                    <td align="center" valign="top">
                        <div class="btn-group">
                          <a class="btn btn-info" href='javascript:js_load_page($("#area_data") ,"<?=$this_path?>" , "action=AddSub&menu_id=<?=$id?>");'><?=$Mod_Field["bnt_CreateSubmenu"]?></a>
                          
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
                  <tr>
                    <td align="center" valign="top"><?=$Mod_Field["txt_Submenu"]?></td>
                    <td colspan="4" align="center" valign="top">
                    
                    <!-- Sub menu -->
                    
                    <?
                    $sql_sub 		= 	" SELECT * FROM "._TABLE_SUB_.
											" LEFT JOIN "._TABLE_MOD_." ON "._TABLE_MOD_."_ID = "._TABLE_SUB_."_ModID ".
											" WHERE "._TABLE_SUB_."_MenuID = '$id' ";
					$sql_sub 	   .= 	" ORDER BY  IF("._TABLE_SUB_."_Order > 0 , "._TABLE_SUB_."_Order , "._TABLE_SUB_."_ID )  DESC ";
					$result_sub 	= mysql_query($sql_sub);
					?>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered">
                      <tr class="myStorng">
                        <td width="6%">ID </td>
                        <td width="6%"><?=$Mod_Field["txt_Img"]?> </td>
                        <td width="22%"><?=$Mod_Field["txt_Title"]?> </td>
                        <td width="23%"><?=$Mod_Field["txt_TitleEn"]?> </td>
                        <td width="19%"><?=$Mod_Field["txt_Mod"]?></td>
                        <td width="24%"><?=$Mod_Text["Tool"]?> </td>
                        
                      </tr>
                      <?
                      while($rs_sub = mysql_fetch_assoc($result_sub)){
						  
						  $sub_id	= $rs_sub[_TABLE_SUB_."_ID"];
					  ?>
                      <tr>
                        <td><?=$rs_sub[_TABLE_SUB_."_ID"]?></td>
                        <td><i class="<?=$rs_sub[_TABLE_SUB_."_Icon"]?>"></i></td>
                        <td><?=$rs_sub[_TABLE_SUB_."_Title"]?></td>
                        <td><?=$rs_sub[_TABLE_SUB_."_TitleEn"]?></td>
                        <td><?=$rs_sub[_TABLE_MOD_."_Title"]?></td>
                        <td>
                        	
                            <div class="btn-group">
							  <?
                              if($rs_sub[_TABLE_SUB_."_Status"] == "Enable") $class = "btn-default"; else $class = "btn-warning";
                              ?>
                              <a class="btn <?=$class?>" href="javascript:void(0);" onclick="js_enable_sub(this,'<?=$this_path?>','id=<?=$sub_id?>')"><?=$rs_sub[_TABLE_SUB_."_Status"]?></a>
                            </div>
        
                            <!-- Split button -->
                            <div class="btn-group">
                              <button type="button" class="btn btn-default"><?=$Mod_Text["bnt_Action"] ?></button>
                              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                <span class="caret"></span>
                              </button>
                              <ul class="dropdown-menu">
                                <li><a href='javascript:js_load_page($("#area_data") ,"<?=$this_path?>" , "action=AddSub&id=<?=$sub_id?>&menu_id=<?=$id?>");'>
                                <i class="icon-pencil"></i>
                                <?=$Mod_Text["edit_data"]?>
                                </a></li>
                                <li><a href="javascript:void(0);" onClick=" if (confirm('<?=$Mod_Text["Delete_Form"]?>')) {  js_delete_sub('<?=$this_path?>','id=<?=$sub_id?>'); }">
                                <i class="icon-trash"></i>
                                <?=$Mod_Text["delete_data"]?>
                                </a></li> 
                                <li class="divider"></li>
                                <li class="txt_time"><a href="#"><?=$Mod_Text["txt_Update"]?> <?=php_FormatDate("1 Jan XX",$rs_sub[_TABLE_SUB_."_LastUpdate"],true)?></a></li>
                                <li class="txt_time"><a href="#"><?=$Mod_Text["txt_Create"]?> <?=php_FormatDate("1 Jan XX",$rs_sub[_TABLE_SUB_."_CreateDate"],true)?></a></li>
                                
                              </ul>
                            </div>
                        
                        </td>
                      </tr>
                      <?
					  }#end while sub
					  ?>
                    </table>
                    <!-- ./ Sub menu -->
                    
                    </td>
                  </tr>
                  
                </table>
                
                <?
                    $i++;
                  }#end while
                ?>
               
                
    
          </div>
          <!-- End Data -->
          
        </div>	
	</form>	
<?	
	}#end if action

}#end if main
?>