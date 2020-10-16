<?php
error_reporting(0);
function curl($url = '', $var = '', $echo = '', $ref = '', $header = false)
	{
		global $config, $sock;
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_NOBODY, $header);
		curl_setopt($curl, CURLOPT_TIMEOUT, 150);
		curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:80.0) Gecko/20100101 Firefox/80.0');
		if ($var) {
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $var);
		}
		curl_setopt($curl, CURLOPT_COOKIEFILE, $config['cookie_file']);
		curl_setopt($curl, CURLOPT_COOKIEJAR, $config['cookie_file']);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($curl);
		curl_close($curl);
		return $result;
	}


if(!empty($_GET['token'])) {
$access_token = $_GET['token'];
}
if($access_token == null) {
echo 'Token Not Found';
}
if(!empty($_GET['type'])) {
$type = $_GET['type'];
}
if($type == null) {
echo 'Type Not Found';
}

$stat = json_decode(curl('https://graph.facebook.com/v2.11/me/home?fields=id&limit=5&access_token='.$access_token), true);
for ($i = 1; $i <= count($stat['data']); $i++) {
if (!preg_match($stat['data'][$i - 1]['id'], $log)) {
curl("https://graph.facebook.com/v2.11/".$stat['data'][$i - 1]['id']."/reactions?", array(
"type"=>$type,
"method"=>"post",
"access_token"=>$access_token));

echo 'Content ID : '.$stat['data'][$i - 1]['id'].' <span style="color:green"> [SUCCESS]</span> Reacted // Script by FADXPL017<br>';
}
sleep(0);
}
?>
