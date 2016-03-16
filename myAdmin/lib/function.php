<?
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
function js3_getValidIP($IP) {
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
        if (!empty($IP) && $IP == long2ip(ip2long($IP)))
        {
                // reserved IANA IPv4 addresses
                // http://www.iana.org/assignments/IPv4-address-space
                $reserved_IPs = array ( 
                                array('0.0.0.0','2.255.255.255'),
                                array('10.0.0.0','10.255.255.255'),
                                array('127.0.0.0','127.255.255.255'),
                                array('169.254.0.0','169.254.255.255'),
                                array('172.16.0.0','172.31.255.255'),
                                array('192.0.2.0','192.0.2.255'),
                                array('192.168.0.0','192.168.255.255'),
                                array('255.255.255.0','255.255.255.255')
                );

                foreach ($reserved_IPs as $r)
                {
                                $min = ip2long($r[0]);
                                $max = ip2long($r[1]);
                                if ((ip2long($IP) >= $min) && (ip2long($IP) <= $max)) return false;
                }
                return true;
        }
        else return false;
}


 // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
function php_getIP() {
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
		if (isset($_SERVER)) 
		{
			if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && js3_getValidIP($_SERVER['HTTP_X_FORWARDED_FOR'])) 
				$IP = $_SERVER['HTTP_X_FORWARDED_FOR'];
			elseif (isset($_SERVER['HTTP_CLIENT_IP']) && js3_getValidIP($_SERVER['HTTP_CLIENT_IP'])) 
				$IP = $_SERVER['HTTP_CLIENT_IP'];
			else 
				$IP = $_SERVER['REMOTE_ADDR'];
		} 
		else 
		{
			if (getenv('HTTP_X_FORWARDED_FOR') && js3_getValidIP(getenv('HTTP_X_FORWARDED_FOR'))) 
				$IP = getenv('HTTP_X_FORWARDED_FOR');
			elseif (getenv('HTTP_CLIENT_IP') && js3_getValidIP(getenv('HTTP_CLIENT_IP'))) 
				$IP = getenv('HTTP_CLIENT_IP');
			else 
				$IP = getenv('REMOTE_ADDR');
		}
	   return $IP;
 }

 // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
function php_getPrivateIP2() {
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
		if (isset($_SERVER)) 	
		{
			if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) 		
				$IP = $_SERVER['HTTP_X_FORWARDED_FOR'];		
			elseif (isset($_SERVER['HTTP_CLIENT_IP'])) 		
				$IP = $_SERVER['HTTP_CLIENT_IP'];
			else 
				$IP = $_SERVER['REMOTE_ADDR'];
		} 
		else 
		{
			if (getenv('HTTP_X_FORWARDED_FOR')) 		
				$IP = getenv('HTTP_X_FORWARDED_FOR');
			elseif (getenv('HTTP_CLIENT_IP')) 		
				$IP = getenv('HTTP_CLIENT_IP');
			else 		
				$IP = getenv('REMOTE_ADDR');
		}
		$IP=spliti(",", $IP, 2);
		return $IP[0];
  }
  
  
