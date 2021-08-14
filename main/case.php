<div class="container mt-2 p-2">
<?php 
if($_REQUEST['log'] || $_REQUEST['home'] || $_REQUEST['admin']){
    $LOGIN = $_REQUEST['log'];
    switch($LOGIN){
        /* case 'trang-chu-he-thong':
            include("system/trang-chu-he-thong.php");
        break;*/
        case 'login':
            include("log/dang-nhap-he-thong.php");
            break;
        case 'sinup':
            include("log/dang-ky-he-thong.php");
            break;
        case 'logout':
            include("log/dang-xuat-he-thong.php");
            break;    
    }
    $HOME = $_REQUEST['home'];
    if($username){
        switch($HOME){
        case 'them-source':
            include("core/them-source/index.php");
            break;
        case 'quan-li-source':
            include("core/them-source/quan-li.php");
            break;
        case 'lich-su-mua-source':
            include("core/mua-source/lich-su-mua-source.php");
            break;
        case 'nap-tien-momo':
            include("core/momo/index.php");
            break;
        case 'nap-the':
            include("core/nap-the/index.php");
            break;
        case 'chuyen-tien':
            include("core/chuyen-coin/index.php");
            break;
        case 'rut-tien':
            include("core/rut-tien/index.php");
            break;
        case 'thong-tin-tai-khoan':
            include("system/thong-tin-tai-khoan.php");
            break;
            
        }
    }
    $ADMIN_ = $_REQUEST['admin'];
    if($username){
        switch($ADMIN_){
        case 'quan-li-thanh-vien':
            include("core/kunloc/danh-sach-thanh-vien.php");
            break;       
        }
    }
}else if(empty($username)){
    session_destroy();
    #header("Location: dang-nhap-he-thong");
    include("system/trang-chu-he-thong.php");
}else{
    include("system/trang-chu-he-thong.php");
}
?>
</div>
</div>
<?php 
include_once("main/footer.php");
?>