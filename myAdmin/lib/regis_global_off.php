<?
//===register_globals = Off ========
if($_GET){extract($_GET, EXTR_PREFIX_SAME, "wddx");}else if($_POST){extract($_POST, EXTR_PREFIX_SAME, "wddx");}
if($_SESSION ){extract($_SESSION, EXTR_PREFIX_SAME, "wddx");}
if($_FILES){extract($_FILES, EXTR_PREFIX_SAME, "wddx");}
if($_SERVER){extract($_SERVER, EXTR_PREFIX_SAME, "wddx");}
if($_REQUEST){extract($_REQUEST, EXTR_PREFIX_SAME, "wddx");}
?>