<?php
    if(isset($_POST['submit'])){
        $username = mysqli_real_escape_string($kunloc,$_SESSION['username']);
        $password_old = mysqli_real_escape_string($kunloc,md5($_POST['matkhaucu']));
        $password_new = mysqli_real_escape_string($kunloc,md5($_POST['matkhaumoi']));
         $check = mysqli_num_rows(mysqli_query($kunloc,"SELECT * FROM account WHERE username ='$username' AND password = '$password_old'"));
         if(!$check == 1){
             $fsmsg = 'Sai mật khẩu cũ rồi...';;
         }else{
             $CAPNHAT = mysqli_query($kunloc, "UPDATE account SET password= '$password_new' WHERE username='$username'");
             $smsg = 'Cập nhật thành công...';
           }
        }else{
             $fsmsg = 'Chưa có gì thay đổi...';
        }
?> 
<!-- ADS -->
<?= $ads_2x ?>
<?= $ads_auto ?>
<!-- /./ -->
<div class="row">
<!-- bounceIn -->
<div class="col-lg-12">
   <div class="card">
      <div class="card-header text-left"><i class="fa">&#xf2c2;</i> Xem Thông Tin Cá Nhân </div>
          <form action="" method="post" enctype="multipart/form-data">
            <div class="card-body">
            <!-- /./ -->
            <div class="form-group row">
                <label for="input-26" class="col-sm-2 col-form-label" style="color:black">Tên người dùng:</label>
                <div class="col-sm-10">
                <input type="text" disabled="" class="form-control form-control-rounded form-control-sm" style="color:#333" value="<?= $username ?>">
                </div>
              </div>
              <!-- /./ -->
               <div class="form-group row">
                <label for="input-26" class="col-sm-2 col-form-label" style="color:black">Số Dư</label>
                <div class="col-sm-10">
                <input type="text" disabled="" class="form-control form-control-rounded form-control-sm" style="color:#333" value="<?= $vnd ?> (VND)" required/>
                </div>
              </div>
               <!-- /./ -->
               <div class="form-group row">
                <label for="input-26" class="col-sm-2 col-form-label" style="color:black"> Mật Khẩu Cũ</label>
                <div class="col-sm-10">
                <input type="password" name="matkhaucu" id="matkhaucu" class="form-control form-control-rounded form-control-sm" style="color:#333" placeholder="Nhập mật khẩu cũ..."required/>
                </div>
              </div>
               <!-- /./ -->
               <div class="form-group row">
                <label for="input-26" class="col-sm-2 col-form-label" style="color:black">Mật Khẩu Mới</label>
                <div class="col-sm-10">
                <input type="password" name="matkhaumoi" id="matkhaumoi" class="form-control form-control-rounded form-control-sm" style="color:#333" placeholder="Nhập mật khẩu mới..." required/>
                </div>
              </div>
              <!-- /./ -->
            <div class="form-group row">
              <label for="input-26" class="col-sm-2 col-form-label" style="color:black">Địa chỉ đăng nhập</label>
                <div class="col-sm-10">
                  <input type="text" disabled="" class="form-control form-control-rounded form-control-sm" style="color:#333" value="<?= $ip_addr ?>">
                </div>
             </div>
              <!-- /./ -->
              <div class="irow row mt-4">
                <div class="form-group col-sm-3 select">
                    <button type="submit" name="submit" class="btn-sm btn btn-outline-success"><i class="icon-lock"></i> Cập Nhật Tài Khoản</button>
                    </div>
                 <div class="form-group col-sm-9">
                     <h>Trạng thái: <h style="color:red"><?php if(isset($smsg)){ echo '<h style="color:green">'.$smsg.'</h>'; }else if(isset($fsmsg)){ echo '<h style="color:red">'.$fsmsg.'</h>'; } ?></h></h>
                </div>
              </div>
          </form>
        </div>
        <!-- card body -->
          
</div>
</div>
<!-- row --> 
</div>