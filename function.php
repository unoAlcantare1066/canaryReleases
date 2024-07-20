<?php

function request(
    $url, 
    $token = null, 
    $data = null, 
    $pin = null, 
    $otpsetpin = null, 
    $uuid = null) {

    $header[] = "Host: api.gojekapi.com";
    $header[] = "User-Agent: okhttp/3.10.0";
    $header[] = "Accept: application/json";
    $header[] = "Accept-Language: id-ID";
    $header[] = "Content-Type: application/json; charset=UTF-8";
    $header[] = "X-AppVersion: 3.30.2";
    $header[] = "X-UniqueId: ".time()."57".mt_rand(1000,9999);
    $header[] = "Connection: keep-alive";
    $header[] = "X-User-Locale: id_ID";
    $header[] = "X-Location: -6.913010,107.609605"; //Bandung
    // "X-Location: 3.5938684,98.6646808"; //Location: Medan
    $header[] = "X-Location-Accuracy: 3.0";

    if($pin) {
        $header[] = "pin: $pin";
    }
    if($token) {
        $header[] = "Authorization: Bearer $token";
    }
    if($otpsetpin) {
        $header[] = "otp: $otpsetpin";
    }
    if($uuid) {
        $header[] = "User-uuid: $uuid";
    }

    // Initiate cURL
    $ch = curl_init("https://api.gojekapi.com".$url);
    
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    
    if ($data) {
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_POST, true);
    }

    $response = curl_exec($ch);
    $httpcode = curl_getinfo($ch);
    
    if (!$httpcode)
        return false;
    else {
        $header = substr($response, 0, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
        $body   = substr($response, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
    }
    
    $json = json_decode($body, true);
    return $body;
}

function save($filename, $content) {
    $save = fopen($filename, "a");
    fputs($save, "$content\r\n");
    fclose($save);
}

function name() {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://ninjaname.horseridersupply.com/indonesian_name.php");
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);    
    $ex = curl_exec($ch);
    preg_match_all('~(&bull; (.*?)<br/>&bull; )~', $ex, $name);
    return $name[2][mt_rand(0, 14) ];
    }

function getStr($a,$b,$c) {
	$a = @explode($a,$c)[1];
	return @explode($b,$a)[0];
}

function getStr1($a,$b,$c,$d) {
    $a = @explode($a,$c)[$d];
    return @explode($b,$a)[0];
}

function fetch_value($str,$find_start,$find_end) {
	$start = @strpos($str,$find_start);
    if ($start === false) {
        return "";
    }
    $length = strlen($find_start);
	$end    = strpos(substr($str,$start +$length),$find_end);
	return trim(substr($str,$start +$length,$end));
}
?>
