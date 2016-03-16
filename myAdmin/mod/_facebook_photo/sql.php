<?exit();?>|**|_facebook_photo|**|

CREATE TABLE _facebook_photo (
  _facebook_photo_ID int(11) NOT NULL AUTO_INCREMENT,
  _facebook_photo_No int(10) NOT NULL,
  _facebook_photo_FacebookID varchar(200) NOT NULL,
  _facebook_photo_Name varchar(200) NOT NULL,
  _facebook_photo_Subject text,
  _facebook_photo_Like int(10) NOT NULL,
  _facebook_photo_View int(100) NOT NULL,
  
  _facebook_photo_Image varchar(255) NOT NULL,
  _facebook_photo_PhysicalName varchar(255) NOT NULL,
  
  _facebook_photo_CreateDate datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  _facebook_photo_LastUpdate datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  _facebook_photo_Order int(11) NOT NULL DEFAULT '0',
  _facebook_photo_PrivateIP varchar(20) NOT NULL,
  _facebook_photo_IP varchar(20) NOT NULL,
  _facebook_photo_Status varchar(50) NOT NULL DEFAULT 'Enable',
  PRIMARY KEY (_facebook_photo_ID)
);


CREATE TABLE _facebook_photo_like (
  _facebook_photo_like_ID int(11) NOT NULL AUTO_INCREMENT,
  _facebook_photo_like_UserID int(11) NOT NULL DEFAULT '0',
  _facebook_photo_like_MenuID int(11) NOT NULL DEFAULT '0',
  _facebook_photo_like_GroupID int(11) NOT NULL DEFAULT '0',
  _facebook_photo_like_FacebookID varchar(200) NOT NULL DEFAULT '',
  _facebook_photo_like_Email varchar(200) NOT NULL DEFAULT '',
  _facebook_photo_like_Url varchar(200) NOT NULL DEFAULT '',
  _facebook_photo_like_CreateDate datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  _facebook_photo_like_LastUpdate datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  _facebook_photo_like_Order int(11) NOT NULL DEFAULT '0',
  _facebook_photo_like_PrivateIP varchar(20)  NOT NULL,
  _facebook_photo_like_IP varchar(20)  NOT NULL,
  _facebook_photo_like_Status varchar(50)  NOT NULL DEFAULT 'Enable',
  PRIMARY KEY (_facebook_photo_like_ID)
);


CREATE TABLE _facebook_photo_share (
  _facebook_photo_share_ID int(11) NOT NULL AUTO_INCREMENT,
  _facebook_photo_share_UserID int(11) NOT NULL DEFAULT '0',
  _facebook_photo_share_MenuID int(11) NOT NULL DEFAULT '0',
  _facebook_photo_share_GroupID int(11) NOT NULL DEFAULT '0',
  _facebook_photo_share_FacebookID varchar(200) NOT NULL DEFAULT '',
  _facebook_photo_share_Email varchar(200) NOT NULL DEFAULT '',
  _facebook_photo_share_CreateDate datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  _facebook_photo_share_LastUpdate datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  _facebook_photo_share_Order int(11) NOT NULL DEFAULT '0',
  _facebook_photo_share_PrivateIP varchar(20) NOT NULL,
  _facebook_photo_share_IP varchar(20) NOT NULL,
  _facebook_photo_share_Status varchar(50) NOT NULL DEFAULT 'Enable',
  PRIMARY KEY (_facebook_photo_share_ID)
);


CREATE TABLE _facebook_photo_register (
  _facebook_photo_register_ID int(11) NOT NULL AUTO_INCREMENT,
  _facebook_photo_register_UserID int(20) NOT NULL,
  _facebook_photo_register_FacebookID varchar(200)  NOT NULL,
  _facebook_photo_register_Title varchar(20)  NOT NULL,
  _facebook_photo_register_FirstName varchar(255)  NOT NULL,
  _facebook_photo_register_LastName varchar(255)  NOT NULL,
  _facebook_photo_register_Email varchar(255)  NOT NULL,
  _facebook_photo_register_Phone varchar(255)  NOT NULL,
  
  _facebook_photo_register_No varchar(255)  NOT NULL,
  _facebook_photo_register_Moo varchar(255)  NOT NULL,
  _facebook_photo_register_Village varchar(255)  NOT NULL,
  _facebook_photo_register_Soi varchar(255)  NOT NULL,
  _facebook_photo_register_Road varchar(255)  NOT NULL,
  _facebook_photo_register_Tumbon varchar(255)  NOT NULL,
  _facebook_photo_register_Ampure varchar(255)  NOT NULL,
  _facebook_photo_register_Province varchar(255)  NOT NULL,
  _facebook_photo_register_Postcode varchar(255)  NOT NULL,
  
  _facebook_photo_register_CreateDate datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  _facebook_photo_register_LastUpdate datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  _facebook_photo_register_Order int(11) NOT NULL DEFAULT '0',
  _facebook_photo_register_PrivateIP varchar(20)  NOT NULL,
  _facebook_photo_register_IP varchar(20)  NOT NULL,
  _facebook_photo_register_Status varchar(50)  NOT NULL DEFAULT 'Enable',
  PRIMARY KEY (_facebook_photo_register_ID)
);