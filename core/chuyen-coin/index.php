<div class="row">
<div class="col-lg-5">
    <div class="card">
         <div class="card-header d-flex justify-content-between">
            <div class="header-title"><h4 class="card-title">Chuyển coin hệ thống</h4></div>
         </div>
         <form action="javascript:volid();" method="POST">
            <div class="card-body">
                <div class="form-group">
                    <label class="form_label">Nhập Username người nhận: </label>
                    <input  type="text" class="custom-select" name="username" id="username" placeholder ="ex: kunloc" required/>
                </div>
                <div class="form-group">
                    <label class="form_label">Nhập Số Tiền Cần Chuyển: </label>
                    <input type="number" class="custom-select" name="sotien" id="sotien" placeholder ="ex: 10000" required/>
                </div>
                <button class="btn-sm btn btn-outline-success" name="submit" id="submit" type="submit">GỬI TIỀN</button><br>
                
                <div id="progressbar" role="progressbar" class="ui-progressbar ui-corner-all ui-widget ui-widget-content ui-progressbar-indeterminate" style="display: none">
                    <div class="ui-progressbar-value ui-corner-left ui-widget-header" style="width: 102%;">
                    <div class="ui-progressbar-overlay"></div>
                    </div>
                </div>

            </div>
        </form>
 </div> 
</div>
 <!-- /./ -->
 <div class="col-lg-7">
    <div class="card">
         <div class="card-header d-flex justify-content-between">
            <div class="header-title"><h4 class="card-title">Hoạt động chuyển - nhận</h4></div>
         </div>
         <div class="card-body">
         <div class="table-responsive">
            <table id="lichsu_nhan" class="table table-bordered" style="width:100%">
               <thead>
                  <tr>
                     <th>Hành động</th>
                     <th>Ngày</th>
                     <th>Hình Thức</th>
                     <th>Số Tiền</th>
                     <th>Người gửi</th>
                     <th>Người nhận</th>
                  </tr>
               <tbody>
                <?php
                    if($username == $admin){
                       $SQL = mysqli_query($kunloc,"SELECT * FROM lich_su_chuyen_tien");
                    }else{
                       $SQL = mysqli_query($kunloc,"SELECT * FROM lich_su_chuyen_tien WHERE nguoi_nhan='$username'");
                    }
                    while ($echo = mysqli_fetch_array($SQL, MYSQLI_ASSOC)):?>
                  <tr>
                     <td>
                         <span href="#" onclick='remove(<?php echo $echo['id']; ?>)' class="badge badge-danger" data-toggle="tooltip" title="Nhấp vào để xóa">Gỡ lịch sử</span>
                    </td>
                    <td><b data-toggle="tooltip" title="Ngày" style="color:black"><?php echo $echo['date'] ?> </b></td>
                    <td><b data-toggle="tooltip" title="Số tiền" style="color:green"><?php echo $echo['hinh_thuc'] ?> </b></td>
                    <td><b data-toggle="tooltip" title="Số tiền" style="color:red"><?php echo number_format($echo['VND']) ?> </b>VND</td>
                    <td><b data-toggle="tooltip" title="Người gửi" style="color:blue"><?php echo $echo['nguoi_gui']; ?> </b></td>
                    <td><b data-toggle="tooltip" title="Người nhận" style="color:#222222"><?php echo $echo['nguoi_nhan']; ?> </b></td>
                    
                  </tr>
                  <?php $i++; endwhile; ?>
               </tbody>
               </thead>
            </table>
         </div>
         </div>
