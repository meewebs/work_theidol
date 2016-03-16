<?
require_once("rb.php");

	R::setup('mysql:host=localhost; dbname=mee_test','root','root');
	//echo _TABLE_;
	$book = R::dispense('mod_data');
	
	print_r($book);
	$book->code 	= 'A123';
	$book->title 		= 'DEFs';
	
	
	$id = R::store($book);
	echo $id;
	echo _TABLE_;
?>
