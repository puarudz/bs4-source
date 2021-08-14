


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="<?= $content ?>">
    <title><?= $tieude ?></title>
    <meta name="theme-color" content="#563d7c">
    <link rel="stylesheet" href="album.css">
    <link rel="stylesheet" type="text/css" href="hhttps://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css"/>
    <!-- JavaScript -->
    <script type="text/javascript" src="/assets/js/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="/assets/js/wow.min.js"></script>   
    <!-- toastr 1.0 -->
    <link rel="stylesheet" type="text/css" href="/assets/toastr/toastr.min.css"/>
    <link rel="stylesheet" type="text/css" href="/assets/toastr/toastr.css"/>
    <script type="text/javascript" src="/assets/toastr/toastr.min.js"></script>
    <!-- Swal 2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css" id="theme-styles">
    <!--- CSS /./ -->
    <link rel="stylesheet" href="/assets/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/js/all.min.js"></script>
    <!--script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <style>
    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    ::-webkit-scrollbar {
        width: 10px;
        height:10px;
        box-shadow: inset 0 0 5px grey; 
    }
    ::-webkit-scrollbar-track {
      box-shadow: inset 0 0 5px grey; 
    }
    ::-webkit-scrollbar-thumb {
      background: #ccc; 
      box-shadow: inset 0 0 5px grey; 
    }
    ::-webkit-scrollbar-thumb:hover {
      box-shadow: inset 0 0 5px grey; 
      background: #a8a8a8; 
    } 
    .dngaz:hover{
        text-shadow: 0px 2px 4px red;
        background:black;
    }
    .dngaz2:hover{
        text-shadow: 0px 0px 0px grey;
        background:#ffffff;
    }
    .hoverimage img{
     overflow: hidden;
    -webkit-transform:scale(0.9); /*Webkit: Thu nhỏ kích thước ảnh còn 0.8 so với ảnh gốc*/
    -moz-transform:scale(0.9); /*Thu nhỏ đối với Mozilla*/
    -o-transform:scale(0.9); /*Thu nhỏ đối với Opera*/
    -webkit-transition-duration: 0.3s; /*Webkit: Thời gian phóng to, nhỏ ảnh*/
    -moz-transition-duration: 0.3s; /*Như trên*/
    -o-transition-duration: 0.53s; /*Như trên*/
    margin: 0 10px 5px 0; /*căn đều giữa ảnh*/
    }
    .hoverimage img:hover{
     overflow: hidden;   
    -webkit-transform:scale(1.0); /*Webkit: Tăng kích cỡ ảnh lên 1.1 lần*/
    -moz-transform:scale(1.0); 
    -o-transform:scale(1.0); 
    }
    </style>
    <script data-ad-client="ca-pub-8563154114869107" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

</head>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="trang-chu-he-thong"><i class="fa fa-refresh fa-spin fa-fw"></i> HỆ THỐNG SELL SOURCE</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#open-navbars" aria-controls="open-navbars" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="open-navbars">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="trang-chu-he-thong"><i class="fa fa-home"></i> Trang chủ <span class="sr-only">(current)</span></a>
        </li>
        <?php if(empty($username)): ?>
        <li class="nav-item">
          <a class="nav-link text-success" href="dang-nhap-he-thong"><i class="fa fa-sign-in" aria-hidden="true"></i> Đăng nhập hệ thống</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-danger" href="dang-ky-he-thong"><i class="fa fa-sign-out" aria-hidden="true"></i>Tạo tài khoản</a>
        </li>
        <?php endif ?>
        <?php if($username): ?>
         <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-success" href="#" id="menu01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-upload"></i> UPLOAD SOURCE</a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="them-source"><i class="fa fa-plus"></i> Tạo bài viết mới (ADD SOURCE)</a>
            <a class="dropdown-item" href="quan-li-source"><i class="fa fa-plus"></i> Quản lí bài viết (DS SOURCE)</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link text-danger" href="lich-su-mua-source"><i class="fa fa-history"></i> Lịch sử mua source</a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-white" href="#" id="menu01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-spinner fa-pulse"></i> Chức năng khác</a>
          <div class="dropdown-menu" aria-labelledby="menu01">
            <a class="dropdown-item" href="thong-tin-tai-khoan"><i class="fa fa-user"></i> Thông tin tài khoản</a>
            <a class="dropdown-item" href="nap-tien-momo"><i class="fa fa-credit-card" aria-hidden="true"></i> Nạp Tiền MOMO</a>
            <a class="dropdown-item" href="nap-the"><i class="fa fa-credit-card" aria-hidden="true"></i> Nạp Thẻ Chậm</a>
            <a class="dropdown-item" href="chuyen-tien"><i class="fa fa-gift"></i> Chuyển tiền</a>
            <a class="dropdown-item" href="rut-tien"><i class="fa fa-paypal"></i> Rút tiền</a>
            <?php if($username == $admin): ?>
              <a class="dropdown-item" href="quan-li-thanh-vien"><i class="fa fa-user"></i> Quản lí thành viên</a>
              <a class="dropdown-item" href="them-tien"><i class="fa fa-money"></i> Thêm tiền</a>
            <?php endif; ?>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link text-warning" href="dang-xuat-he-thong"><i class="fa fa-facebook"></i> <b>Đăng xuất</b></a>
        </li>
      <?php endif ?>
      
      </ul>

    </div>
  </div>
</nav>
<!-- Button trigger modal -->
<button id="btn-view-source" href="#view-source" data-toggle="modal" data-target="#view-source" class="d-none btn btn-primary"></button>
<!-- Modal -->
<div class="modal fade" id="view-source" tabindex="-1" role="dialog" aria-labelledby="view-source" aria-hidden="true">
  <div class="modal-dialog modal- modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="icon-settings icons"></i>Thông tin chi tiết bài viết</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
               <div id="view-data"></div>
               <div id="view-info" style="display:none"></div>
            </div>
      </div>
      
    </div>
  </div>
</div>
<!-- Button trigger modal -->
<button id="btn-notification" href="#view-notification" data-toggle="modal" data-target="#view-notification" class="d-none btn btn-primary"></button>
<!-- Modal -->
<div class="modal fade" id="view-notification" tabindex="-1" role="dialog" aria-labelledby="view-notification" aria-hidden="true">
  <div class="modal-dialog modal- modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="icon-settings icons"></i>Thông báo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
            <div class="mt-3" id="view-data-notification"></div>
        </div>
      </div>
      
    </div>
  </div>
</div>
