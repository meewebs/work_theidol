<?exit();?>|**|sys_menu|**|

CREATE TABLE IF NOT EXISTS sys_menu (
 sys_menu_ID int(11) NOT NULL auto_increment,
 sys_menu_Title varchar(255) NOT NULL default '',
 sys_menu_TitleEn varchar(255) NOT NULL default '',
 sys_menu_Icon varchar(255) NOT NULL default '',
 
 sys_menu_CreateDate datetime NOT NULL default '0000-00-00 00:00:00',
 sys_menu_LastUpdate datetime NOT NULL default '0000-00-00 00:00:00',
 sys_menu_Order int(11) NOT NULL default '0',
 sys_menu_PrivateIP varchar(20) NOT NULL,
 sys_menu_IP varchar(20) NOT NULL,
 sys_menu_Status varchar(50) NOT NULL default 'Enable',
 PRIMARY KEY  (sys_menu_ID)
);

CREATE TABLE IF NOT EXISTS sys_menu_sub (
 sys_menu_sub_ID int(11) NOT NULL auto_increment,
 sys_menu_sub_MenuID int(11) NOT NULL default '0',
 sys_menu_sub_ModID int(11) NOT NULL default '0',
 
 sys_menu_sub_Title varchar(255) NOT NULL default '',
 sys_menu_sub_TitleEn varchar(255) NOT NULL default '',
 sys_menu_sub_Icon varchar(255) NOT NULL default '',
 
 
 sys_menu_sub_CreateDate datetime NOT NULL default '0000-00-00 00:00:00',
 sys_menu_sub_LastUpdate datetime NOT NULL default '0000-00-00 00:00:00',
 sys_menu_sub_Order int(11) NOT NULL default '0',
 sys_menu_sub_PrivateIP varchar(20) NOT NULL,
 sys_menu_sub_IP varchar(20) NOT NULL,
 sys_menu_sub_Status varchar(50) NOT NULL default 'Enable',
 PRIMARY KEY  (sys_menu_sub_ID)
);