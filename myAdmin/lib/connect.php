<?
#header("Content-type: text/html; charset=UTF-8");
if(_SYSTEM_DB_TYPE_=="mysql") {

	@mysql_connect(_SYSTEM_DB_HOSTNAME_ , _SYSTEM_DB_USERNAME_ , _SYSTEM_DB_PASSWORD_) 
	OR DIE("ไม่สามารถติดต่อฐานข้อมูลได้");
	
	mysql_select_db( _SYSTEM_DB_NAME_ ); 	
	mysql_query("SET character_set_results=utf8");
	mysql_query("SET character_set_client=utf8");
	mysql_query("SET character_set_connection=utf8");

}
?>