function php_getPrivateIP() {

    if (!empty($_SERVER['HTTP_X_FORWARED_FOR']))
    {
        $client_ip = $_SERVER['HTTP_X_FORWARED_FOR'];
    }
    elseif (!empty($_SERVER['HTTP_CLIENT_IP']))
    {
        $client_ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    else
    {
        $client_ip = $_SERVER['REMOTE_ADDR'];
    }
    return $client_ip;
}


# - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
function encodeURL($variable) {
# - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

		$key = "garnier";
		$index = 0;
		$temp="";
		$variable = str_replace("=","ðO",$variable);
		for($i=0; $i < strlen($variable); $i++)
		{
				$temp .= $variable{$i}.$key{$index};	
				$index++;
				if($index >= strlen($key)) $index = 0;
		}
		$variable = strrev($temp);
		$variable = base64_encode($variable);
		$variable = utf8_encode($variable);
		$variable = urlencode($variable);
		$variable = str_rot13($variable);

		$variable = str_replace("%","o7o",$variable);
		return "php=".$variable;

}

# - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
function decodeURL($enVariable) {
# - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
		$key = "garnier";

		$ex = explode("php=",$enVariable);
		$enVariable = $ex[1];
		$enVariable = str_replace("o7o","%",$enVariable);

		$enVariable = str_rot13($enVariable);
		$enVariable = urldecode($enVariable);
		$enVariable = utf8_decode($enVariable);
		$enVariable = base64_decode($enVariable);
		$enVariable = strrev($enVariable);

		$current = 0;
		$temp="";
		for($i=0; $i < strlen($enVariable); $i++)
		{
				if($current%2==0)
				{
					$temp .= $enVariable{$i};	
				}
				$current++;
		}
		$temp = str_replace("ðO","=",$temp);

		parse_str($temp, $variable); 
		//echo "temp=".$temp;

		foreach($variable as $key=>$value)
		{
				$_REQUEST[$key]=$value;
				global $$key; 
				$$key=$value;
		}
}

function php_getNameImage(){
	return md5(date("D M j G:i:s T Y"));
}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
function php_setPathForReady($Path=""){ 	 
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -	
	if($Path=="") return false;
	$Path=php_cleanPath($Path);
	if(is_dir($Path)) return true;

	$dir=explode("/" , $Path);
	foreach($dir as $value)
	{
		$dir2.= $value;
		if(!is_dir($dir2) && strlen($value) > 0) { mkdir($dir2,0777); } 
		$dir2.="/";
	}
	return true;
}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
function php_cleanPath($path) {  
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
    $result = array();
    $pathA = explode('/', $path);
    if (!$pathA[0]) $result[] = '';

    foreach ($pathA AS $key => $dir) {
        if ($dir == '..') {
            if (end($result) == '..') { 
                $result[] = '..';
            } elseif (!array_pop($result)) {
                $result[] = '..';
            }
        } elseif (($dir && $dir != '.') || $dir=='0') { 
            $result[] = $dir;
        }
    }
    if (!end($pathA)) $result[] = '';
    return implode('/', $result);
}

# - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
function echo_limit($LongText, $Limit=0) { 
# - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
		if(!defined("_LIMIT_TEXT_")) define("_LIMIT_TEXT_", 200);
		$Limit = ($Limit===0) ? _LIMIT_TEXT_ : $Limit;

		echo iconv_substr($LongText , 0 , $Limit , "UTF-8");  	
		if(strlen($LongText) > $Limit ) { echo "..."; } 
}

# - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
function echo_limit_return($LongText, $Limit=0) { 
# - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
		if(!defined("_LIMIT_TEXT_")) define("_LIMIT_TEXT_", 200);
		$Limit = ($Limit===0) ? _LIMIT_TEXT_ : $Limit;

		$data = iconv_substr($LongText , 0 , $Limit , "UTF-8");  	
		if(strlen($LongText) > $Limit ) { $data .= "..."; } 
		
		return $data;
}

# - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
function php_showTextLimit($LongText, $Limit=0) { 
# - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
		if(!defined("_LIMIT_TEXT_")) define("_LIMIT_TEXT_", 200);
		$Limit = ($Limit===0) ? _LIMIT_TEXT_ : $Limit;

		echo "<span title=\"".$LongText."\">".substr(stripslashes($LongText) , 0 , $Limit )."</span>";  	
		if(strlen($LongText) > $Limit ) { echo "..."; } 
}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
function UTF8toiso8859_11($string) {
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
       if ( ! ereg("[\241-\377]", $string) )
         return $string;
		 
			 $UTF8 = array(
		"\xe0\xb8\x81" => "\xa1",
		"\xe0\xb8\x82" => "\xa2",
		"\xe0\xb8\x83" => "\xa3",
		"\xe0\xb8\x84" => "\xa4",
		"\xe0\xb8\x85" => "\xa5",
		"\xe0\xb8\x86" => "\xa6",
		"\xe0\xb8\x87" => "\xa7",
		"\xe0\xb8\x88" => "\xa8",
		"\xe0\xb8\x89" => "\xa9",
		"\xe0\xb8\x8a" => "\xaa",
		"\xe0\xb8\x8b" => "\xab",
		"\xe0\xb8\x8c" => "\xac",
		"\xe0\xb8\x8d" => "\xad",
		"\xe0\xb8\x8e" => "\xae",
		"\xe0\xb8\x8f" => "\xaf",
		"\xe0\xb8\x90" => "\xb0",
		"\xe0\xb8\x91" => "\xb1",
		"\xe0\xb8\x92" => "\xb2",
		"\xe0\xb8\x93" => "\xb3",
		"\xe0\xb8\x94" => "\xb4",
		"\xe0\xb8\x95" => "\xb5",
		"\xe0\xb8\x96" => "\xb6",
		"\xe0\xb8\x97" => "\xb7",
		"\xe0\xb8\x98" => "\xb8",
		"\xe0\xb8\x99" => "\xb9",
		"\xe0\xb8\x9a" => "\xba",
		"\xe0\xb8\x9b" => "\xbb",
		"\xe0\xb8\x9c" => "\xbc",
		"\xe0\xb8\x9d" => "\xbd",
		"\xe0\xb8\x9e" => "\xbe",
		"\xe0\xb8\x9f" => "\xbf",
		"\xe0\xb8\xa0" => "\xc0",
		"\xe0\xb8\xa1" => "\xc1",
		"\xe0\xb8\xa2" => "\xc2",
		"\xe0\xb8\xa3" => "\xc3",
		"\xe0\xb8\xa4" => "\xc4",
		"\xe0\xb8\xa5" => "\xc5",
		"\xe0\xb8\xa6" => "\xc6",
		"\xe0\xb8\xa7" => "\xc7",
		"\xe0\xb8\xa8" => "\xc8",
		"\xe0\xb8\xa9" => "\xc9",
		"\xe0\xb8\xaa" => "\xca",
		"\xe0\xb8\xab" => "\xcb",
		"\xe0\xb8\xac" => "\xcc",
		"\xe0\xb8\xad" => "\xcd",
		"\xe0\xb8\xae" => "\xce",
		"\xe0\xb8\xaf" => "\xcf",
		"\xe0\xb8\xb0" => "\xd0",
		"\xe0\xb8\xb1" => "\xd1",
		"\xe0\xb8\xb2" => "\xd2",
		"\xe0\xb8\xb3" => "\xd3",
		"\xe0\xb8\xb4" => "\xd4",
		"\xe0\xb8\xb5" => "\xd5",
		"\xe0\xb8\xb6" => "\xd6",
		"\xe0\xb8\xb7" => "\xd7",
		"\xe0\xb8\xb8" => "\xd8",
		"\xe0\xb8\xb9" => "\xd9",
		"\xe0\xb8\xba" => "\xda",
		"\xe0\xb8\xbf" => "\xdf",
		"\xe0\xb9\x80" => "\xe0",
		"\xe0\xb9\x81" => "\xe1",
		"\xe0\xb9\x82" => "\xe2",
		"\xe0\xb9\x83" => "\xe3",
		"\xe0\xb9\x84" => "\xe4",
		"\xe0\xb9\x85" => "\xe5",
		"\xe0\xb9\x86" => "\xe6",
		"\xe0\xb9\x87" => "\xe7",
		"\xe0\xb9\x88" => "\xe8",
		"\xe0\xb9\x89" => "\xe9",
		"\xe0\xb9\x8a" => "\xea",
		"\xe0\xb9\x8b" => "\xeb",
		"\xe0\xb9\x8c" => "\xec",
		"\xe0\xb9\x8d" => "\xed",
		"\xe0\xb9\x8e" => "\xee",
		"\xe0\xb9\x8f" => "\xef",
		"\xe0\xb9\x90" => "\xf0",
		"\xe0\xb9\x91" => "\xf1",
		"\xe0\xb9\x92" => "\xf2",
		"\xe0\xb9\x93" => "\xf3",
		"\xe0\xb9\x94" => "\xf4",
		"\xe0\xb9\x95" => "\xf5",
		"\xe0\xb9\x96" => "\xf6",
		"\xe0\xb9\x97" => "\xf7",
		"\xe0\xb9\x98" => "\xf8",
		"\xe0\xb9\x99" => "\xf9",
		"\xe0\xb9\x9a" => "\xfa",
		"\xe0\xb9\x9b" => "\xfb",
		 );
		 
     $string=strtr($string,$UTF8);
     return $string;
 }

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
function js3_setUTF8toTIS620($string) {
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
       if ( ! ereg("[\241-\377]", $string) ) return $string;

		$UTF8 = array('à¸'=>'¡','à¸‚'=>'¢','à¸ƒ'=>'£','à¸„'=>'¤','à¸…'=>'¥','à¸†'=>'¦','à¸‡'=>'§','à¸ˆ'=>'¨','à¸‰'=>'©','à¸Š'=>'ª','à¸‹'=>'«','à¸Œ'=>'¬','à¸'=>'­','à¸Ž'=>'®','à¸'=>'¯','à¸'=>'°','à¸‘'=>'±','à¸’'=>'²','à¸“'=>'³','à¸”'=>'´','à¸•'=>'µ','à¸–'=>'¶','à¸—'=>'·','à¸˜'=>'¸','à¸™'=>'¹','à¸š'=>'º','à¸›'=>'»','à¸œ'=>'¼','à¸'=>'½','à¸ž'=>'¾','à¸Ÿ'=>'¿','à¸ '=>'À','à¸¡'=>'Á','à¸¢'=>'Â','à¸£'=>'Ã','à¸¤'=>'Ä','à¸¥'=>'Å','à¸¦'=>'Æ','à¸§'=>'Ç','à¸¨'=>'È','à¸©'=>'É','à¸ª'=>'Ê','à¸«'=>'Ë','à¸¬'=>'Ì','à¸­'=>'Í','à¸®'=>'Î','à¸¯'=>'Ï','à¸°'=>'Ð','à¸±'=>'Ñ','à¸²'=>'Ò','à¸³'=>'Ó','à¸´'=>'Ô','à¸µ'=>'Õ','à¸¶'=>'Õ','à¸·'=>'×','à¸¸'=>'Ø','à¸¹'=>'Ù','à¸º'=>'Ú','à¸¿'=>'ß','à¹€'=>'à','à¹'=>'á','à¹‚'=>'â','à¹ƒ'=>'ã','à¹„'=>'ä','à¹…'=>'å','à¹†'=>'æ','à¹‡'=>'ç','à¹ˆ'=>'è','à¹‰'=>'é','à¹Š'=>'ê','à¹‹'=>'ë','à¹Œ'=>'ì','à¹'=>'í','à¹Ž'=>'î','à¹'=>'ï','à¹'=>'ð','à¹‘'=>'ñ','à¹’'=>'ò','à¹“'=>'ó','à¹”'=>'ô','à¹•'=>'õ','à¹–'=>'ö','à¹—'=>'÷','à¹˜'=>'ø','à¹™'=>'ù','à¹š'=>'ú','à¹›'=>'û' ,'?'=>'');
		return strtr($string, $UTF8); 
}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
function UTF8toTIS620($string) { 
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
	$UTF8 = array('à¸'=>'¡','à¸‚'=>'¢','à¸ƒ'=>'£','à¸„'=>'¤','à¸…'=>'¥','à¸†'=>'¦','à¸‡'=>'§','à¸ˆ'=>'¨','à¸‰'=>'©','à¸Š'=>'ª','à¸‹'=>'«','à¸Œ'=>'¬','à¸'=>'­','à¸Ž'=>'®','à¸'=>'¯','à¸'=>'°','à¸‘'=>'±','à¸’'=>'²','à¸“'=>'³','à¸”'=>'´','à¸•'=>'µ','à¸–'=>'¶','à¸—'=>'·','à¸˜'=>'¸','à¸™'=>'¹','à¸š'=>'º','à¸›'=>'»','à¸œ'=>'¼','à¸'=>'½','à¸ž'=>'¾','à¸Ÿ'=>'¿','à¸ '=>'À','à¸¡'=>'Á','à¸¢'=>'Â','à¸£'=>'Ã','à¸¤'=>'Ä','à¸¥'=>'Å','à¸¦'=>'Æ','à¸§'=>'Ç','à¸¨'=>'È','à¸©'=>'É','à¸ª'=>'Ê','à¸«'=>'Ë','à¸¬'=>'Ì','à¸­'=>'Í','à¸®'=>'Î','à¸¯'=>'Ï','à¸°'=>'Ð','à¸±'=>'Ñ','à¸²'=>'Ò','à¸³'=>'Ó','à¸´'=>'Ô','à¸µ'=>'Õ','à¸¶'=>'Õ','à¸·'=>'×','à¸¸'=>'Ø','à¸¹'=>'Ù','à¸º'=>'Ú','à¸¿'=>'ß','à¹€'=>'à','à¹'=>'á','à¹‚'=>'â','à¹ƒ'=>'ã','à¹„'=>'ä','à¹…'=>'å','à¹†'=>'æ','à¹‡'=>'ç','à¹ˆ'=>'è','à¹‰'=>'é','à¹Š'=>'ê','à¹‹'=>'ë','à¹Œ'=>'ì','à¹'=>'í','à¹Ž'=>'î','à¹'=>'ï','à¹'=>'ð','à¹‘'=>'ñ','à¹’'=>'ò','à¹“'=>'ó','à¹”'=>'ô','à¹•'=>'õ','à¹–'=>'ö','à¹—'=>'÷','à¹˜'=>'ø','à¹™'=>'ù','à¹š'=>'ú','à¹›'=>'û');
	return strtr($string, $UTF8); 
}

# copy folder =====
function dircopy($src_dir, $dst_dir,$UploadDate=false, $verbose = false, $use_cached_dir_trees = false)
{  
	static $cached_src_dir;
	static $src_tree;
	static $dst_tree;
	$num = 0;

	if(($slash = substr($src_dir, -1)) == "\\" || $slash == "/") $src_dir = substr($src_dir, 0, strlen($src_dir) - 1);
	if(($slash = substr($dst_dir, -1)) == "\\" || $slash == "/") $dst_dir = substr($dst_dir, 0, strlen($dst_dir) - 1);
	if (!$use_cached_dir_trees || !isset($src_tree) || $cached_src_dir != $src_dir)
	{
		$src_tree = get_dir_tree($src_dir,true,$UploadDate);
		$cached_src_dir = $src_dir;
		$src_changed = true;
	}
	if (!$use_cached_dir_trees || !isset($dst_tree) || $src_changed)
		$dst_tree = get_dir_tree($dst_dir,true,$UploadDate);
	if (!is_dir($dst_dir)) mkdir($dst_dir, 0777, true);

	  foreach ($src_tree as $file => $src_mtime)
	{
		if (!isset($dst_tree[$file]) && $src_mtime === false)
			mkdir("$dst_dir/$file");
		elseif (!isset($dst_tree[$file]) && $src_mtime || isset($dst_tree[$file]) && $src_mtime > $dst_tree[$file]) 
		{
			if (copy("$src_dir/$file", "$dst_dir/$file"))
			{
				if($verbose) echo "Copied '$src_dir/$file' to '$dst_dir/$file'<br>\r\n";
				touch("$dst_dir/$file", $src_mtime);
				$num++;
			} else
				echo "<font color='red'>File '$src_dir/$file' could not be copied!</font><br>\r\n";
		}      
	}
	return $num;
}

# get_dir_tree #################################
function get_dir_tree($dir, $root = true,$UploadDate)
{
	static $tree;
	static $base_dir_length;
 
	if ($root)
	{
		$tree = array();
		$base_dir_length = strlen($dir) + 1;
	}

	if (is_file($dir))
	{
	   if($UploadDate!=false)
		{
			   if(filemtime($dir)>strtotime($UploadDate))
				$tree[substr($dir, $base_dir_length)] = date('Y-m-d H:i:s',filemtime($dir));   
		}
		else
			$tree[substr($dir, $base_dir_length)] = date('Y-m-d H:i:s',filemtime($dir));
	}
	elseif ((is_dir($dir) && substr($dir, -4) != ".svn") && $di = dir($dir) )
	{
		if (!$root) $tree[substr($dir, $base_dir_length)] = false;
		while (($file = $di->read()) !== false)
			if ($file != "." && $file != "..")
				get_dir_tree("$dir/$file", false,$UploadDate);
		$di->close();
	}
	if ($root)
		return $tree;   
}

# =============== remove directory ========================
function remove_directory($dir) {
  if ($handle = opendir($dir)) {
    while (false !== ($item = readdir($handle))) {
      if ($item != '.' && $item != '..') {
        if (is_dir($dir."/".$item)) {
          remove_directory($dir."/".$item);
        } else {
          @unlink($dir."/".$item);
         # echo  "removing ".$dir."/".$itembrn;
        }
      }
    }
    closedir($handle);
    rmdir($dir);
    #echo "removing ".$dirbrn;
  }
}


function php_checkType_File($type){
	#echo $type;
	$video = array("flv", "wmv","swf");
	if (in_array(strtolower($type), $video)) {
      return true;
	}else return false;

}
#===========================================================

function php_checkType_Image($type){
	$image = array("jpg", "gif","png");

	if (in_array(strtolower($type), $image)) {
     return true;
	}else return false;

}
#===========================================================

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
function js3_showFileSize($filename) {
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
	if(file_exists($filename))
	{
		$size = filesize($filename);
		if($size >= (1024*1024))
			return number_format(($size/(1024*1024)),2)." Mb";
		else if($size >= 1024)
			return number_format($size/1024)." Kb";
		else 
			return number_format($size)." Byte";
	}
}


// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
function php_FormatDate($style,$mydatetime, $time=false, $myBlockYear=false) {
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
		global $System_Config_MonthName,$System_Config_MonthName_Short,$session_Language,$Jigsaw_Text;
		if($mydatetime=="0000-00-00") { return $Jigsaw_Text["N/A"]; }
		if($mydatetime=="0000-00-00 00:00:00") { return $Jigsaw_Text["N/A"]; }
		if(strlen($mydatetime) < 10) {return $Jigsaw_Text["N/A"]; }

		if(strlen($mydatetime)==strlen("0000-00-00 00:00:00")) {
			$myDateTimeArray=explode(" ",$mydatetime);
			$myDateArray = explode("-",$myDateTimeArray[0]);
			#$myTimeArray = explode(":",$myDateTimeArray[1]);
			$myTime = $myDateTimeArray[1];
		} else {
			$myDateArray = explode("-",$mydatetime);
		}
		if($style=="1 January 20XX") {

			$myDay = sprintf("%d",$myDateArray[2]);
			$myYear = sprintf("%d",$myDateArray[0]);
			if($session_Language=="th") {
				return($myDay . " " . $System_Config_MonthName[$myDateArray[1]*1]. " " . (($myBlockYear)?substr(($myYear+543),0,2)."xx":($myYear+543)) . (($time==true) ? " ".$myTime : '') );
			}
			if($session_Language=="en") {
				return($myDay . " " . $System_Config_MonthName[$myDateArray[1]*1]. " " . (($myBlockYear)?substr(($myYear),0,2)."xx":$myYear). (($time==true) ? " ".$myTime: ''));
			}
		}
		if($style=="January 20XX") {
			$myDay = sprintf("%d",$myDateArray[2]);
			$myYear = sprintf("%d",$myDateArray[0]);
			if($session_Language=="th") {
				return($System_Config_MonthName[$myDateArray[1]*1]. " " . (($myBlockYear)?substr(($myYear+543),0,2)."xx":($myYear+543)) . (($time==true) ? " ".$myTime : '') );
			}
			if($session_Language=="en") {
				return($System_Config_MonthName[$myDateArray[1]*1]. " " . (($myBlockYear)?substr(($myYear),0,2)."xx":$myYear) . (($time==true) ? " ".$myTime: ''));
			}
		}
		if($style=="1 Jan XX") {
			$myDay = sprintf("%d",$myDateArray[2]);
			$myYear = sprintf("%d",$myDateArray[0]);
			if($session_Language=="th") {
				return($myDay . " " . $System_Config_MonthName_Short[$myDateArray[1]*1]. " " . (($myBlockYear)?"xx":substr($myYear+543,2,2)) . (($time==true) ? " ".$myTime : ''));
			}
			if($session_Language=="en") {
				return($myDay . " " . $System_Config_MonthName_Short[$myDateArray[1]*1]. " " . (($myBlockYear)?"xx":substr($myYear,2,2)) . (($time==true) ? " ".$myTime : ''));
			}
		}
		if($style=="1 Num XX") {
			$myDay = sprintf("%d",$myDateArray[2]);
			$myYear = sprintf("%d",$myDateArray[0]);
			if($session_Language=="th") {
				return($myDay . "/" . $myDateArray[1]. "/" . (($myBlockYear)?"xx":$myYear+543) . (($time==true) ? " ".$myTime : ''));
			}
			if($session_Language=="en") {
				return($myDay . "/" . $myDateArray[1]. "/" . (($myBlockYear)?"xx":$myYear) . (($time==true) ? " ".$myTime : ''));
			}
		}
		if($style=="1 Jan") {
			$myDay = sprintf("%d",$myDateArray[2]);
			if($session_Language=="th") {
				return($myDay . " " . $System_Config_MonthName_Short[$myDateArray[1]*1]. " " . (($time==true) ? " ".$myTime : ''));
			}
			if($session_Language=="en") {
				return($myDay . " " . $System_Config_MonthName_Short[$myDateArray[1]*1]. " " . (($time==true) ? " ".$myTime : ''));
			}
		}
		if($style=="Time") {

			#$myDay = sprintf("%d",$myDateArray[2]);
			#$myYear = sprintf("%d",$myDateArray[0]);
			if($session_Language=="th") {
				return($myTime);
			}
			if($session_Language=="en") {
				return($myTime);
			}
		}
}


function mod_get_fieldCSV($pathImportFile){
	if($pathImportFile){
		$row = 1;
		$handle = fopen($pathImportFile , "r");
		$field = "";
		while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
			if($row != 1){
				$num = count($data);
				$myField = "";
				for ($c=0; $c < $num; $c++) {
					if($data[$c]!= ""  && $data[$c]!= null ){
						$myField[]  = $data[$c];
					}
				}
				$field[] = $myField;
			}else{
				
			}
			++$row;
		}
		fclose($handle);
		return $field;

	}
	return false;
}


// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
function php_saveHtmlFile($myFile){ 	
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	if(empty($myFile["fileName"])){
		$myrand = md5($myFile["contents"] . rand(1111,9999));
		$myFilename = $myFile["menuID"]."-".$myrand.".html";
	}else{
		$myFilename = $myFile["fileName"];
	}

	$myFile["contents"]=stripslashes($myFile["contents"]);
	$fp = fopen ($myFile["path"]."/".$myFilename, "w+");
	fwrite($fp,$myFile["contents"]);
	fclose($fp);
	return $myFilename;
}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
function php_getHtmlFile($myFile, $length=0){
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
		if(file_exists($myFile) && is_file($myFile)) 
		{
			$content = file_get_contents($myFile);
			if($length > 0)
			{
					$content = substr($content , 0 , $length);
			}

			return $content ;
		}
}

function sale_price($price1 , $percent=0){
	if($percent != 0){
		$my_price = $price1 *($percent / 100);
		return $my_price;
	}else{
		return false;
	}
}


function GetFolderSize($d ="." ) {
	
    $h = @opendir($d);
    if($h==0)return 0;

    while ($f=readdir($h)){
        if ( $f!= "..") {
            $sf+=filesize($nd=$d."/".$f);
            if($f!="."&&is_dir($nd)){
                $sf+=GetFolderSize ($nd);
            }
        }
    }
    closedir($h);
    return $sf ;
}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
function php_showSize($size) {
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
		if($size >= (1024*1024))
			return number_format(($size/(1024*1024)),2)." Mb";
		else if($size >= 1024)
			return number_format($size/1024)." Kb";
		else 
			return number_format($size)." Byte";
}

# - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
function php_splitSqlCommand(&$ret, $sql, $release) {
# - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
# Power By PHP My Admin

	$sql          		= trim($sql);
	$sql_len      		= strlen($sql);
	$char         		= '';
	$string_start 	= '';
	$in_string    		= FALSE;
	$time0        		= time();

	for ($i = 0; $i < $sql_len; ++$i) {
		$char = $sql[$i];

		// We are in a string, check for not escaped end of strings except for
		// backquotes that can't be escaped
		if ($in_string) {
			for (;;) {
				$i         = strpos($sql, $string_start, $i);
				// No end of string found -> add the current substring to the
				// returned array
				if (!$i) {
					$ret[] = $sql;
					return TRUE;
				}
				// Backquotes or no backslashes before quotes: it's indeed the
				// end of the string -> exit the loop
				else if ($string_start == '`' || $sql[$i-1] != '\\') {
					$string_start      = '';
					$in_string         = FALSE;
					break;
				}
				// one or more Backslashes before the presumed end of string...
				else {
					// ... first checks for escaped backslashes
					$j = 2;
					$escaped_backslash     = FALSE;
					while ($i-$j > 0 && $sql[$i-$j] == '\\') {
						$escaped_backslash = !$escaped_backslash;
						$j++;
					}
					// ... if escaped backslashes: it's really the end of the
					// string -> exit the loop
					if ($escaped_backslash) {
						$string_start  = '';
						$in_string     = FALSE;
						break;
					}
					// ... else loop
					else {
						$i++;
					}
				} // end if...elseif...else
			} // end for
		} // end if (in string)

		// We are not in a string, first check for delimiter...
		else if ($char == ';') {
			// if delimiter found, add the parsed part to the returned array
			$ret[]      		= substr($sql, 0, $i);
			$sql        		= ltrim(substr($sql, min($i + 1, $sql_len)));
			$sql_len    	= strlen($sql);
			if ($sql_len) {
				$i      = -1;
			} else {
				// The submited statement(s) end(s) here
				return TRUE;
			}
		} // end else if (is delimiter)

		// ... then check for start of a string,...
		else if (($char == '"') || ($char == '\'') || ($char == '`')) {
			$in_string    = TRUE;
			$string_start = $char;
		} // end else if (is start of string)

		// ... for start of a comment (and remove this comment if found)...
		else if ($char == '#' || ($char == ' ' && $i > 1 && $sql[$i-2] . $sql[$i-1] == '--')) {
			// starting position of the comment depends on the comment type
			$start_of_comment = (($sql[$i] == '#') ? $i : $i-2);
			// if no "\n" exits in the remaining string, checks for "\r"
			// (Mac eol style)
			$end_of_comment   = (strpos(' ' . $sql, "\012", $i+2))
							  ? strpos(' ' . $sql, "\012", $i+2)
							  : strpos(' ' . $sql, "\015", $i+2);
			if (!$end_of_comment) {
				// no eol found after '#', add the parsed part to the returned
				// array if required and exit
				if ($start_of_comment > 0) {
					$ret[]    = trim(substr($sql, 0, $start_of_comment));
				}
				return TRUE;
			} else {
				$sql          = substr($sql, 0, $start_of_comment)
							  . ltrim(substr($sql, $end_of_comment));
				$sql_len      = strlen($sql);
				$i--;
			} // end if...else
		} // end else if (is comment)

		// ... and finally disactivate the "/*!...*/" syntax if MySQL < 3.22.07
		else if ($release < 32270
				 && ($char == '!' && $i > 1  && $sql[$i-2] . $sql[$i-1] == '/*')) {
			$sql[$i] = ' ';
		} // end else if

		// loic1: send a fake header each 30 sec. to bypass browser timeout
		$time1     = time();
		if ($time1 >= $time0 + 30) {
			$time0 = $time1;
			//header('X-pmaPing: Pong');
		} // end if
	} // end for

	// add any rest to the returned array
	if (!empty($sql) && ereg('[^[:space:]]+', $sql)) {
		$ret[] = $sql;
	}

	return TRUE;
}


# - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
function php_createDatabaseBySqlFile($sqlFile, $prefixReplace="") {
# - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
		if(file_exists($sqlFile) && is_file($sqlFile)) 
		{
				$databaseCommand = file_get_contents($sqlFile);

				$splitData=explode("|**|", $databaseCommand , 3); # ÁÕàËµØ¨Óà»ç¹·ÕèµéÍ§ ¡ÓË¹´á¤è 3 element
				$databaseCommand = $splitData[2];
				#echo "<pre>".$databaseCommand."</pre>"; //ÊÓËÃÑº·´ÊÍºâ¤é´

				if($prefixReplace!=="") # ¶éÒµéÍ§¡ÒÃá·¹·Õè Prefix
				{		
						# $splitData[0] ¤×ÍµÑÇ¡ÓË¹´ prefix ¢Í§ table µèÒ§æ ¨Ò¡ä¿Åì SQL 
						# $prefixReplace ¤×ÍµÑÇ prefix ÍÑ¹ãËÁè·Õè¨Ðá·¹·Õèä»
						$databaseCommand = str_replace($splitData[1] , $prefixReplace, $databaseCommand);
				}

				php_splitSqlCommand($sql_array, $databaseCommand, 32270);
				
				
				if(count($sql_array))
				{
					foreach($sql_array as $sql)
					{
						if($sql !== "") $dataObject = @mysql_query($sql);
					}
				}
				
		 } # ¨º¡ÒÃµÃÇ¨ÊÍºÇèÒ ä¿Åì .sql ÁÕÍÂÙèËÃ×ÍäÁè 
		 #else echo "äÁè¾ºä¿Åì SQL";
}

#- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
function php_range_date($startDate,$dayPlus,$option='0'){ # ËÒÃÐÂÐàÇÅÒ ÃÐËÇèÒ§ÇÑ¹·Õè
#- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	#$beginDate = "2009-05-1 12:00:47";
	$arrDate = explode(' ',$startDate);
	$myDate = explode('-',$arrDate[0]);
	$myTime = explode(':',$arrDate[1]);

	$start_Date = mktime($myTime[0], $myTime[1], $myTime[2], $myDate[1], $myDate[2]+$dayPlus,   $myDate[0]);
	$toDay = strtotime("NOW");
	if($start_Date < $toDay){
		return false;
	}else{
		return true;
	}

}


function php_status_content($CreateDate,$LastUpDate,$View=0 , $dayPlus=3 , $S_View=0){
		#echo $View;
		$status_new		= php_range_date($CreateDate,$dayPlus);
		$status_update	= php_range_date($LastUpDate,$dayPlus);
		if($View > $S_View) $status_hot = true;

		$_return = Array($status_new , $status_update , $status_hot);
		return $_return;
}


// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
function js3_pathUpload($subFolder=""){
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 

	global $modConfig;
	if(strlen($subFolder)>0) $subFolder.="/";

	if(defined("_PATH_"))
			$path=_PATH_."/".$subFolder;
	else
			$path=$subFolder;

	js3_setPathForReady($path);
	return $path;
}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
function js3_setPathForReady($Path=""){ 
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -	
	if($Path=="") return false;
	$Path=js3_cleanPath($Path);
	if(is_dir($Path)) return true;

	$dir=explode("/" , $Path);
	foreach($dir as $value)
	{
		$dir2.= $value;
		if(!is_dir($dir2) && strlen($value) > 0) { mkdir($dir2,0777); } # Ç¹ÅÙ»ÊÃéÒ§ path
		$dir2.="/";
	}
	return true;
}

