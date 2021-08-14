<?php
session_start();
include ("../../../config.php");
if(isset($_GET['clone'])){
	$clone = $_GET['clone'];
	$loai = $_GET['loai'];
	$token = explode("|",$clone)[2]; // Tách Token
	$idfb = explode("|",$clone)[0]; // Tách ID|PASSS
	$me = json_decode(file_get_contents('https://graph.facebook.com/me?access_token='.$token),true);
	if(isset($me['id']) && !preg_match('|@tfbnw.net|',$me['email'])){
	    /* DẠNG ID|PASS|TOKEN|COOKIE|..... */
		if($loai == 1){ 
		if(mysqli_num_rows(mysqli_query($kunloc,"SELECT * FROM clone WHERE token = '$token' AND loai = '1'"))) {
		        $total = mysqli_num_rows(mysqli_query($kunloc,"SELECT id FROM clone WHERE  loai = '1'"));
		        mysqli_query($kunloc,"UPDATE clone SET idfb = '".$me['id']."' WHERE idfb = '".$me['id']."' , clone = '$clone' WHERE clone = '$clone',token= '$token' WHERE token = '$token'");
				$echo['trangthai'] = 'update';
				$echo['total'] = $total;
				ECHO json_encode($echo,JSON_UNESCAPED_UNICODE);
			}else{
			    $total = mysqli_num_rows(mysqli_query($kunloc,"SELECT id FROM clone WHERE  loai = '2'"));
				mysqli_query($kunloc,"INSERT INTO clone SET idfb = '".$me['id']."', clone = '$clone', token = '$token', loai = '1'");
				$echo['trangthai'] = 'insert';
				$echo['total'] = $total;
				ECHO json_encode($echo,JSON_UNESCAPED_UNICODE);
			}
		}
	}else if($loai == 2){
	 /* DẠNG ID|PASS|... */
			if(mysqli_num_rows(mysqli_query($kunloc,"SELECT * FROM clone WHERE clone = '$clone' AND loai = '2'"))) {
			    $total = mysqli_num_rows(mysqli_query($kunloc,"SELECT id FROM clone WHERE  loai = '2'"));
		    	mysqli_query($kunloc,"UPDATE clone SET idfb = '$idfb' WHERE idfb = '$idfb' , clone = '$clone' WHERE clone = '$clone'");
				$echo['trangthai'] = 'update';
				$echo['total'] = $total;
				ECHO json_encode($echo,JSON_UNESCAPED_UNICODE);
			}else{
			    $total = mysqli_num_rows(mysqli_query($kunloc,"SELECT id FROM clone WHERE  loai = '2'"));
			    mysqli_query($kunloc,"INSERT INTO clone SET idfb = '$idfb', clone = '$clone', token = 'none' , loai = '2'");
				$echo['trangthai'] = 'insert';
				$echo['total'] = $total;
				ECHO json_encode($echo,JSON_UNESCAPED_UNICODE);
			}
		}else{
		    $echo['trangthai'] = 'die';
			$echo['total'] = $total;
			ECHO json_encode($echo,JSON_UNESCAPED_UNICODE);
		}
exit();
}
?>
<?php include ("../../../main/head.php"); if($username == $admin){ ?>
<body>
<div id="wrapper" class="wrapper" style="padding-top:30px">
    <div class="container">
         <div class="col-md-13">
          <div class="card">
                <div class="card-header text-uppercase text-center"><i class="fa">&#xf11c;</i> Thêm clone - Kunloc <span style="color:red" id="total">0</span></div>
                    <div class="card-body"> 
                    <form action="javascript:volid();">
                    <!-- /./ -->	
    				<div class="form-group">
    					<textarea style="height:200px" class="custom-select" id="listclone"  placeholder="list clone mỗi cái một dòng"></textarea>
    				</div>
    				<!-- /./ -->	
    				<div class="form-group">
                        <select id="loai" class="custom-select">
                        <option value="1">Loại 1 : Clone ID|PASS|TOKEN|COOKIE</option>
                        <option value="2">Loại 2: Clone ID|PASS|COOKIE</option>
            		    </select>
                    </div>
                    <!-- /./ -->	
    					<div class="form-group">
    			            <button type="submit" class="btn-xs btn-dark btn-radius" id="submit" onclick="addclone();">BẮT ĐẦU THÊM CLONE...</button>
    					</div>
    			 </form>
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
     function addclone() {
		var insert = 0, update = 0, die = 0;
        var listclone = $('#listclone').val();
		var loai = $('#loai').val();
        if (listclone == '') {
            swal("Yêu cầu","Còn thiếu gì đó!","error");
            return false;
        }
		$('#trangthai').show();
		$('#submit').prop('disabled', true).html('Đang tải')
		var tach_clone = listclone.split('\n');
		var total = tach_clone.length;
        	for(i = 0; i < total; i++){
        		var clone = tach_clone[i].trim();
                $.get('Addclone', { clone: clone, loai: loai }, function(data, status) {
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