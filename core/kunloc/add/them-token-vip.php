<?php
session_start();
include ("../../../config.php");
if(isset($_GET['token'])){
	$token = $_GET['token'];
	$loai = $_GET['loai'];
	$me = json_decode(auto('https://graph.facebook.com/me?access_token='.$token),true);
	if(isset($me['id']) && !preg_match('|@tfbnw.net|',$me['email'])){
		    if($loai == 1){
			if(mysqli_num_rows(mysqli_query($kunloc,"SELECT * FROM token_like WHERE token = '$token'"))) {
    			$total = mysqli_num_rows(mysqli_query($kunloc,"SELECT id FROM token_like"));
    			mysqli_query($kunloc,"UPDATE token_like SET idfb = '".$me['id']."' WHERE idfb = '".$me['id']."' ,token = '$token' WHERE token = '$token'");
    			$echo['trangthai'] = 'update';
    			$echo['total'] = $total;
    			ECHO json_encode($echo,JSON_UNESCAPED_UNICODE);
			}else{
			    $total = mysqli_num_rows(mysqli_query($kunloc,"SELECT id FROM token_like"));
				mysqli_query($kunloc,"INSERT INTO token_like SET idfb = '".$me['id']."',token = '$token' ");
				$echo['trangthai'] = 'insert';
    			$echo['total'] = $total;
    			ECHO json_encode($echo,JSON_UNESCAPED_UNICODE);
			}
			}
			if($loai == 2){
			if(mysqli_num_rows(mysqli_query($kunloc,"SELECT * FROM token_cmt WHERE token = '$token'"))) {
			    $total = mysqli_num_rows(mysqli_query($kunloc,"SELECT id FROM token_cmt"));
			    mysqli_query($kunloc,"UPDATE token_cmt SET idfb = '".$me['id']."' WHERE idfb = '".$me['id']."' ,token = '$token' WHERE token = '$token'");
			    $echo['trangthai'] = 'update';
    			$echo['total'] = $total;
    			ECHO json_encode($echo,JSON_UNESCAPED_UNICODE);
			    
			}else{
			    $total = mysqli_num_rows(mysqli_query($kunloc,"SELECT id FROM token_cmt"));
				mysqli_query($kunloc,"INSERT INTO token_cmt SET idfb = '".$me['id']."',token = '$token' ");
				$echo['trangthai'] = 'insert';
    			$echo['total'] = $total;
    			ECHO json_encode($echo,JSON_UNESCAPED_UNICODE);
			}
			
			}
			if($loai == 3){
			if(mysqli_num_rows(mysqli_query($kunloc,"SELECT * FROM token_share WHERE token = '$token'"))) {
			    $total = mysqli_num_rows(mysqli_query($kunloc,"SELECT id FROM token_share"));
			    mysqli_query($kunloc,"UPDATE token_share SET idfb = '".$me['id']."' WHERE idfb = '".$me['id']."' ,token = '$token' WHERE token = '$token'");
			    $echo['trangthai'] = 'update';
    			$echo['total'] = $total;
    			ECHO json_encode($echo,JSON_UNESCAPED_UNICODE);
			    
			}else{
			    $total = mysqli_num_rows(mysqli_query($kunloc,"SELECT id FROM token_share"));
				mysqli_query($kunloc,"INSERT INTO token_share SET idfb = '".$me['id']."',token = '$token' ");
				$echo['trangthai'] = 'insert';
    			$echo['total'] = $total;
    			ECHO json_encode($echo,JSON_UNESCAPED_UNICODE);
			}
			}
			if($loai == 4){
			if(mysqli_num_rows(mysqli_query($kunloc,"SELECT * FROM token_sub WHERE token = '$token'"))) {
			    $total = mysqli_num_rows(mysqli_query($kunloc,"SELECT id FROM token_sub"));
			    mysqli_query($kunloc,"UPDATE token_sub SET idfb = '".$me['id']."' WHERE idfb = '".$me['id']."' ,token = '$token' WHERE token = '$token'");
			    $echo['trangthai'] = 'update';
    			$echo['total'] = $total;
    			ECHO json_encode($echo,JSON_UNESCAPED_UNICODE);
			    
			}else{
			    $total = mysqli_num_rows(mysqli_query($kunloc,"SELECT id FROM token_sub"));
				mysqli_query($kunloc,"INSERT INTO token_sub SET idfb = '".$me['id']."',token = '$token' ");
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
    			        <option value="1">Token LIKE</option>
    			        <option value="2">Token CMT  </option>
    			        <option value="3">Token SHARE </option>
    			        <option value="4">Token SUB </option>
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
        $.get('Addtoken2', { token: token, loai:loai }, function(data, status) {
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
<?php 
}else{
     echo "<script>Swal.fire('Thông Báo','Bạn Không Có Quyền Vào Đây','error'); setTimeout(function(){ window.location  = '$domain/Home'; }, 2000);</script>";    
} 
?>
</body>
</html>