<?exit();?>|**|sys_user|**|

CREATE TABLE IF NOT EXISTS sys_user (
 sys_user_ID int(11) NOT NULL auto_increment,
 sys_user_UserID int(11) NOT NULL default '0',
 sys_user_LevelID int(11) NOT NULL default '0',
 sys_user_SupplierID int(11) NOT NULL default '0',
 
 sys_user_Username varchar(255) NOT NULL default '',
 sys_user_Password varchar(255) NOT NULL default '',
 sys_user_Image varchar(255) NOT NULL default '',
 
 sys_user_Firstname varchar(255) NOT NULL default '',
 sys_user_Lastname varchar(255) NOT NULL default '',
 sys_user_Email varchar(255) NOT NULL default '',
 sys_user_Phone varchar(255) NOT NULL default '',
 
 sys_user_CreateDate datetime NOT NULL default '0000-00-00 00:00:00',
 sys_user_LastUpdate datetime NOT NULL default '0000-00-00 00:00:00',
 sys_user_Order int(11) NOT NULL default '0',
 sys_user_PrivateIP varchar(20) NOT NULL,
 sys_user_IP varchar(20) NOT NULL,
 sys_user_Status varchar(50) NOT NULL default 'Enable',
 PRIMARY KEY  (sys_user_ID)
);
