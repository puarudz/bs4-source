<?php
if($username){
header("Location: $domain");
exit();
}
?>
<div class="row">
<div class="col-12">
<!-- /./ -->
<div class="card">
<div class="card-header"><h5 class="card-title">Đăng ký hệ thống</h5></div>
<div class="card-body">
   <form action="javascript:volid()" method="POST">
        <div class="form-group">
          <label for="username"><i class="fa fa-user"></i> Điền username để đăng ký:</label>
          <input type="text" class="form-control" id="username" placeholder="Điền username của bạn">
          <small class="form-text text-muted">Yêu cầu nhập đúng username</small>
        </div>
        <div class="form-group">
          <label for="password"><i class="fa fa-lock"></i> Điền mật khẩu để đăng ký:</label>
          <input type="password" class="form-control" id="password" placeholder="Điền password của bạn">
          <small class="form-text text-muted">Yêu cầu nhập đúng password</small>
        </div>
        <button type="submit" id="submit" class="btn-sm btn-danger">ĐĂNG KÝ HỆ THỐNG</button>
      </form>
      </div>
    <div class="card-footer">
      <small class="h6 form-text text-muted">Đã có tài khoản <a href="dang-nhap-he-thong">Đăng nhập ngay</a></small>
    </div>
</div>
</div>

</div>
<script type="text/javascript">
$('#submit').click(function(){
var username = $('#username').val();
var password = $('#password').val();
if(username == ""){
  toarst("error","Vui lòng điền đầy đủ","Chưa điền tên người dùng!");
  return false;
}
if(password == ""){
  toarst("error","Vui lòng điền đầy đủ","Chưa điền mật khẩu!");
  return false;
}
$("#submit").prop('disabled',true).html("Đang xử lý");
  $.post('xuly/sinup.php',{
    username: username,
    password: password
  },function(data){
    Data = JSON.parse(data);
    if(Data.reload){
        setTimeout(() => {
        location.href = Data.reload;
        }, Data.time);
    }
    $("#submit").prop('disabled',false).html("ĐĂNG KÝ HỆ THỐNG");
    toarst(Data.type,Data.text,Data.title);
    return false;
  })
})
</script>