</div>
</div>
<!-- /./ row -->
</div>
<script type="text/javascript">
  $(document).ready(function() {
    var table = $('#lichsu_chuyen').DataTable( {
    lengthChange: true,
   "aaSorting": [
            [0, "desc"]
        ],
        "iDisplayLength": 5,
        "aLengthMenu": [
            [5, 10, 20, 30, 40, 50, 100, 200, 500, 1000, -1],
            [5, 10, 20, 30, 40, 50, 100, 200, 500, 1000, "Tất cả"]
        ],
        "oLanguage": {
            "lengthMenu": "Hiển thị _MENU_ mục",
            "zeroRecords": "Không tìm thấy kết quả",
            "sInfo": "Hiển Thị _START_ trong _END_ của _TOTAL_ mục",
            "sEmptyTable": "Không có dữ liệu trong bảng",
            "sInfoEmpty": "Hiển Thị 0 trong 0 của 0 bảng",
            "sInfoFiltered": "(Đã lọc từ _MAX_ tổng bảng)",
            "sInfoPostFix": "",
            "sDecimal": "",
            "sThousands": ",",
            "sLengthMenu": "Hiển thị _MENU_ mục",
            "sLoadingRecords": "Đang tải...",
            "sProcessing": "Processing...",
            "sSearch": "Tiềm kiếm:",
            "sZeroRecords": "Không tìm thấy kết quả",
            "sSearchPlaceholder": "Nhập từ cần tìm...",
            "oPaginate": {
                "sFirst": "ĐẦU",
                "sLast": "Cuối",
                "sNext": "Tiếp",
                "sPrevious": "Trước"
            },
            "oAria": {
                "sSortAscending": ": ASC Tăng Dần",
                "sSortDescending": ": DESC Giảm Dần"
            }
        }
  })
  var table = $('#lichsu_nhan').DataTable( {
    lengthChange: true,
   "aaSorting": [
            [0, "desc"]
        ],
        "iDisplayLength": 5,
        "aLengthMenu": [
            [5, 10, 20, 30, 40, 50, 100, 200, 500, 1000, -1],
            [5, 10, 20, 30, 40, 50, 100, 200, 500, 1000, "Tất cả"]
        ],
        "oLanguage": {
            "lengthMenu": "Hiển thị _MENU_ mục",
            "zeroRecords": "Không tìm thấy kết quả",
            "sInfo": "Hiển Thị _START_ trong _END_ của _TOTAL_ mục",
            "sEmptyTable": "Không có dữ liệu trong bảng",
            "sInfoEmpty": "Hiển Thị 0 trong 0 của 0 bảng",
            "sInfoFiltered": "(Đã lọc từ _MAX_ tổng bảng)",
            "sInfoPostFix": "",
            "sDecimal": "",
            "sThousands": ",",
            "sLengthMenu": "Hiển thị _MENU_ mục",
            "sLoadingRecords": "Đang tải...",
            "sProcessing": "Processing...",
            "sSearch": "Tiềm kiếm:",
            "sZeroRecords": "Không tìm thấy kết quả",
            "sSearchPlaceholder": "Nhập từ cần tìm...",
            "oPaginate": {
                "sFirst": "ĐẦU",
                "sLast": "Cuối",
                "sNext": "Tiếp",
                "sPrevious": "Trước"
            },
            "oAria": {
                "sSortAscending": ": ASC Tăng Dần",
                "sSortDescending": ": DESC Giảm Dần"
            }
        }
  })
   table.buttons().container().appendTo( '#example_wrapper .col-md-6:eq(0)' );
});
$('#submit').click(function(){
   var username = $('#username').val();
   var sotien = $('#sotien').val();
   if (username == '' || sotien == '') {
        Swal.fire("Còn thiếu gì đó","Xin hãy điền đầy đủ","info");
   	    return false;
   }
   $("#progressbar").show();
   $('#submit').prop('disabled', true).html('<i class="fa fa-refresh fa-spin" style="font-size:11px"></i> Đang Kiểm Tra...').attr('disabled','disabled');
   $.post('core/chuyen-coin/xuly.php', { 
       username: username,
       sotien:sotien}, 
    function(data) {
       setTimeout(function(){ 
            Data = JSON.parse(data);
            if(Data.reload){
                setTimeout(() => { location.reload() }, Data.time)
            }
            Swal.fire(Data.title, Data.text,Data.type);
       	    $("#progressbar").hide();
       	    $('#submit').prop('disabled', false).html('GỬI TIỀN');
       }, 0);
   })

})
function remove(id) {
 		const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'm-1 btn-sm btn-success',
    cancelButton: 'm-1 btn-sm btn-danger'
  },
  buttonsStyling: true
})
swalWithBootstrapButtons.fire({
  title: 'Xác nhận xóa Lịch Sử Này?',
  text: "Bạn chắc chắn muốn xóa!",
  icon: 'info',
  showCancelButton: true,
  confirmButtonText: 'Đồng ý',
  cancelButtonText: 'Hoàn tác',
  reverseButtons: false
}).then((result) => {
  if (result.value) {
    $.post('core/chuyen-coin/setting.php', { 
           type: 'remove', 
           id: id
        }, function(data) {
            Data = JSON.parse(data);
            if(Data.reload){
                setTimeout(() => { location.reload() }, Data.time)
            }
            Swal.fire(Data.title, Data.text,Data.type);
    })
  } 
})
return false;
}
</script>