function php_CopyFile($file,$path){
	
	#print_r($file);
	$lastName	= explode(".",$file["name"]);
	$lastName	= $lastName[count($lastName) - 1];
	$isFilename	= "img_".md5($fileupload["name"].date("His").rand(1,1000)).".".$lastName;
	#echo $isFilename;
	#exit();
	$tmp_name = $file["tmp_name"];
	if(move_uploaded_file($tmp_name, $path."/".$isFilename)) return $isFilename; else return false;

}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
function js3_UploadFile($fileupload , $option=0) {			
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	$arrReturn = array("result"=>false , "filename"=>"" ,"path"=>"" , "filetype"=>"");
	if(strlen($fileupload["name"]) <= 0) return $arrReturn; #return
	
	$information["imgSize_limit"]=5 * 1024 * 1024; #¤ÇÒÁ¨Ø ¢Í§ä¿ÅìÃÙ»  5MB
	$information["fileSize_limit"]=20 * 1024 *1024; #¤ÇÒÁ¨Ø ¢Í§ä¿ÅìÍ×è¹æ  10MB
	$information["imgW"] = (empty($option["imgW"])) ? 580 : $option["imgW"] ;  #¢¹Ò´¢Í§ÀÒ¾·ÕèµéÍ§¡ÒÃ
	$information["imgH"] =  (empty($option["imgH"])) ? 420 : $option["imgH"] ;  #¢¹Ò´¢Í§ÀÒ¾·ÕèµéÍ§¡ÒÃ
	$information["textStamp"] = (empty($option["textStamp"])) ? "<< Siam Cement Group >>" : $option["textStamp"]; #¢éÍ¤ÇÒÁ·ÕèµéÍ§¡ÒÃ stamp

	$information["path"]= (empty($option["path"])) ? "../../upload/" : $option["path"] ;
	//if(!is_dir($information["path"])) { mkdir($information["path"],0777); } # ÊÃéÒ§ path

	$dir=explode("/" , $information["path"]);
	foreach($dir as $value)
	{
		$dir2.= $value;
		if(!is_dir($dir2)) { mkdir($dir2,0777); } # Ç¹ÅÙ»ÊÃéÒ§ path
		$dir2.="/";
	}

	$File_extensions["jpg"]=array("image/jpeg", "image/jpg" , "application/jpg" , "image/pjpeg" , "image/vnd.swiftview-jpeg");
	$File_extensions["gif"]=array("image/gif", "image/x-xbitmap");
	$File_extensions["png"]=array("image/png", "application/png", "application/x-png","image/x-png");
	$File_extensions["pdf"]=array("application/pdf" , "application/x-pdf" , "application/acrobat" , "applications/vnd.pdf" , "text/pdf" , "text/x-pdf");
	$File_extensions["doc"]=array("application/msword", "application/doc" , "appl/text" , "application/vnd.msword" , "application/vnd.ms-word", "application/winword" , "application/word" , "application/x-msw6", "application/x-msword" , "zz-application/zz-winassoc-doc");
	$File_extensions["xls"]=array("application/msexcel" , "application/x-msexcel" , "application/x-ms-excel" , "application/vnd.ms-excel" , "application/x-excel" , "application/x-dos_ms_excel" , "application/xls"  , "application/x-xls", "zz-application/zz-winassoc-xls");
	$File_extensions["ppt"]=array("application/mspowerpoint" , "application/ms-powerpoint" , "application/mspowerpnt" , "application/vnd-mspowerpoint" , "application/vnd.ms-powerpoint"  , "application/powerpoint" , "application/x-powerpoint" , "application/x-mspowerpoint");
	$File_extensions["wma"]=array("audio/x-ms-wma" , "video/x-ms-asf");
	$File_extensions["wmv"]=array("video/x-ms-wmv");
	$File_extensions["zip"]=array("application/zip" , "application/x-zip" , "application/x-zip-compressed" , "application/x-compress" , "application/x-compressed" , "multipart/x-zip");		
	$File_extensions["swf"]=array("application/x-shockwave-flash", "application/x-shockwave-flash2-preview", "application/futuresplash", "image/vnd.rn-realflash");
	$File_extensions["flv"]=array("application/octet-stream" , "video/x-flv");	
	
	$File_extensions["mp3"]=array("audio/mpeg");	
	$File_extensions["docx"]=array("application/vnd.openxmlformats-officedocument.wordprocessingml.document");
	$File_extensions["xlsx"]=array("application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
	$File_extensions["pptx"]=array("application/vnd.openxmlformats-officedocument.presentationml.presentation");
	$File_extensions["txt"]=array("text/plain");
	$File_extensions["mpg"]=array("video/mpeg");
	$File_extensions["mid"]=array("audio/mid");

	$ImageFile = js3_getVariableFiletype("image");
	$otherFile = js3_getVariableFiletype("file");

	foreach($File_extensions as $key=>$value) {
			if(in_array($fileupload["type"] , $value))  $arrReturn["filetype"]=$key;
	}

	if($arrReturn["filetype"]=="") return $arrReturn; #return
	//if($arrReturn["filetype"]=="gif") return $arrReturn; #return µÍ¹¹Õéà¤Ã×èÍ§ àµÂ äÁèÁÕ GIF support µéÍ§»Ô´äÇé¡èÍ¹

	if(in_array($arrReturn["filetype"] , $ImageFile)) {
	#if(true) {
			if($fileupload["size"] > $information["imgSize_limit"]) return  $arrReturn; #return

			if($arrReturn["filetype"]=="jpg"){
				$src_img=imagecreatefromjpeg($fileupload["tmp_name"]); 
			} else if($arrReturn["filetype"]=="gif"){
				$src_img=imagecreatefromgif($fileupload["tmp_name"]); 
			} else if($arrReturn["filetype"]=="png"){
				$src_img=imagecreatefrompng($fileupload["tmp_name"]); 
			}

			$isFilename= (empty($option["filename"])) ? "img_".md5($fileupload["name"].date("His").rand(1,1000)) : $option["filename"] ;
			$old_w=imagesx($src_img); 
			$old_h=imagesy($src_img);
			$source_w=$old_w;
			$source_h=$old_h;


			if($option["fixSizeByWidthHeight"])
			{
					if($old_w < $information["imgW"]) $information["imgW"]=$old_w;
					if($old_h < $information["imgH"]) $information["imgH"]=$old_h;

					if($old_w >= $information["imgW"])
					{
						$percent=($information["imgW"]*100)/$old_w;

						if($percent < 80)
						{
							$how=$old_w/($information["imgW"]*1.2); 
							$new_w=floor($old_w/$how); 
							$new_h=floor($old_h/$how); 

							$dst_img_crop=imagecreatetruecolor($new_w,$new_h); 
							imagecopyresampled($dst_img_crop,$src_img,0,0,0,0,$new_w,$new_h,$old_w,$old_h); 		

							$old_w=$new_w;
							$old_h=$new_h;
						}
						else $dst_img_crop=$src_img;

						# àµÃÕÂÁµÑÇ crop
						$new_w=$information["imgW"];
						$new_h=$information["imgH"];

						# ¤Ó¹Ç³¨Ø´ X , Y à¾×èÍËÒ¨Ø´¾ÍàËÁÒÐ
						if($source_w > $source_h) # ¶éÒ ¡ÇéÒ§ÁÒ¡¡ÇèÒÊÙ§ ¨Ðà»ç¹ÀÒ¾á¹Ç¹Í¹
						{
							$X=floor(($old_w-$new_w)/2);
							$Y=floor(($old_h-$new_h)/2);
						}
						else # ÀÒ¾á¹ÇÊÙ§
						{
							$X=floor(($old_w-$new_w)/2);
							$Y=floor(($old_h-$new_h)/6);
						}

						$dst_img=imagecreatetruecolor($new_w,$new_h); 
						imagecopy($dst_img, $dst_img_crop, 0, 0, $X, $Y, $new_w, $new_h);					
					}
			}
			else if($option["fixSizeByWidth"])
			{
					$how=$old_w/$information["imgW"]; 
					$new_w=$information["imgW"];
					$new_h=floor($old_h/$how); 
					$dst_img=imagecreatetruecolor($new_w,$new_h); 
					imagecopyresampled($dst_img,$src_img,0,0,0,0,$new_w,$new_h,$old_w,$old_h); 
			}
			else if($option["fixSizeByHeight"])
			{
					$how=$old_h/$information["imgH"]; 
					$new_w=floor($old_w/$how); 
					$new_h=$information["imgH"];
					$dst_img=imagecreatetruecolor($new_w,$new_h); 
					imagecopyresampled($dst_img,$src_img,0,0,0,0,$new_w,$new_h,$old_w,$old_h); 
			}
			else
			{
				if (($old_w<$information["imgW"]) and ($old_h<$information["imgH"])) { 
					$new_h=$old_h; 
					$new_w=$old_w; 
				} 
				else 
				{ 
					if ($old_w>$old_h) { 
							$how=$old_w/$information["imgW"]; 
							$new_w=floor($old_w/$how); 
							$new_h=floor($old_h/$how); 
					} else { 
							$how=$old_h/$information["imgH"]; 
							$new_w=floor($old_w/$how); 
							$new_h=floor($old_h/$how); 
					} 
				}
				$dst_img=imagecreatetruecolor($new_w,$new_h); 
				imagecopyresampled($dst_img,$src_img,0,0,0,0,$new_w,$new_h,$old_w,$old_h); 
			} 
			
			
			
	
			if(file_exists($information["path"]."/".$isFilename.".".$arrReturn["filetype"])) unlink($information["path"]."/".$isFilename.".".$arrReturn["filetype"]);			

			if($arrReturn["filetype"]=="jpg")
				imagejpeg($dst_img,$information["path"].$isFilename.".".$arrReturn["filetype"],100); 
			elseif($arrReturn["filetype"]=="gif")
				imagegif($dst_img,$information["path"]."/".$isFilename.".".$arrReturn["filetype"]); 
			else
				imagepng($dst_img,$information["path"]."/".$isFilename.".".$arrReturn["filetype"]); 
			
			imagedestroy($src_img); 
			imagedestroy($dst_img); 

			$arrReturn["result"]=true;
			$arrReturn["filename"]=$isFilename.".".$arrReturn["filetype"];
			$arrReturn["name"]=$fileupload["name"];
			$arrReturn["path"]=$information["path"];
			
	} elseif(in_array($arrReturn["filetype"] , $otherFile)) {
		
			if($fileupload["size"] > $information["fileSize_limit"]) return  $arrReturn; #return
			$isFilename= (empty($option["filename"])) ? "file_".md5($fileupload["name"].date("His").rand(1,1000)) : $option["filename"] ;
			if(file_exists($information["path"]."/".$isFilename.".".$arrReturn["filetype"])) unlink($information["path"]."/".$isFilename.".".$arrReturn["filetype"]);
			if(move_uploaded_file($fileupload["tmp_name"] , $information["path"]."/".$isFilename.".".$arrReturn["filetype"])) {				
				$arrReturn["result"]=true;
				$arrReturn["filename"]=$isFilename.".".$arrReturn["filetype"];
				$arrReturn["name"]=$fileupload["name"];
				$arrReturn["path"]=$information["path"];
			}
	}
	return $arrReturn; #return
}


// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
function js3_getVariableFiletype($type=""){
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	$ImageFile = array("jpg" ,"jpeg", "gif" , "png","JPG");
	$otherFile = array("pdf" , "doc" ,"docx" , "xls" , "ppt" , "wma", "wmv" , "zip" , "swf", "txt","mpg","mp3", "flv" , "docx" , "xlsx" , "pptx" , "mid" );
	if($type=="image") return $ImageFile;
	else if($type=="file") return $otherFile;
	else return $allFile = array_merge($ImageFile, $otherFile);
}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
function js3_cleanPath($path) {
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

    $result = array();
    $pathA = explode('/', $path);
    if (!$pathA[0]) $result[] = '';

    foreach ($pathA AS $key => $dir) {
        if ($dir == '..') {
            if (end($result) == '..') { 
                $result[] = '..';
            } elseif (!array_pop($result)) {
                $result[] = '..';
            }
        } elseif (($dir && $dir != '.') || $dir=='0') {  
            $result[] = $dir;
        }
    }
    if (!end($pathA)) $result[] = '';
    return implode('/', $result);
}

function php_write_file($src_file,$content){ // write file

	$strFileName = $src_file;
	$objFopen = fopen($strFileName, 'w');
	fwrite($objFopen, php_spcial_char($content));
		if($objFopen)
		{
			fclose($objFopen);
			return true;
		}
		else
		{
			fclose($objFopen);
			return false;
		}
		
}

function php_read_file($src_file){
	$strFileName = $src_file;
	$objFopen = fopen($strFileName, 'r');
	if ($objFopen) {
		$file = "";
		while (!feof($objFopen)) {
			$file .= fgets($objFopen, 4096);
		}
		fclose($objFopen);
		return $file;
	}
	return false;
}

function php_check_file_size($file_size){ 

	$_my_upload_size = GetFolderSize("../../upload");
    $_percent_upload_size = ($_my_upload_size + $file_size) * 100 / _SYSTEM_UPLOAD_FILE_LIMIT_;
	if($_percent_upload_size <= 100) return true;
	else return false;
	#return  $_percent_upload_size;
}

function php_sendmail($address,$subject,$content,$name,$bcc,$form_name=""){
	
		$order_true 				= 0;
		$mail 						= new PHPMailer();
		$mail->IsSMTP();
		$mail->Host 				= "localhost";  // specify main and backup server
		$mail->SMTPAuth	= true;     // turn on SMTP authentication
		$mail->Username 	= "info@grandunity.com";  // SMTP username
		$mail->Password 		= "zaq12wsx"; // SMTP password
		$mail->Timeout 		= 300;
		$mail->SMTPKeepAlive = true;
		$mail->IsHTML(true);
		$mail->CharSet 		= "UTF-8";
		$mail->From 			= "info@grandu.co.th";
		$mail->FromName 	= $form_name;
		
		$mail->ClearAllRecipients();
		if($bcc){
			$count_bcc = count($bcc);
			for($i=0;$i<$count_bcc;$i++){
			   $mail->AddBCC($bcc[$i],$bcc[$i]);
			}
		}

		$mail->AddAddress($address,$name);
		$mail->Subject = $subject ;
		$mail->Body = $content;
		if(!$mail->Send()){
			$textreturn = "ERROR";
		} else {
			$textreturn = "OK";
		}
		
		$mail->SmtpClose();
	    return($textreturn);
}

function php_org_send_mail($to,$subject,$message,$from){
	
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";

	// Additional headers
	$headers .= 'From: '.$from.'' . "\r\n";

	// Mail it
	if(mail($to, $subject, $message, $headers)){
		return "OK";
	}else{
		return "ERROR";
	}
}



function php_spcial_char($str){
	$_my_str = str_replace("\\", "", $str);
	return $_my_str;
}

function php_spcial_charSp1($str){
	$_my_str = str_replace("\\'", "'", $str);
	#$_my_str = str_replace('\"', '"', $str);
	return $_my_str;
}

function php_split_p($str){
	$vowels = array("<p>", "</p>","\\");
	return str_replace($vowels, "",$str);
}

function php_on_off_data($_status , $_startDate , $_endDate){

	if($_status == "Yes"){
		$_today 			= strtotime(date("Y-m-d"));
		$_begin_date 	= strtotime($_startDate);
		$_end_date 	= strtotime($_endDate);

		if(($_today >= $_begin_date) && ($_today <= $_end_date)){
			return true;
		}else{
			return false;
		}
	
	}else{
		return true;
	}
}

function utf_tis($str){
	return iconv("UTF-8", "TIS-620", $str); 
}



function php_split_http($str){
	$str_p = strpos($str,"http://");
	if($str_p === false){
		$_str = "http://".$str;
	}else{
		$_str = $str;
	}
	return $_str;
}


function php_split_video($str){
	$vowels = array("/watch?", "=");
	return str_replace($vowels, "/",$str);
}

function php_spcial_decode_char($str){
	return str_replace('\"', '"', $str);
}

function php_write_to_file($path='',$filename,$str){
	js3_setPathForReady($path);
	$fp = fopen($path.$filename, 'w');
	fwrite($fp, $str);
	fclose($fp);
}

function php_create_name_html($filename){
	return $filename."_".date("Y_m_d_H_i_s").".htm";
}

function php_readfile($file=""){
	
	if($file){
		if ($fd = @fopen ($file, "r")){
			$result="";
			
			if($fd){
				while(!feof($fd)) {
				   $buffer = fread($fd, 2048);
					$result = $result.$buffer;
				}
				fclose ($fd);
			}
			return $result;
			}else{
				return "0";
		}
	}
}

function php_2digit($row_index){

	return substr('00'.$row_index,-2);

}

function php_remove_dir($dir , $s1 , $repare){
	
	return str_replace($s1, $repare ,$dir);
		
}

function php_money_format($money){
	
	return @number_format($money,"2",".",",");
	
}

function php_view_format($view){
	
	return number_format($view);
	
}

function php_order_product($_no_order){
	return "No.".substr('0000000'.$_no_order,-7);
		
}


function php_encode_html($str){
	return mysql_real_escape_string($str);
}

function php_decode_html($str){
	$vowels = array("\\", "<p>" , "</p>");
	#return strip_tags(str_replace($vowels,"",$str));
	return (str_replace($vowels,"",$str));
}


function php_decode_html2($str){
	$vowels = array("\\", "<p>" , "</p>" ,"<br>" ,"397");
	return trim(strip_tags(str_replace($vowels,"",$str)));
}

function php_decode_confirm(){
	
	/*new*/
	return date("Y-md-His");
	
}


function php_replair_comment($comment){
	
	$_repair = '<div id="id_repair"> <em>- reply -</em>';
	$_repair .= $comment;
	$_repair .= '<em>- reply -</em> </div><br>';
	
	return $_repair;
	
}

function php_decode_file($file){
	
	$arr_file 		= explode(".",$file);
	$last				= count($arr_file)-1;
	$encode 		= date("Y-m-d h:i:s A");
	return md5($encode).".".$arr_file[$last];
}


function php_save_array_to_file($filename,$b)
{
	
	if (!is_resource($filename)) 
	{
		if (!$file = fopen($filename,'a')) return false;
	} else {
		$file = $filename;
	}
	fwrite($file, $b."\n");
	return true;
}
	
	
function php_read_array_from_file($filename)
{
	$objFopen = fopen($filename, 'r');
	if ($objFopen) {
		while (!feof($objFopen)) {
			$get_file	= fgets($objFopen, 4096);
			if($get_file){
				$arr_file[] = $get_file;
			}
		}
		fclose($objFopen);
	}
	#echo count($arr_file);
	return $arr_file;
}


function php_count_address($url){
	
	$arr_url	= explode(".",$url);
	if(count($arr_url) > 2){
		$return = $url;
	}else{
		$return = $url._SYSTEM_DOMAIN_;
	}
	return php_split_http($return);
}



/*begin check domain*/

function checkDomain($domain , $ext){
	$findText	= "No match for";
	$server 	= "whois.crsnic.net";
	
	
	$domain 	= $domain.".".$ext;
	// Open a socket connection to the whois server
	$con = fsockopen($server, 43);
	if (!$con) return false;
	// Send the requested doman name
	set_time_limit(0);
	fputs($con, $domain);
	// Read and store the server response
	$response = ' :';
	while(!feof($con)) {
		$response .= fgets($con,128); 
	}
	// Close the connection
	fclose($con);
	echo $domain.$response;
	// Check the response stream whether the domain is available
	if (strpos($response, $findText)){
		return 1;
	} else {
		return 0;   
	}

}
/*end check domain*/






#time time ago
function time_stamp($session_time) { 

	$time_difference = time() - $session_time ; 
	
	$seconds = $time_difference ; 
	$minutes = round($time_difference / 60 );
	$hours = round($time_difference / 3600 ); 
	$days = round($time_difference / 86400 ); 
	$weeks = round($time_difference / 604800 ); 
	$months = round($time_difference / 2419200 ); 
	$years = round($time_difference / 29030400 ); 
	// Seconds
	if($seconds <= 60)
	{
	echo "$seconds seconds ago"; 
	}
	//Minutes
	else if($minutes <=60)
	{
	
	   if($minutes==1)
	  {
	   echo "one minute ago"; 
	   }
	   else
	   {
		echo "$minutes minutes ago"; 
	   }
	
	}
	//Hours
	else if($hours <=24)
	{
	
	   if($hours==1)
	  {
	   echo "one hour ago";
	  }
	  else
	  {
	   echo "$hours hours ago";
	  }
	
	}
	//Days
	else if($days <= 7)
	{
	
	  if($days==1)
	  {
	   echo "one day ago";
	  }
	  else
	  {
	   echo "$days days ago";
	   }
	
	}
	//Weeks
	else if($weeks <= 4)
	{
	
	   if($weeks==1)
	  {
	   echo "one week ago";
	   }
	  else
	  {
	   echo "$weeks weeks ago";
	  }
	
	}
	//Months
	else if($months <=12)
	{
	
	   if($months==1)
	  {
	   echo "one month ago";
	   }
	  else
	  {
	   echo "$months months ago";
	   }
	
	}
	//Years
	else
	{
	
	   if($years==1)
	   {
		echo "one year ago";
	   }
	   else
	  {
		echo "$years years ago";
	   }
	
	}
} 


#time time ago
function time_stamp_thai($session_time) { 

	$time_difference 	= time() - $session_time ; 
	
	$seconds 			= $time_difference ; 
	$minutes 				= round($time_difference / 60 );
	$hours 				= round($time_difference / 3600 ); 
	$days 					= round($time_difference / 86400 ); 
	$weeks 				= round($time_difference / 604800 ); 
	$months 				= round($time_difference / 2419200 ); 
	$years 					= round($time_difference / 29030400 ); 
	// Seconds
	if($seconds <= 60)
	{
	echo "$seconds วินาทีที่แล้ว"; 
	}
	//Minutes
	else if($minutes <=60)
	{
	
	   if($minutes==1)
	  {
	   echo "1 นาทีที่แล้ว"; 
	   }
	   else
	   {
		echo "$minutes นาทีที่แล้ว"; 
	   }
	
	}
	//Hours
	else if($hours <=24)
	{
	
	   if($hours==1)
	  {
	   echo "1 ชั่วโมงที่แล้ว";
	  }
	  else
	  {
	   echo "$hours ชั่วโมงที่แล้ว";
	  }
	
	}
	//Days
	else if($days <= 7)
	{
	
	  if($days==1)
	  {
	   echo "1 วันที่แล้ว";
	  }
	  else
	  {
	   echo "$days วันที่แล้ว";
	   }
	
	}
	//Weeks
	else if($weeks <= 4)
	{
	
	   if($weeks==1)
	  {
	   echo "1 อาทิตย์ที่แล้ว";
	   }
	  else
	  {
	   echo "$weeks อาทิตย์ที่แล้ว";
	  }
	
	}
	//Months
	else if($months <=12)
	{
	
	   if($months==1)
	  {
	   echo "1 เดือนที่แล้ว";
	   }
	  else
	  {
	   echo "$months เดือนที่แล้ว";
	   }
	
	}
	//Years
	else
	{
	
	   if($years==1)
	   {
		echo "1 ปีที่แล้ว";
	   }
	   else
	  {
		echo "$yearsปีที่แล้ว";
	   }
	
	}
} 


function php_check_session(){
	
	if(!$_SESSION["Like_ID"]){
		
		echo "<script>window.location = '../sys_login/';<script>";
		
	}
	
}


function php_getDay($date){
	
	$_arr_date 	= explode(" ",$date);	
	$_arr_date	= explode("-",$_arr_date[0]);
	
	return $_arr_date[2];
	
}

function php_getmyMonth($date){
	$System_Config_MonthName_Shorted 		= array("","Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
	
	$_arr_date 	= explode(" ",$date);	
	$_arr_date	= explode("-",$_arr_date[0]);
	$month			= $_arr_date[1];
	$month			= $System_Config_MonthName_Shorted[$month*1];
	#$month			= "Dec";
	return $month;
	
}

function php_getYear($date){
	
	$_arr_date 	= explode(" ",$date);	
	$_arr_date	= explode("-",$_arr_date[0]);
	
	return $_arr_date[0];
	
}

function php_sprit_url($str){
	
	$vowels = array(" ", "/" , "?" ,"\"","\'");
	return strip_tags(str_replace($vowels,"-",$str));
	
}

function php_sprit_title($str){
	
	$vowels = array('\'',"\"");
	return strip_tags(str_replace($vowels,"",$str));
	
}


function php_decode_url($str){
	
	$vowels = array("-");
	return strip_tags(str_replace($vowels," ",$str));
	
}

function php_workStatus($status)
{
	if($status == 1)
		$_return = '<span style="color:#090;">ตรวจสอบเรียบร้อย</span>';	
	else
		$_return = '<span style="color:#F30;">รอการตรวจสอบ</span>';	
	
	return $_return;
}


function php_phone_format($phone)
{
	
	$_p1 		=	substr($phone, 0 , 3);
	$_p2 		=	substr($phone, 6 , 4);

	$_phone	= $_p1."-XXX-".$_p2;
	return $_phone;	
	
}


function js_processtime(){
	
	$time 	= microtime();
	$time 	= explode(' ', $time);
	$time 	= $time[1] + $time[0];
	#$start 	= $time;
	return $time;

}

function js_total_processtime($start,$finish){
	
	/*$time = microtime();
	$time = explode(' ', $time);
	$time = $time[1] + $time[0];
	$finish = $time;*/
	$total_time = round(($finish - $start), 4);
	#echo 'Page generated in '.$total_time.' seconds.';
	return $total_time;

}


function php_check_http($str)
{
	if($str){
		$str_p = strpos($str , "http://");
		if($str_p === false){
			$_str = true;
		}else{
			$_str = false;
		}
	}
	return $_str;
}

function php_savefile_url($path,$name)
{
	$newPath = "../myAdmin/upload/_grandumember/".$_SESSION["Web_CardID"]."/"; 
	php_setPathForReady($newPath);
	//Get the file
	$content 	= curl($path);
	//Store in the filesystem.
	$fp 			= fopen($newPath.$name, "w");
	fwrite($fp, $content);
	fclose($fp);
}


function curl($url) 
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    $data = curl_exec($ch);
    curl_close($ch);

    return $data;
}

function php_split_mem($str){
	$sprit = array("6-ค่างวด","(",")");
	return str_replace($sprit , "" ,$str);
}


  
function num2wordsThai($num){   
	$num=str_replace(",","",$num);
	$num_decimal=explode(".",$num);
	$num=$num_decimal[0];
    $returnNumWord;   
    $lenNumber=strlen($num);   
    $lenNumber2=$lenNumber-1;   
    $kaGroup=array("","สิบ","ร้อย","พัน","หมื่น","แสน","ล้าน","สิบ","ร้อย","พัน","หมื่น","แสน","ล้าน");   
    $kaDigit=array("","หนึ่ง","สอง","สาม","สี่","ห้า","หก","เจ็ต","แปด","เก้า");   
	$kaDigitDecimal=array("ศูนย์","หนึ่ง","สอง","สาม","สี่","ห้า","หก","เจ็ต","แปด","เก้า");   
    $ii=0;   
    for($i=$lenNumber2;$i>=0;$i--){   
        $kaNumWord[$i]=substr($num,$ii,1);   
        $ii++;   
    }   
    $ii=0;   
    for($i=$lenNumber2;$i>=0;$i--){   
        if(($kaNumWord[$i]==2 && $i==1) || ($kaNumWord[$i]==2 && $i==7)){   
            $kaDigit[$kaNumWord[$i]]="ยี่";   
        }else{   
            if($kaNumWord[$i]==2){   
                $kaDigit[$kaNumWord[$i]]="สอง";        
            }   
            if(($kaNumWord[$i]==1 && $i<=2 && $i==0) || ($kaNumWord[$i]==1 && $lenNumber>6 && $i==6)){   
                if($kaNumWord[$i+1]==0){   
                    $kaDigit[$kaNumWord[$i]]="หนึ่ง";      
                }else{   
                    $kaDigit[$kaNumWord[$i]]="เอ็ด";       
                }   
            }elseif(($kaNumWord[$i]==1 && $i<=2 && $i==1) || ($kaNumWord[$i]==1 && $lenNumber>6 && $i==7)){   
                $kaDigit[$kaNumWord[$i]]="";   
            }else{   
                if($kaNumWord[$i]==1){   
                    $kaDigit[$kaNumWord[$i]]="หนึ่ง";   
                }   
            }   
        }   
        if($kaNumWord[$i]==0){   
			if($i!=6){
	            $kaGroup[$i]="";   
			}
        }   
        $kaNumWord[$i]=substr($num,$ii,1);   
        $ii++;   
        $returnNumWord.=$kaDigit[$kaNumWord[$i]].$kaGroup[$i];   
    }      
	if(isset($num_decimal[1])){
		$returnNumWord.="จุด";
		for($i=0;$i<strlen($num_decimal[1]);$i++){
				$returnNumWord.=$kaDigitDecimal[substr($num_decimal[1],$i,1)];	
		}
	}		
    return $returnNumWord;   
}   

?>