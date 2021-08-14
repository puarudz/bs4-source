<?php
    session_start();
	require_once("../config.php");
    if( empty($_POST['username']) || empty($_POST['password'])){
        $JSON = array(
            "title" => "Yêu cầu thông tin",
            "text" => "Bạn chưa điền đầy đủ thông tin",
            "type" => "info",
        );
        die(json_encode($JSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }
    $sinup_username = htmlspecialchars(addslashes(mysqli_real_escape_string($kunloc,$_POST['username'])));
    $sinup_password = htmlspecialchars(addslashes(md5(mysqli_real_escape_string($kunloc,$_POST['password']))));
    #==========================================================
	    if(strlen($sinup_username) < 6 || strlen($sinup_username) > 55){
            $JSON = array(
                "title" => "Yêu cầu thông tin",
                "text" => "Bạn cần nhập tối thiểu từ 6 > 55",
                "type" => "info",
            );
            die(json_encode($JSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        }  
	    if(strlen($sinup_password) < 6 || strlen($sinup_password) > 100){
            $JSON = array(
                "title" => "Yêu cầu thông tin",
                "text" => "Yêu cầu mật khẩu 6 > 100 kí tự",
                "type" => "info",
            );
            die(json_encode($JSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
	    }
        if(!preg_match("#[0-9]+#", $sinup_password) ) {
            $JSON = array(
                "title" => "Yêu cầu thông tin",
                "text" => "Mật khẩu phải có 1 con số ",
                "type" => "info",
            );
            die(json_encode($JSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        }
        if(!preg_match("#[a-z]+#", $sinup_password) ) {
            $JSON = array(
                "title" => "Yêu cầu thông tin",
                "text" => "Mật khẩu phải có 1 chữ cái",
                "type" => "info",
            );
            die(json_encode($JSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        }
        $kiemtra = mysqli_fetch_object(mysqli_query($kunloc,"SELECT * FROM account"));
        if($kiemtra->username == $sinup_username){
            $JSON = array(
                "title" => "Tài Khoản Đã Tồn Tại",
                "text" => "Xin hãy thử lại với tên khác",
                "type" => "error",
            );
            die(json_encode($JSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        }
       /* $kiemtra_ip = mysqli_num_rows(mysqli_query($kunloc,"SELECT * FROM account WHERE ip = '$ip'"));
        if($kiemtra_ip == 1){
            $JSON = array(
                "title" => "Cắm tạo nhiều lần",
                "text" => "Bạn đang cố tạo nhiều acc?",
                "type" => "error",
            );
            die(json_encode($JSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        }*/
        $value = 0;
        $created = mysqli_query($kunloc,"
        INSERT 
        INTO account(username,password,VND,ip,time_reg) 
        VALUES ('$sinup_username','$sinup_password','{$value}','$ip','$today')");
        $login = mysqli_num_rows(mysqli_query($kunloc,"SELECT * FROM account WHERE username = '$sinup_username'"));
        if($login == 1){
                $kunloc_info = mysqli_fetch_object(mysqli_query($kunloc,"SELECT * FROM account WHERE username ='$sinup_username'"));
                $_SESSION['username'] = $kunloc_info->username;
                $_SESSION['VND'] = $kunloc_info->VND;
                $_SESSION['ip'] = $kunloc_info->ip;
        	    setcookie('username',$username,time()+3600,'/','',0,0);
                setcookie('password',$username,time()+3600,'/','',0,0);
                $log_vnd = mysqli_query($kunloc, "INSERT INTO log_vnd(username,VND,date) VALUES ('{$kunloc_info->username}','{$value}','$today')");
                $log_rut_tien = mysqli_query($kunloc, "INSERT INTO log_rut_tien(username,VND,date) VALUES ('{$kunloc_info->username}','{$value}','$today')");
                $log_nap_the = mysqli_query($kunloc, "INSERT INTO log_nap_the(username,VND,date) VALUES ('{$kunloc_info->username}','{$value}','$today')");
                $JSON = array(
                    "title" => "Tham Gia Thành Công",
                    "text" => "Chờ chuyển hướng...",
                    "type" => "success",
                    "reload" => "trang-chu-he-thong",
                    "time" => $time_swal,
                );
                die(json_encode($JSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            }
?>

