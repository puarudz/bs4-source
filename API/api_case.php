<?php
    session_start();
    require_once("../config.php");
    if($_GET) $_POST = $_GET;
    if(isset($_REQUEST['type']) && $_POST['id']){
        $Case_ = $_REQUEST['type'];
        switch($Case_){
            #----------------------------------------------------------------
            case 'image_delete':
             $i = intval($_POST['id']);
             $SQL = mysqli_fetch_object(mysqli_query($kunloc,"SELECT * FROM uploads WHERE id= '$i'"));
             unlink($domain."/".$SQL->img_url);
             if(unlink($domain."/".$SQL->img_url)){
                    $delsql = mysqli_query($kunloc,"DELETE FROM uploads WHERE id= '$i' ");
                    if($delsql){
                       $JSON = array(
                            "title" => "Đã xóa thành công",
                            "text" => "Chờ reload...",
                            "type" => "success",
                            "reload" => "true",
                            "time" => $time_swal
                        );
                        die(json_encode($JSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
                    }else{
                        $JSON = array(
                            "title" => "Xóa ảnh thất bại",
                            "text" => "Không thể xóa ảnh này",
                            "type" => "error",
                        );
                        die(json_encode($JSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
                    }   
            }else{
                $JSON = array(
                            "title" => "Xóa ảnh thất bại",
                            "text" => "Không thể xóa ảnh này",
                            "type" => "error",
                );
              die(json_encode($JSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            }
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