<?php
set_time_limit(0); 
require("../../../config.php");
$SQL = mysqli_query($kunloc,"SELECT `token` FROM `token`");
while($echo = mysqli_fetch_assoc($SQL)){
	$token = $echo['token'];
	$me = json_decode(auto('https://graph.facebook.com/me?access_token='.$token),true);
	if(!isset($me['id']) && !preg_match('|@tfbnw.net|',$me['email'])){
        mysqli_query($kunloc,"DELETE FROM `token` WHERE `token` = '".$token."'");
	}else{
	echo $token.'</br>';
	}
}
function auto($url){
   $data = curl_init();
   curl_setopt($data, CURLOPT_RETURNTRANSFER,1);
   curl_setopt($data, CURLOPT_URL, $url);
   $hasil = curl_exec($data);
   curl_close($data);
   return $hasil;
   }
?>