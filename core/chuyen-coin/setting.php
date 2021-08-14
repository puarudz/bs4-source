<?php
    session_start();
    require_once("../../config.php");
    if(isset($_REQUEST['type']) && $_POST['id']){
        $Case_ = $_REQUEST['type'];
        switch($Case_){
            #----------------------------------------------------------------
            case 'remove':
                $i = intval($_POST['id']);
                if($username != $admin){
                    $JSON = array(
                        "title" => "Bạn không có quyền",
                        "text" => "Không thể duyệt id này",
                        "type" => "error"
                    );
                    die(json_encode($JSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
                }
                mysqli_query($kunloc,"DELETE FROM lich_su_chuyen_tien WHERE id = '$i'");
                $JSON = array(
                    "title" => "Đã xóa thành công",
                    "text" => "Chờ reload...",
                    "type" => "success",
                    "reload" => "true",
                    "time" => $time_swal
                );
                die(json_encode($JSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            break;
        }
    }else{
        $JSON = array(
            "title" => "Bạn không có quyền",
            "text" => "Không thể duyệt id này",
            "type" => "error"
        );
        die(json_encode($JSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }
?>