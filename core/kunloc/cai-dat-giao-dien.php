<?php if(($username == $admin || $level == 'admin') || ($level == 'ctv')){  ?>
<!-- Breadcrumb-->
<div class="row pt-1 pb-2 hidden-xs">
        <div class="col-sm-9">
		    <h5 class="page-title">Chào mừng đến với <?php echo $url ?></h5>
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javaScript:void();"><span class="badge badge-success">Home</span></a></li>
            <li class="breadcrumb-item"><a href="javaScript:void();"><span class="badge badge-danger">Chức năng</span></a></li>
            <li class="breadcrumb-item active" aria-current="page">Cài đặt hệ thống</li>
         </ol>
	   </div>
	   
	   <div class="col-sm-3">
        <div class="btn-group float-sm-right">
        <button type="button" class="btn-sm btn-submit waves-effect waves-light" style="border:1px solid #151515;color:#333;background:#eeeeee"> <?= $url ?> | Cài đặt</button>
        </div>
     </div>
     
    </div>	
<!-- bounceIn -->
<div class="col-lg-13" style="visibility: visible; animation-duration: 1s; animation-name:fadeIn;">
   <div class="card">
      <div class="card-header text-center"><i class="fa">&#xf2c2;</i> Cài Đặt Hệ Thống </div>
        <form method="POST">
         <div class="card-body text-center">
             <!-- /./ -->
            <div class="irow row"> 
               <div class="col-sm-4 select">   
                  <img src="<?= $background ?>" style="height:80px;width:80px;border-radius:50px">
                    <div class="form-group">
                        <label class="form-label" style="color:black">Background:</label>
                        <input type="text" name="background" id="background" class="custom-select" style="font-size:14px;color:green;border-radius:25px"  value="<?= $background ?>" placeholder="Vui lòng điền link hoặc url..."required/>
                   </div>            
                </div>
              <!-- /./ -->  
                <div class="col-sm-4">   
                   <img src="<?= $logo ?>" style="height:80px;width:80px;border-radius:50px">
                    <div class="form-group">
                        <label class="form-label" style="color:black">LOGO URL:</label>
                        <input type="text" name="logo" id="logo" class="custom-select" style="font-size:14px;color:green;border-radius:25px" value="<?= $logo ?>" placeholder="Vui lòng điền link hoặc url..."required/>
                     </div>    	        
                    <!-- /./ -->
                </div>      
                    <div class="col-sm-4">
                        <img src="<?= $image1  ?>" style="height:80px;width:80px;border-radius:50px">
                        <div class="form-group">
                            <label class="form-label" style="color:black">Ảnh1:</label>
                            <input type="text" name="image1" id="image1" class="custom-select" style="font-size:14px;color:red;border-radius:25px" value="<?= $image1 ?>" placeholder="Vui lòng điền link hoặc url..."required />
                        </div>
                    </div>
                </div>
                <!-- /./ -->
               <div class="irow row" style="margin-bottom:0px">
                  <div class="col-sm-4 select">
                     <img src="<?= $image2  ?>" style="height:80px;width:80px;border-radius:50px"></center>
                          <div class="form-group">
                            <label class="form-label" style="color:black">Ảnh 2:</label>
                            <input type="text" name="image2" id="image2" class="custom-select" style="font-size:14px;color:red;border-radius:25px" value="<?= $image2 ?>" placeholder="Vui lòng điền link hoặc url... "required/>
                     </div>
                    </div>
                <!-- /./ -->  
                <div class="col-sm-4">
                    <img src="<?= $image3  ?>" style="height:80px;width:80px;border-radius:50px">
                <div class="form-group">
                      <label class="form-label" style="color:black">Ảnh 3:</label>
                      <input type="text" id="image3" name="image3" class="custom-select" style="font-size:14px;color:red;border-radius:25px" value="<?= $image3 ?>" placeholder="Vui lòng điền link hoặc url..."required/>
                </div>
               </div>  
               <!-- /./ -->
              <div class="col-sm-4">
                <img src="<?= $image4  ?>" style="height:80px;width:80px;border-radius:50px">
                <div class="form-group">
                        <label class="form-label" style="color:black">Ảnh 4:</label>
                        <input type="text" name="image4" id="image4" class="custom-select" style="font-size:14px;color:red;border-radius:25px" value="<?= $image4 ?>" placeholder="Vui lòng điền link hoặc url...">   
                </div>
              </div>
             </div>
            

            </div>
            <div class="card-footer text-left">
                <button type="submit" name="img_submit" id="img_submit" class="btn-xs btn-submit" style="background-color:#fff;color:#333;border-width:1px;border-style:solid;border-color:#333;border-radius:15px">Hoàn Thành Cập Nhật Thông Tin
                <img src="https://upload.wikimedia.org/wikipedia/commons/6/66/Info_groen.png" style="margin-top:-2px;width:10px;height:10px"> 
           </button>
            </div>
            </from>

</div>
</div>

</div>
<script type="text/javascript">
$('#img_submit').click(function(){
    var background = $('#background').val();
    var logo = $('#logo').val();
    var image1 = $('#image1').val();
    var image2 = $('#image2').val();
    var image3 = $('#image3').val();
    var image4 = $('#image4').val(); 
    $('#img_submit').prop('disabled', true).html('Đang Kiểm Tra...');
    $.post('core/kunloc/setting.php', {
        type: 'img',
        background:background,
        logo:logo,
        image1:image1,
        image2:image2,
        image3:image3,
        image4:image4
    }, function(data){
        Data = JSON.parse(data);
        if(Data.reload){
            setTimeout(() => { location.reload() }, Data.time)
        }
        Swal.fire(Data.title, Data.text,Data.type);
        $('#img_submit').prop('disabled', false).html('Hoàn Thành Cài Đặt');
    })
 
})
</script>
<?php
}else{
     echo "<script>Swal.fire('Thông Báo','Bạn Không Có Quyền Vào Đây','error'); setTimeout(function(){ window.location  = '$domain_url'; }, $time_swal);</script>";    
}
?>