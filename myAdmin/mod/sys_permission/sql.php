<?exit();?>|**|sys_permission|**|

CREATE TABLE IF NOT EXISTS sys_permission (
 sys_permission_ID int(11) NOT NULL auto_increment,
 sys_permission_Title varchar(255) NOT NULL default '',
 sys_permission_Menu varchar(255) NOT NULL default '',
 sys_permission_MenuSub varchar(255) NOT NULL default '',
 
 sys_permission_CreateDate datetime NOT NULL default '0000-00-00 00:00:00',
 sys_permission_LastUpdate datetime NOT NULL default '0000-00-00 00:00:00',
 sys_permission_Order int(11) NOT NULL default '0',
 sys_permission_PrivateIP varchar(20) NOT NULL,
 sys_permission_IP varchar(20) NOT NULL,
 sys_permission_Status varchar(50) NOT NULL default 'Enable',
 PRIMARY KEY  (sys_permission_ID)
);