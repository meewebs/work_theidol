<?
session_start();
session_unset();
session_destroy();

setcookie("G_Username", "", time()-(10*24*60*60*1000));
setcookie("G_Password", "", time()-(10*24*60*60*1000));

header("Location: index.php");
?>
