<?php
error_reporting(0);
require_once("../config.php");
#if($_GET) $_POST = $_GET;
if(isset($_REQUEST['kunloc'])){
    $kunloc_ = $_REQUEST['kunloc'];
    switch($kunloc_){
    case 'GET': 
        $SQL = mysqli_query($kunloc,"SELECT * FROM blog WHERE trangthai = 1 ORDER BY id DESC LIMIT 0,5");
        while ($row = mysqli_fetch_object($SQL)){
            $get_profile = mysqli_fetch_object(mysqli_query($kunloc,"SELECT * FROM account WHERE username ='".$row->username."' "));
            $JSON[] = array(
                "id" => $row->id,
                "code" => $row->code,
                "title" => $row->title,
                "image" => trim($row->image),
                "link" => $row->link,
                "view" => $row->view,
                "pay" => $row->pay,
                "gia" => number_format($row->gia),
                "date" => $row->date,
                "username" => $row->username,
                "avatar"=> $get_profile->url
            );
        }
        die(json_encode($JSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
    break;
        case 'GET_all': 
        $SQL = mysqli_query($kunloc,"SELECT * FROM blog WHERE trangthai = 1 ORDER BY id ASC");
        while ($row = mysqli_fetch_object($SQL)){
            $get_profile = mysqli_fetch_object(mysqli_query($kunloc,"SELECT * FROM account WHERE username ='".$row->username."' "));
            $JSON[] = array(
                "id" => $row->id,
                "code" => $row->code,
                "title" => $row->title,
                "image" => trim($row->image),
                "link" => $row->link,
                "view" => $row->view,
                "pay" => $row->pay,
                "gia" => number_format($row->gia),
                "date" => $row->date,
                "username" => $row->username,
                "avatar"=> $get_profile->url
            );
        }
        die(json_encode($JSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
    break;
    #---------------------------
    case 'View': 
        $code = intval($_POST['code']);
        mysqli_query($kunloc,"UPDATE blog SET view= view+1 WHERE code='$code'");
        $SQL = mysqli_query($kunloc,"SELECT * FROM blog WHERE code = '$code' ");
        if(mysqli_num_rows($SQL) < 1){
            exit();
        }
        while ($row = mysqli_fetch_object($SQL)){
            $get_profile = mysqli_fetch_object(mysqli_query($kunloc,"SELECT * FROM account WHERE username ='".$row->username."' "));
            $JSON[] = array(
                "id" => $row->id,
                "code" => $row->code,
                "title" => $row->title,
                "image" => trim($row->image),
                "link" => $row->link,
                "view" => $row->view,
                "pay" => $row->pay,
                "html" => trim($row->html),
                "gia" => number_format($row->gia),
                "date" => $row->date,
                "username" => $row->username,
                "avatar"=> $get_profile->url
            );
            mysqli_query($kunloc,"UPDATE blog SET view = '".$row->view."'+1 WHERE code='$code'");
        
        }
        die(json_encode($JSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
    break;
    case 'Loc': 
        $keyword = $_POST['keyword'];
        $code = intval($_POST['code']);
        $type = intval($_POST['type']);
        if($type == 0){
            if($code == '' && $keyword == ''){
                $SQL = mysqli_query($kunloc,"SELECT * FROM blog WHERE trangthai = 1 ORDER BY id DESC LIMIT 0,10");
            }else if(isset($code) && empty($keyword)){
                $SQL = mysqli_query($kunloc,"SELECT * FROM blog WHERE code = '$code' ORDER BY id DESC");
            }else if(isset($keyword) && empty($code) ){
                $SQL = mysqli_query($kunloc,"SELECT * FROM blog WHERE title LIKE '%$keyword%' ORDER BY id DESC");
            }else if(isset($code) && isset($keyword)){
                $SQL = mysqli_query($kunloc,"SELECT * FROM blog WHERE title LIKE '%$keyword%' AND code = '$code' ORDER BY id DESC");
            }
            while ($row = mysqli_fetch_object($SQL)){
            $get_profile = mysqli_fetch_object(mysqli_query($kunloc,"SELECT * FROM account WHERE username ='".$row->username."' "));
            $JSON[] = array(
                "id" => $row->id,
                "code" => $row->code,
                "title" => $row->title,
                "image" => trim($row->image),
                "link" => $row->link,
                "view" => $row->view,
                "pay" => $row->pay,
                "gia" => number_format($row->gia),
                "date" => $row->date,
                "username" => $row->username,
                "avatar"=> $get_profile->url
            );
            }
            die(json_encode($JSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
        }else if($type == 1){
            if($code == '' && $keyword == ''){
                $SQL = mysqli_query($kunloc,"SELECT * FROM blog WHERE trangthai = 1 AND gia < 1 ORDER BY id DESC LIMIT 0,10");
            }else if(isset($code) && empty($keyword)){
                $SQL = mysqli_query($kunloc,"SELECT * FROM blog WHERE code = '$code' AND gia < 1 ORDER BY id DESC");
            }else if(isset($keyword) && empty($code) ){
                $SQL = mysqli_query($kunloc,"SELECT * FROM blog WHERE title LIKE '%$keyword%' AND gia < 1 ORDER BY id DESC");
            }else if(isset($code) && isset($keyword)){
                $SQL = mysqli_query($kunloc,"SELECT * FROM blog WHERE title LIKE '%$keyword%' AND code = '$code' AND gia < 1 ORDER BY id DESC");
            }
            while ($row = mysqli_fetch_object($SQL)){
                $get_profile = mysqli_fetch_object(mysqli_query($kunloc,"SELECT * FROM account WHERE username ='".$row->username."' "));
                $JSON[] = array(
                    "id" => $row->id,
                    "code" => $row->code,
                    "title" => $row->title,
                    "image" => trim($row->image),
                    "link" => $row->link,
                    "view" => $row->view,
                    "pay" => $row->pay,
                    "gia" => number_format($row->gia),
                    "date" => $row->date,
                    "username" => $row->username,
                    "avatar"=> $get_profile->url
                );
            }
            mysqli_query($kunloc,"UPDATE blog SET view= view+1 WHERE code='$code'");
            die(json_encode($JSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
        }else if($type == 2){
            if($code == '' && $keyword == ''){
                $SQL = mysqli_query($kunloc,"SELECT * FROM blog WHERE trangthai = 1 AND gia > 1 ORDER BY id DESC LIMIT 0,10");
            }else if(isset($code) && empty($keyword)){
                $SQL = mysqli_query($kunloc,"SELECT * FROM blog WHERE code = '$code' AND gia > 1 ORDER BY id DESC");
            }else if(isset($keyword) && empty($code) ){
                $SQL = mysqli_query($kunloc,"SELECT * FROM blog WHERE title LIKE '%$keyword%' AND gia > 1 ORDER BY id DESC");
            }else if(isset($code) && isset($keyword)){
                $SQL = mysqli_query($kunloc,"SELECT * FROM blog WHERE title LIKE '%$keyword%' AND code = '$code' AND gia > 1 ORDER BY id DESC");
            }
            while ($row = mysqli_fetch_object($SQL)){
                $get_profile = mysqli_fetch_object(mysqli_query($kunloc,"SELECT * FROM account WHERE username ='".$row->username."' "));
                $JSON[] = array(
                    "id" => $row->id,
                    "code" => $row->code,
                    "title" => $row->title,
                    "image" => trim($row->image),
                    "link" => $row->link,
                    "view" => $row->view,
                    "pay" => $row->pay,
                    "gia" => number_format($row->gia),
                    "date" => $row->date,
                    "username" => $row->username,
                    "avatar"=> $get_profile->url
                );
            }
            mysqli_query($kunloc,"UPDATE blog SET view= view+1 WHERE code='$code'");
            die(json_encode($JSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
        }

    break;
}
}
?>