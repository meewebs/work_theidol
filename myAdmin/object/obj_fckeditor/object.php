<meta name="robots" content="noindex, nofollow">
   <link href="../sample.css" rel="stylesheet" type="text/css" />
<?
include("../../object/obj_fckeditor/fckeditor.php") ;

// Automatically calculates the editor base path based on the _samples directory.
// This is usefull only for these samples. A real application should use something like this:
// $oFCKeditor->BasePath = '/fckeditor/' ;	// '/fckeditor/' is the default value.
$sBasePath = $_SERVER['PHP_SELF'] ;
$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "_samples" ) ) ;

$oFCKeditor = new FCKeditor('editor') ;
$oFCKeditor->BasePath = $sBasePath ;
$oFCKeditor->ToolbarSet = htmlspecialchars("Default");
$oFCKeditor->Height = $object_Height?$object_Height:400;

$oFCKeditor->Value = $obj_value;
$oFCKeditor->Create() ;

?>