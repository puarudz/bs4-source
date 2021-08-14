<?php
set_time_limit(0); 
require("../../../config.php");
$SQL= mysqli_query($kunloc,"SELECT clone FROM clone");
while($echo = mysqli_fetch_assoc($SQL)){
	$clone = $echo['clone'];
	$token = explode("|",$clone)[2];
	//$ids = explode("|",$clone)[0];
	$me = json_decode(file_get_contents('https://graph.facebook.com/me?access_token='.$token),true);
	if(!isset($me['id']) && !preg_match('|@tfbnw.net|',$me['email'])){
		mysqli_query($kunloc,"DELETE FROM clone WHERE token = '".$token."'");
	}else{
	//echo $clone.'</br>';
	}
}
?>