<?php
include 'igensms.php';

/* �����ǹ����Ѻ */
$user = "grandu";
$pass = "marketing";
$msg = "���ͺ �ҡ $user";
$mobilenum = "0841310888";
$customerid = "164";
/* ����ǹ���*/

$return = igensms($user, $pass, $mobilenum, $msg, $customerid);

echo $return;
?>