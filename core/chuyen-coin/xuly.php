<?php
	session_start();
    require_once("../../config.php");
	if(empty($_POST['username']) || empty($_POST['sotien'])){
        $JSON = array(
            "title" => "Yêu cầu thông tin",
            "text" => "Bạn chưa điền đầy đủ thông tin",
            "type" => "info",
        );
        die(json_encode($JSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }
    $nguoi_nhan = addslashes($_POST['username']);
    $sotien = intval($_POST['sotien']);
    $check = mysqli_fetch_object(mysqli_query($kunloc,"SELECT * FROM account WHERE username = '$nguoi_nhan'"));
    if($vnd < $sotien){
        $JSON = array(
            "title" => "Số dư không đủ",
            "text" => "Kiếm thêm rồi thử lại",
            "type" => "info",
        );
        die(json_encode($JSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    }else  if($sotien < 10000 || $sotien > 500000){
       $JSON = array(
        "title" => "Chú ý!",
        "text" => "Chuyển tối thiểu 10,000 > 500.000 Xu",
        "type" => "info",
        );
        die(json_encode($JSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    }else if($check->username != $nguoi_nhan){
        $JSON = array(
            "title" => "Người dùng không tồn tại!",
            "text" => "Bạn không chuyển cho user này",
            "type" => "info",
            );
        die(json_encode($JSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    }else if($check->username == $username){
         $JSON = array(
            "title" => "Chú ý!",
            "text" => "Bạn không thể tự chuyển cho mình",
            "type" => "info",
            );
        die(json_encode($JSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }else if($check->username == $nguoi_nhan){
        $CHUYEN_TIEN = mysqli_query($kunloc,"UPDATE account SET VND = VND - $sotien WHERE username = '$username'");
        $NHAN_TIEN = mysqli_query($kunloc,"UPDATE account SET VND = VND + $sotien WHERE username = '$nguoi_nhan'");
        $LOG1 = mysqli_query($kunloc,"INSERT INTO lich_su_chuyen_tien(username,VND,hinh_thuc,nguoi_gui,nguoi_nhan,date) VALUES ('$username','$sotien','Chuyển tiền','$username','$nguoi_nhan','$today') ");
        $LOG2 = mysqli_query($kunloc,"UPDATE log_vnd SET VND = VND + $sotien, date='$today' WHERE username = '$nguoi_nhan'");
        $JSON = array(
            "title" => "Chuyển thành công!",
            "text" => "Đã chuyển: ".number_format($sotien)." cho $nguoi_nhan",
            "type" => "success",
            "reload" => "true",
            "time" => $time_swal
            );
        die(json_encode($JSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        
    }
?>