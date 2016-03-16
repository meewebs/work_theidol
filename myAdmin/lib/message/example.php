<?php
include 'igensms.php';

/* แก้ไขส่วนนี้ครับ */
$user = "grandu";
$pass = "marketing";
$msg = "ทดสอบ จาก $user";
$mobilenum = "0841310888";
$customerid = "164";
/* จบส่วนแก้ไข*/

$return = igensms($user, $pass, $mobilenum, $msg, $customerid);

echo $return;
?>