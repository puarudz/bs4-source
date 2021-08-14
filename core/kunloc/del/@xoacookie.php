<?php
set_time_limit(0);
require("../../../config.php");
$SQL = mysqli_query($kunloc,'SELECT * FROM cookie');
while($echo = mysqli_fetch_object($SQL)){
    $idfb= $echo->fbid;
    $cookie= $echo->cookie;
    $token= $echo->token;
    $fb_dtsg = $echo->fb_dtsg;
    $check = json_decode(auto('https://graph.facebook.com/me?access_token='.$token.''),true);
    $dtsg = 'Mã Không Xác Định';
        if(!$check[id] || $fb_dtsg == $dtsg){
            mysqli_query($kunloc,"DELETE FROM `cookie` WHERE fbid = '".$idfb."'");
               continue;    
            }else{
            //echo ''.$token.'<br>';
            echo ''.$cookie.'<hr>';
            echo 'fb_dtsg = '.$fb_dtsg.'<hr>';
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


