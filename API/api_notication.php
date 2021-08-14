<?php
    session_start();
    require_once("../config.php");
    if($_GET) $_POST = $_GET;
    if(isset($_POST['id'])){
      $id_ = $_POST['id'];
    }else{
      $id_ = null;
    }
    if(isset($_REQUEST['type'])){
        $case_ = $_REQUEST['type'];
        switch($case_){
            #----------
            case 'get_thongbao':
                $thongbao_ = mysqli_query($kunloc,"SELECT * FROM thongbao WHERE trangthai = 'show' AND username = '$username' ORDER BY id DESC LIMIT 0,1");
                $SQL = mysqli_fetch_object($thongbao_);
                if(mysqli_num_rows($thongbao_)){
                    $JSON = array(
                    "id" => $SQL->id,   
                    "title" => 'Alo! Có thông báo!',
                    "text" => $SQL->noidung,
                    "type" => 'info',
                  );
                }
               ECHO json_encode($JSON, JSON_UNESCAPED_UNICODE); 
            break;
            #---------------------
            case 'update_thongbao':
                $thongbao_ = mysqli_query($kunloc,"SELECT * FROM thongbao WHERE id = '$id_' AND username = '$username'");
                $SQL = mysqli_fetch_object($thongbao_);
                if($SQL->id == $id_ && $SQL->trangthai == 'show'){
                mysqli_query($kunloc,"UPDATE thongbao SET trangthai = 'hide' WHERE id = '{$SQL->id}' ");
                    $JSON = array(
                    "id" => $SQL->id,     
                    "success" => $SQL->username,   
                    "trangthai" => 'hide',
                  );
                }else if($SQL->trangthai == 'hide'){
                    $JSON = array(
                    "id" => $SQL->id,     
                    "error" => $SQL->username,
                  );
                }
               ECHO json_encode($JSON, JSON_UNESCAPED_UNICODE); 
            break;
            #---------------------
        }
    }
    #-----------------------
?>