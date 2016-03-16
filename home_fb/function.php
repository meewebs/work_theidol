<?php

function get_fanLike($page_id){
	//$page_id = "205789412767791"; 
	$likes = 0; //Initialize the count
	 
	//Construct a Facebook URL
	$json_url 			= 'https://graph.facebook.com/'.$page_id;
	$json 				= @file_get_contents($json_url);
	$json_output 	= json_decode($json);
	 
	//Extract the likes count from the JSON object
	if($json_output->likes){
		$likes = $json_output->likes;
		$totalLike = substr('000000'.$likes,-6);
	}
	
	return $totalLike;
	
}

?>