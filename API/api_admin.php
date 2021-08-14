<?php
error_reporting(0);
session_start();
require_once("../config.php");
#Xóa Thành Viên
if(isset($_GET['xoa_thanh_vien'])){
    $id = mysqli_real_escape_string($kunloc,$_GET['xoa_thanh_vien']);
    if($username != $admin){
        echo "<script>swal('Thất Bại','Bạn không thể thực hiện điều này!','error'); setTimeout(function(){ window.location  = '$domain'; }, 1000);</script>";    
    }else{
        $DELETE = mysqli_query($kunloc,"DELETE FROM account WHERE id = '$id'");
        $echo['success'] = 'true';
        $echo['id'] = $id;
        ECHO json_encode($echo, JSON_UNESCAPED_UNICODE);
    }
}
#Duyệt thẻ nạp
if(isset($_GET['duyet_the'])){
    if($username != $admin){
        echo "<script>swal('Thất Bại','Bạn không thể thực hiện điều này!','error'); setTimeout(function(){ window.location  = '$domain'; }, 1000);</script>";   
    }else{
    $id = intval($_GET['duyet_the']);
    $tinhrang = "Đã Duyệt Thẻ";
    mysqli_query($kunloc,"UPDATE gachthe SET tinhtrang = '$tinhrang' WHERE id = '{$id}'");
    $echo['success'] = 'true';
    $echo['id'] = $id;
    ECHO json_encode($echo, JSON_UNESCAPED_UNICODE);
    }
    
}
#Từ Chối Thẻ    
if(isset($_GET['tu_choi_the'])){
    if($username != $admin){
        echo "<script>swal('Thất Bại','Bạn không thể thực hiện điều này!','error'); setTimeout(function(){ window.location  = '$domain'; }, 1000);</script>";   
    }else{
    $id = intval($_GET['tu_choi_the']);
    mysqli_query($kunloc,"DELETE FROM gachthe WHERE id= '{$id}'");
    $echo['success'] = 'true';
    $echo['id'] = $id;
    ECHO json_encode($echo, JSON_UNESCAPED_UNICODE);
    }
}

?>