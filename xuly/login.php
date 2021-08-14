<?php
	session_start();
	require_once("../config.php");
	if(empty($_POST['username']) || empty($_POST['password'])){
		$JSON = array(
            "title" => "Yêu cầu thông tin",
            "text" => "Bạn chưa điền đầy đủ thông tin",
            "type" => "info",
        );
        die(json_encode($JSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
	}
	$login_username = htmlspecialchars(addslashes(mysqli_real_escape_string($kunloc,$_POST['username'])));
	$login_password = md5(mysqli_real_escape_string($kunloc,$_POST['password']));
	if(strlen($login_username) < 6 || strlen($login_username) > 55){
		$JSON = array(
			"title" => "Yêu cầu thông tin",
			"text" => "Bạn cần nhập tối thiểu từ 6 > 55",
			"type" => "info",
		);
		die(json_encode($JSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
	}
	$kiemtra = mysqli_num_rows(mysqli_query($kunloc,"SELECT * FROM account WHERE username ='$login_username'"));
	if($kiemtra == 1){
		$login = mysqli_num_rows(mysqli_query($kunloc,"SELECT * FROM account WHERE username ='$login_username' AND password ='$login_password'"));
	    if($login == 1){
	        $kunloc_info = mysqli_fetch_object(mysqli_query($kunloc,"SELECT * FROM account WHERE username = '$login_username'"));
        	$_SESSION['username'] = $kunloc_info->username;
        	$_SESSION['VND'] = $kunloc_info->VND;
        	$_SESSION['ip'] = $kunloc_info->ip;
        	setcookie('username',$login_username,time()+3600,'/','',0,0);
        	setcookie('password',$login_username,time()+3600,'/','',0,0);
	        if($_SESSION['ip'] != $ip){
				$JSON = array(
					"title" => "Cảnh báo đăng nhập",
					"text" => "Bạn đang đăng nhập từ 1 nơi khác",
					"type" => "info",
					"reload" => "$domain",
                    "time" => $time_swal,
				);
				die(json_encode($JSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    	    }else{
				$JSON = array(
					"title" => "Đăng nhập thành công",
					"text" => "Chờ chuyển hướng....",
					"type" => "success",
					"reload" => "$domain",
					"time" => $time_swal
				);
				die(json_encode($JSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
			}

	    }else{
			$JSON = array(
				"title" => "Mật Khẩu Không Đúng",
				"text" => "Kiểm tra lại mật khẩu của bạn!",
				"type" => "error",
			);
			die(json_encode($JSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        }
	}else{
		$JSON = array(
			"title" => "Tài khoản không tồn tại",
			"text" => "Hệ thống không nhận dạng được tài khoản này!",
			"type" => "error",
		);
		die(json_encode($JSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
	}
	?>