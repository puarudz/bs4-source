<?php
/*
========================================================================
- CẢNH BÁO: CHỈNH SỬA FILE config CÓ THỂ GÂY ẢNH HƯỞNG TỚI HOẠT ĐỘNG CỦA WEB.
- CHÚNG TÔI ĐÃ MÃ HÓA 1 VÀI PHẦN TỬ ĐỂ TRÁNH KẺ XẤU BUG - KHAI THÁC WEB!
========================================================================
- CÀI ĐẶT CONFIG THEO THỨ TỰ:
+ DÒNG #1: TÊN DATABASE
+ DÒNG #2: TÊN USER
+ DÒNG #3: MẬT KHẨU 
*/
error_reporting(0);
header("Content-type: text/html; charset=utf-8");
date_default_timezone_set('Asia/Ho_Chi_Minh');
$db_name = 'xxx';#1
$db_username = "xxx";#2
$db_password = "xxxx";#3
$host_name = "localhost";
$kunloc = new mysqli($host_name, $db_username, $db_password, $db_name);
mysqli_set_charset($kunloc, 'UTF8');
if ($kunloc->connect_error) 
{
die('Error : ('. $kunloc->connect_errno .') '. $kunloc->connect_error);
} 
#------- INFOMATION WEB-------------
$id_admin = "100007077545377"; 
$chat = "messages/t/100007077545377"; 
$tieude = "Mua bán source uy tín, chất lượng tại Likesieure.shop";
$content = "Mua source,mua code,facebook source, code viplike,sub,share chất lượng Hàng Đầu Việt Nam";
$domain = "https://domain";
$url = "Likesieure";
$admin = "kunloc";
$name_admin = 'Nguyễn Thành Lộc';
$email_admin = 'best.lee.kunloc@gmail.com';
$version = "1";
#------ CẤU HÌNH MOMO -------------------
$username_momo = 'nguyenthanhloc.nguyen.39@gmail.com'; #email có liên kết MOMO
$password_momo = 'xxxxxxxx'; #password email có liên kết MOMO
$value_momo = 2; #Số ngày cần get giao dịch
#-------GET INFO USER---------------
$select = "SELECT * FROM account WHERE username = '".$_SESSION['username']."'";
$kunloc_data = mysqli_fetch_object(mysqli_query($kunloc,$select));
$id_user = $kunloc_data->id;
$username = $kunloc_data->username;
$vnd = $kunloc_data->VND;
$ip_addr = $kunloc_data->ip;
$time_swal = 1000;
$today = date("h:i d-m-Y");
#-------GET IP PROXY------------
if(!empty($_SERVER["HTTP_X_REAL_IP"])){
    $ip = $_SERVER["HTTP_X_REAL_IP"];
}else{
    $ip = $_SERVER['REMOTE_ADDR']; 
}
?>