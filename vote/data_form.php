<?php
include_once("../myAdmin/lib/session.php");
header("Content-type: text/html; charset=UTF-8");
include_once("../myAdmin/lib/config.php");
include_once("../myAdmin/lib/function.php");
include_once("../myAdmin/mod/_facebook_photo/config.php");

decodeURL($_SERVER["QUERY_STRING"]);

function DateTimeDiff($strDateTime1,$strDateTime2){
	return (strtotime($strDateTime2) - strtotime($strDateTime1)) /  ( 60 * 60 ); // 1 Hour =  60*60
}

//print_r($_REQUEST);

//echo "row : ".$row;

if($action == "like_image"){
	
	$now_time = time();
	$end_time = strtotime('31-03-2016');
	
	
	if($now_time > $end_time){
		
		echo "EndTime";	
		
	}else{
		
		
		include_once("../home_fb/fbaccess.php");
		$datenow =  date("Y-m-d");
		
		if($_SESSION["facebook_id"]){		
		
			$status_user = 'False';
			$sqls = 	" SELECT "._TABLE_LIKE_."_ID ".
							" FROM "._TABLE_LIKE_.
							" WHERE "._TABLE_LIKE_."_FacebookID = '".$_SESSION["facebook_id"]."' ".
							" AND DATE("._TABLE_LIKE_."_CreateDate) = '$datenow' ".
							" AND "._TABLE_LIKE_."_GroupID = '$row' ";
			#echo $sqls;
			$result = mysql_query($sqls);
			$count = mysql_num_rows($result);
		
			if($count ===  0){
					
						if($url){
								
							$insert = "";
							$insert[_TABLE_LIKE_."_FacebookID"] 				= "'".$_SESSION["facebook_id"]."'";
							$insert[_TABLE_LIKE_."_GroupID"] 					= "'".$row."'";
							$insert[_TABLE_LIKE_."_Url"] 							= "'".$url."'";
							$insert[_TABLE_LIKE_."_Ad"] 							= "'".$_SESSION["S_Send"]."'";
								
							$insert[_TABLE_LIKE_."_CreateDate"] 				= "NOW()";
							$insert[_TABLE_LIKE_."_LastUpdate"] 				= "NOW()";
							$insert[_TABLE_LIKE_."_PrivateIP"] 					= "'".php_getPrivateIP()."'";
							$insert[_TABLE_LIKE_."_IP"] 								= "'".php_getIP()."'";
							
							$sql=" INSERT INTO "._TABLE_LIKE_."(".implode(",",array_keys($insert)).") VALUES (".implode(",",array_values($insert)).")";
							if(mysql_query($sql)){
								
	
								$update	= "";
								$update[] = _TABLE_."_Like 	= "._TABLE_."_Like + 1 ";	
								$sql="UPDATE "._TABLE_." SET ".implode(",",$update)." WHERE "._TABLE_."_ID = '$row' ";
								mysql_query($sql);
							
							
								$sql_show = 	" SELECT  "._TABLE_."_Like ".
														" FROM "._TABLE_.
														" WHERE "._TABLE_."_ID = '".$row."' ";
	
								#echo $sql_count ;
								$result_show 	= mysql_query($sql_show);
								$show 				= mysql_fetch_assoc($result_show);
							
								$total = $show[_TABLE_."_Like"];
								echo $show[_TABLE_."_Like"]."|OK|".$total;
								
					
							}else{
								
								echo "False";
								
							}	
						
						
						}else{
							echo "Hacking";	
						}// end url
									
						
								///////////////////////////////////////////////////////////////////////////
					}else
						echo "Voted";// end now
					
				
		}else{
			echo "FalseFacebook";		
		}// end if facebook id
		
		
	}//end time


}else  if($action == "share_image"){
	
	
	include_once("../home_fb/fbaccess.php");
	$datenow =  date("Y-m-d");
	
	if($_SESSION["facebook_id"]){		
			
		$status_user = 'False';
		$sqls 	= 	" SELECT "._TABLE_SHARE_."_ID , "._TABLE_SHARE_."_CreateDate ".
						" FROM "._TABLE_SHARE_.
						" WHERE "._TABLE_SHARE_."_GroupID = '".$row."' ".
						" AND "._TABLE_SHARE_."_FacebookID = '".$_SESSION["facebook_id"]."' ";
		$sqls 	.= " AND ";
		$sqls 	.= " ( "._TABLE_SHARE_."_CreateDate BETWEEN '".$datenow." 00:00:00' AND '".$datenow." 23:59:00' )";
		#$sqls	.= " ORDER BY "._TABLE_SHARE_."_ID DESC limit 1 ";
		//echo $sqls;
		
		$result = mysql_query($sqls);
		$count = mysql_num_rows($result);
		
		if($count > 0){
			
			$rs 	= mysql_fetch_assoc($result);
			$total = 3;
			if(($total<=2)){
				
				echo "FalseTime";
				
			}else{
						/////////////////////////////////////////////////////////////////////////
				$insert[_TABLE_SHARE_."_FacebookID"] 				= "'".$_SESSION["facebook_id"]."'";
				$insert[_TABLE_SHARE_."_GroupID"] 					= "'".$row."'";
									
				$insert[_TABLE_SHARE_."_CreateDate"] 				= "NOW()";
				$insert[_TABLE_SHARE_."_LastUpdate"] 				= "NOW()";
				$insert[_TABLE_SHARE_."_PrivateIP"] 					= "'".php_getPrivateIP()."'";
				$insert[_TABLE_SHARE_."_IP"] 								= "'".php_getIP()."'";
					
							
				$sql=" INSERT INTO "._TABLE_SHARE_."(".implode(",",array_keys($insert)).") VALUES (".implode(",",array_values($insert)).")";
							
				if(mysql_query($sql)){
								
					$sql_count = 	" SELECT  COUNT("._TABLE_SHARE_."_ID) "._TABLE_SHARE_."_CountShare ".
											" FROM "._TABLE_SHARE_.
											" WHERE "._TABLE_SHARE_."_GroupID = '".$row."' ";
	
					#echo $sql_count ;
					$result_count = mysql_query($sql_count);
					$count = mysql_fetch_assoc($result_count);

					$status_user = 'OK';
					
							
					$update[] = _TABLE_."_Share 				= '".$count[_TABLE_SHARE_."_CountShare"]."'";		
					#$update[] = _TABLE_."_LastUpdate 		= NOW()";	
					$sql			= "UPDATE "._TABLE_." SET ".implode(",",$update)." WHERE "._TABLE_."_ID = '$row' ";
					mysql_query($sql);
					
							
					/*$sql_show = 	" SELECT  "._TABLE_."_Like , "._TABLE_."_Share ".
											" FROM "._TABLE_.
											" WHERE "._TABLE_."_ID = '".$row."' ";
	
					#echo $sql_count ;
					$result_show 	= mysql_query($sql_show);
					$show 				= mysql_fetch_assoc($result_show);*/
					$total = 0;
				
					$total = $show[_TABLE_."_Like"]+($show[_TABLE_."_Share"]*3);
					echo $show[_TABLE_."_Share"]."|OK|".$total;
					#echo $text;
							
					}else{
						echo "False";
					}	
					///////////////////////////////////////////////////////////////////////////
		}
		
	}else{
				
		$insert[_TABLE_SHARE_."_FacebookID"] 				= "'".$_SESSION["facebook_id"]."'";
		$insert[_TABLE_SHARE_."_GroupID"] 					= "'".$row."'";
								
		$insert[_TABLE_SHARE_."_CreateDate"] 				= "NOW()";
		$insert[_TABLE_SHARE_."_LastUpdate"] 				= "NOW()";
		$insert[_TABLE_SHARE_."_PrivateIP"] 					= "'".php_getPrivateIP()."'";
		$insert[_TABLE_SHARE_."_IP"] 								= "'".php_getIP()."'";
							
									
		$sql = " INSERT INTO "._TABLE_SHARE_."(".implode(",",array_keys($insert)).") VALUES (".implode(",",array_values($insert)).")";
									
		if(mysql_query($sql)){
										
			$sql_count = 	" SELECT  COUNT("._TABLE_SHARE_."_ID) "._TABLE_SHARE_."_CountShare ".
									" FROM "._TABLE_SHARE_.
									" WHERE "._TABLE_SHARE_."_GroupID = '".$row."' ";
			
			#echo $sql_count ;
			$result_count 	= mysql_query($sql_count);
			$count 				= mysql_fetch_array($result_count);

			$status_user = 'OK';
									
									
			$update[] 	= _TABLE_."_Share 				= '".$count[_TABLE_SHARE_."_CountShare"]."'";		
			#$update[] 	= _TABLE_."_LastUpdate 		= NOW()";	
			$sql 				= " UPDATE "._TABLE_." SET ".implode(",",$update)." WHERE "._TABLE_."_ID = '$row' ";
			mysql_query($sql);
			
			
			/*$sql_show = 	" SELECT  "._TABLE_."_Like , "._TABLE_."_Share ".
									" FROM "._TABLE_.
									" WHERE "._TABLE_."_ID = '".$row."' ";
			
			#echo $sql_count ;
			$result_show 	= mysql_query($sql_show);
			$show 				= mysql_fetch_array($result_show);
		
			$total 				= $show[_TABLE_."_Like"]+($show[_TABLE_."_Share"]);*/
			$total	= 0;
			echo $show[_TABLE_."_Share"]."|OK|".$total;
			#echo $text;
		
		}else{
			echo "False";
		}	
	
	}
				
				
	if($status_user=='OK'){
		
		$sql_src = 	" SELECT   * " .
							" FROM "._TABLE_.
							" WHERE "._TABLE_."_ID = '".$row."' ";
		#echo $sql_src ;
		$result 			= mysql_query($sql_src);
		$pic 				= mysql_fetch_assoc($result);
		
		$src 				= "http://www.pixelhouse.biz/hat/img/share.jpg";
		$link				= _SYSTEM_ROOTPATH_FULL_._SYSTEM_ROOTPATH_;
		$title				= "คุณคือ ผู้ตัดสิน...ร่วมโหวตหมวกใบใหม่ PH & BH 2016 เพียงเลือกหมวกที่ใช่...สไตล์ที่ชอบจำนวน 3 แบบ";
		$description	= php_split_p("ลุ้นรับรางวัล 1. บัตรนวดกดจุด สะท้อนฝ่าเท้าร้าน Zense Massage จำนวน 5 รางวัล รางวัลละ 2 ใบ 2. หมวกที่ได้ชนะการคัดเลือก จำนวน 5 รางวัล รางวัลละ 1 ใบ");
		
		#echo "idxxx:".$row;
		echo "OK";
		include_once("../home_fb/fbaccess_like.php");	
	}
				
	}else{
		echo "FalseFacebook";		
	}


}

?>