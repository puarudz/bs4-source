<?php
error_reporting(0);
header("Content-Type: text/javascript; charset=utf-8");
require_once("../config.php");
    #-----------------------------------------------
    $d = date('d', strtotime("-$value_momo days"));
    $m = date('m', strtotime("-$value_momo days"));
    $y = date('Y', strtotime("-$value_momo days"));
    $m2 = date('F', mktime(0, 0, 0, $m, 10));
    #$date2 = $d. '/'.$m.'/'.$y;
    $date = $d. ' ' . $m2 . ' ' . $y;
        if(!function_exists('imap_open')) {
            exit('Lỗi máy chủ');
        }
        #-----------------------
        $connection = imap_open('{imap.gmail.com:993/imap/ssl}INBOX', $username_momo, $password_momo) or die('Không thể truy cập email: ' . imap_last_error());
        $emailData = imap_search($connection, 'FROM "no-reply@momo.vn" SINCE "'.$date.'"');
        if(!empty($emailData)) {
        $i=0;
        foreach ($emailData as $emailIdent) {
                $overview = imap_fetch_overview($connection, $emailIdent, 0);
                if(preg_match("/Giao dịch thành công/",imap_utf8($overview[0]->subject))) continue;
                $message = ((imap_fetchbody($connection, $emailIdent,1)));
                $message = preg_replace( "/\s+/", " ", $message);
                preg_match('/(?<=li= ne-height: 1.2em; font-weight: 500;"> )(.*?)(?= <\/td>)/', $message, $matches);
                $so_tien =  ($matches[0]);
                preg_match('/(?<=height: 1.55em;" width=3D"50%"> <div style=3D"color:#3C4043;margin:0px;font-size:12px;li= ne-height:22px; font-weight: normal; font-size: 15px; padding-right: 10px;= "> M=C3=A3 giao d=E1=BB=8Bch<\/div> <\/td> <td class=3D"" style=3D"padding-top: 5px; padding-bottom: 5px; font-si= ze: 14px; font-family: Helvetica Neue, Arial, sans-serif; color: #3C4043; t= ext-align: left; line-height: 1.55em;" width=3D"50%"> <div style=3D"color:#3C4043;margin:0px;font-size:12px;li= ne-height:22px; font-weight: normal; font-size: 15px;"> )(.*?)(?=<\/div>)/', $message, $matches);
                $ma_giao_dich =  ($matches[0]);
                
                preg_match('/(?<=ADi<\/div> <\/td> <td class=3D"" style=3D"padding-top: 5px; padding-bottom: 5px; font-si= ze: 14px; font-family: Helvetica Neue, Arial, sans-serif; color: #3C4043; t= ext-align: left; line-height: 1.55em;" width=3D"50%"> <div style=3D"color:#3C4043;margin:0px;font-size:12px;li= ne-height:22px; font-weight: normal; font-size: 15px;"> )(.*?)(?=<\/div>)/', $message, $matches);
                $name =  str_replace("=",'%',$matches[0]);
                $name =  str_replace("%\s",'',$name);
                $name =  urldecode($name);
                preg_match('/(?<=tho=E1=BA=A1i ng=C6=B0= =E1=BB=9Di g=E1=BB=ADi<\/div> <\/td> <td class=3D"" style=3D"padding-top: 5px; padding-bottom: 5px; font-si= ze: 14px; font-family: Helvetica Neue, Arial, sans-serif; color: #3C4043; t= ext-align: left; line-height: 1.55em;" width=3D"50%"> <div style=3D"color:#3C4043;margin:0px;font-size:12px;li= ne-height:22px; font-weight: normal; font-size: 15px;"> )(.*?)(?=<\/div>)/', $message, $matches);
                $phone =  str_replace("=",'%',$matches[1]);
                preg_match('/(?<=gian<\/div> <\/td> <td class=3D"" style=3D"padding-top: 5px; padding-bottom: 5px; font-si= ze: 14px; font-family: Helvetica Neue, Arial, sans-serif; color: #3C4043; t= ext-align: left; line-height: 1.55em;" width=3D"50%"> <div style=3D"color:#3C4043;margin:0px;font-size:12px;li= ne-height:22px; font-weight: normal; font-size: 15px;"> )(.*?)(?=<\/div>)/', $message, $matches);
                $thoi_gian =  str_replace("=",'%',$matches[1]);
                preg_match('/(?<=ch=C3=BAc<\/div> <\/td> <td class=3D"" style=3D"padding-top: 5px; padding-bottom: 5px; font-si= ze: 14px; font-family: Helvetica Neue, Arial, sans-serif; color: #3C4043; t= ext-align: left; line-height: 1.55em;" width=3D"50%"> )(.*?)(?=<\/div>)/', $message, $matches);
                #$noidung =  str_replace('<div style="color:#3C4043;margin:0px;font-size:12px;li% ne-height:22px; font-weight: normal; font-size: 15px;"> ','',urldecode(str_replace("=",'%',$matches[1])));
                $date = date('H:i:s d/m/Y ', strtotime($overview[0]->date));
                preg_match('#naptien(.+?)</div>#is', $message, $tach);
                $username_email = trim($tach[1]);
                if($username_email){
                   $noidung = "naptien $username_email"; 
                }else{
                   $noidung = NULL;
                }
                if(!isset($username_email)){
                    echo('Chưa tìm thấy giao dịch nào');
                }
                if(isset($date,$so_tien,$noidung,$ma_giao_dich,$name,$phone,$username_email)){
                    if(mysqli_num_rows(mysqli_query($kunloc,"SELECT * FROM momo WHERE ma_giao_dich = '$ma_giao_dich'"))){
                        $JSON = array(
                            'money' => $so_tien,
                            'code' => $ma_giao_dich,
                            'name' => $name,
                            'phone' => $phone,
                            'time' => $date,
                            'content' => $noidung,
                        );
                    }else{
                        mysqli_query($kunloc,"INSERT 
                        INTO momo(
                            ma_giao_dich,
                            so_tien,
                            name,
                            content,
                            username,
                            so_dien_thoai,
                            date,
                            trangthai
                        ) 
                        VALUES (
                            '$ma_giao_dich',
                            '$so_tien',
                            '$name',
                            '$noidung',
                            '$username_email',
                            '$phone',
                            '$date',
                            'fail')
                        ");
                        $JSON = array(
                        'data' => [
                            'money' => $so_tien,
                            'code' => $ma_giao_dich,
                            'name' => $name,
                            'phone' => $phone,
                            'time' => $date,
                            'content' => $noidung,
                            ],
                        );
                    }
                }
     } #end foreach
     echo(json_encode($JSON,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES));      
    ?>
<?php
}else{
imap_close($connection);
}
?>