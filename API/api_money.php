<?php
    session_start();
    require_once("../config.php");
    if($_GET) $_POST = $_GET;
    if(isset($_REQUEST['type'])){
        $case_ = $_REQUEST['type'];
        switch($case_){
            case 'get_money':
                $payment = mysqli_query($kunloc,"SELECT * FROM momo WHERE trangthai = 'fail'");
                while($momo_ = mysqli_fetch_object($payment)){

                    $kiemtra_username = explode("naptien ", $momo_->content)[1];
                    if(empty($kiemtra_username)){
                        $username_momo = $momo_->username;
                    }else{
                        $username_momo = $kiemtra_username;
                    }
                    $so_dien_thoai = $momo_->so_dien_thoai;
                    $so_tien_momo = str_replace('.', '', $momo_->so_tien);
                    $ma_giao_dich_momo = $momo_->ma_giao_dich;
                    $ngay_giao_dich = $momo_->date;
                    $noidung_ = "Bạn đã nạp: $so_tien_momo VND vào lúc: $ngay_giao_dich";
                    if(isset($momo_->content) && ($username_momo == $momo_->username)){

                        $congtien = mysqli_query($kunloc,
                        "UPDATE account 
                            SET 
                            VND = VND + $so_tien_momo 
                            WHERE 
                            username = '$username_momo' 
                        ");
                        $update_momo = mysqli_query($kunloc,
                        "UPDATE momo 
                            SET 
                            username = '$username_momo',
                            trangthai = 'success' 
                            WHERE 
                            ma_giao_dich = '$ma_giao_dich_momo' 
                        ");
                        if(mysqli_num_rows(mysqli_query($kunloc,"SELECT id FROM log_nap_the WHERE username = '$username_momo' "))){
                            mysqli_query($kunloc,"UPDATE log_nap_the SET VND = VND + $so_tien_momo, date = '$today' WHERE username = '$username_momo'");
                        }else{
                            mysqli_query($kunloc,"INSERT INTO log_nap_the(username,VND,date) VALUES('$username_momo','$so_tien_momo','$today')");
                        }
                        $log_momo = mysqli_query($kunloc,
                        "INSERT 
                            INTO log_momo(username,sotien,date,phone) 
                        VALUES(
                            '$username_momo',
                            '$so_tien_momo',
                            '$today',
                            '$so_dien_thoai'
                        )
                        ");
                        $lich_su_hoat_dong = mysqli_query($kunloc,
                        "INSERT 
                            INTO lich_su_hoat_dong(username,VND,date,loai)
                        VALUES(
                             '$username_momo',
                             '$so_tien_momo',
                             '$today','MOMO'
                        )
                        ");
                        $thongbao_ = mysqli_query($kunloc,
                        "INSERT 
                            INTO thongbao(noidung, trangthai, username) 
                        VALUES (
                            '$noidung_',
                            'show',
                            '$username_momo'
                        )
                        ");
                    
                    }
                    /*$get_info = mysqli_fetch_object(mysqli_query($kunloc,"SELECT * FROM account WHERE sdt = '".$kiemtra_phone."' "));
                    if($kiemtra_phone == $get_info->sdt){

                        $congtien = mysqli_query($kunloc,
                        "UPDATE account 
                            SET 
                            VND = VND + $so_tien_momo 
                            WHERE 
                            username = '".$get_info->username."' 
                        ");
                        $update_momo = mysqli_query($kunloc,
                        "UPDATE momo 
                            SET 
                        username = '".$get_info->username."',
                        trangthai = 'success' 
                            WHERE 
                        ma_giao_dich = '$ma_giao_dich_momo' 
                        ");
                        $log_momo = mysqli_query($kunloc,
                        "INSERT 
                            INTO log_momo(username,sotien,date,phone) 
                        VALUES(
                                '".$get_info->username."',
                                '$so_tien_momo',
                                '$today',
                                '$so_dien_thoai'
                            )
                        ");
                        $lich_su_hoat_dong = mysqli_query($kunloc,
                        "INSERT 
                            INTO lich_su_hoat_dong(username,VND,date,loai) 
                        VALUES(
                            '".$get_info->username."',
                            '$so_tien_momo','$today','MOMO'
                        )
                        ");
                        $thongbao_ = mysqli_query($kunloc,
                        "INSERT 
                            INTO thongbao(noidung, trangthai, username) 
                        VALUES (
                            '$noidung_',
                            'show',
                            '".$get_info->username."'
                        )
                        ");
                    }*/
              }
              #----------------------
              $tien = mysqli_fetch_object(mysqli_query($kunloc,"SELECT VND FROM account WHERE username = '$username'"));
              $JSON = array(
                "vnd" => number_format($tien->VND)
                ); 
              die(json_encode($JSON, JSON_UNESCAPED_UNICODE));
            break;
        }
    }
    #-----------------------
?>