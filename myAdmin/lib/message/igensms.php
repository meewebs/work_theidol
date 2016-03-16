<?php
function igensms($user, $pass, $mobilenum, $msg, $customerid) {
    $user = urlencode($user);
    $pass = urlencode($pass);
    $msg = urlencode($msg);
    $customerid = urlencode($customerid);
    $mobilenum = urlencode($mobilenum);

    $posturl = 'http://www.igen.co.th/isms/home/smsapi.php';
    $postdata = 'sUser='.$user.'&sPassword='.$pass.'&sCustomerid='.$customerid.'&Msg='.$msg.'&Msn='.$mobilenum;

    $url_info = parse_url( $posturl );

//echo $posturl."<br>\n";
//print_r($url_info);

    $fp = fsockopen( $url_info['host'], 80, $errno, $errstr, 30);

    /* make sure opened ok */
    if( !$fp )
    return false;

    /* HTTP POST headers */
    $out = 'POST ' . (isset($url_info['path'])?$url_info['path']:'/') .
    (isset($url_info['query'])?'?' . $url_info['query']:'') . ' HTTP/1.0' . "\r\n";
    $out .= 'Host: ' . $url_info['host'] . "\r\n";
    $out .= 'User-Agent: PHPPost/1.0'."\r\n";
    $out .= "Content-Type: application/x-www-form-urlencoded\r\n";
    $out .= 'Content-Length: ' . strlen( $postdata ) . "\r\n";
    $out .= 'Connection: Close' . "\r\n\r\n";
    $out .= $postdata;

//echo $out."<br>\n";exit;

    fwrite($fp, $out);

    /* read any response */
    for( ;!feof( $fp ); )
    $contents .= fgets($fp, 4096);

    /* seperate content and headers */
    list($headers, $content) = explode( "\r\n\r\n", $contents, 2 );

    return $content;
}
?>
