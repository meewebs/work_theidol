<?exit();?>|**|sys_mod|**|

CREATE TABLE IF NOT EXISTS sys_mod (
 sys_mod_ID int(11) NOT NULL auto_increment,
 sys_mod_Title varchar(255) NOT NULL default '',
 sys_mod_Image varchar(255) NOT NULL default '',
 sys_mod_Mod varchar(255) NOT NULL default '',
 
 sys_mod_CreateDate datetime NOT NULL default '0000-00-00 00:00:00',
 sys_mod_LastUpdate datetime NOT NULL default '0000-00-00 00:00:00',
 sys_mod_Order int(11) NOT NULL default '0',
 sys_mod_PrivateIP varchar(20) NOT NULL,
 sys_mod_IP varchar(20) NOT NULL,
 sys_mod_Status varchar(50) NOT NULL default 'Enable',
 PRIMARY KEY  (sys_mod_ID)
);