<?php if($username == $admin){  ?>
<div class="row">
<!-- bounceIn -->
<div class="col-lg-12" style="visibility: visible; animation-duration: 1s; animation-name:fadeIn;">
   <div class="card">
      <div class="card-header text-center"><i class="fa">&#xf11c;</i> Danh Sách Thành Viên</div>
         <div class="card-body">
             <div class="form-group">
                 <label>Tác Vụ Hàng Loạt:</label>
               <button type="button" id="del_all" class="m-1 btn-xs btn-danger">Xóa All (List)</button>
             </div>
             <!-- STAR-->
             <div class="table-responsive">
              <table id="thanh_vien" class="table table-bordered dataTable" role="grid" aria-describedby="default-datatable_info">
               <thead>
                 <tr role="row">
                     <th>STT</th>        
                     <th>Username</th>
                     <th>Số Dư</th>
                     <th>IP adddress</th>
                     <th>Ngày tham gia</th>
                    </tr>
               </thead>
               <tbody>
                <?php
                 $SQL = mysqli_query($kunloc,"SELECT * FROM account");
                 while ($echo = mysqli_fetch_assoc($SQL)):?>
                  <tr id="table_<?php echo $echo['id']; ?>">
                  <td><span class="badge badge-default"><?php echo $echo['id']; ?></span></td>
                  <td><span class="badge badge-default"><?php echo $echo['username']; ?></span></td>
                  <td>
                   <div class="media-body">
					  <b class="user-title"><span class="badge badge-secondary">Số dư:</span>
				      <span class="badge badge-primary"><?php echo $vnd= number_format($echo['VND']); ?></span></b>
				     </div>  
                    </td>
                  <td><span class="badge badge-default"><?php echo $echo['ip']; ?></span></td>
                  <td><span class="badge badge-dark"><?php echo $echo['time_reg']; ?></span></td>
                  </tr>
                  <?php $i++; endwhile; ?>
               </tbody>
            </table>
         </div>
         
      </div>
<!-- end -->
</div>
</div>
<!-- row -->   
</div>   
<script>
 $(document).ready(function() {
    var table = $('#thanh_vien').DataTable( {
    lengthChange: true,
      "aaSorting": [
                [0, "desc"]
            ],
        "iDisplayLength": 6,
        "aLengthMenu": [
            [6, 10, 20, 30, 40, 50, 100, 200, 500, 1000, -1],
            [6, 10, 20, 30, 40, 50, 100, 200, 500, 1000, "Tất cả"]
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
   table.buttons().container() .appendTo( '#example_wrapper .col-md-6:eq(0)' );
})
//=============================================
$("#thanh_vien").on('click', 'tr', function() {
	 $(this).toggleClass('table-active');
})
//====================Xóa Thành Viên==================
$('#del_all').click(function(){
    const swalWithBootstrapButtons = Swal.mixin({ customClass: { confirmButton: 'm-1 btn-sm btn-success', cancelButton: 'm-1 btn-sm btn-danger'}, buttonsStyling: true })
    swalWithBootstrapButtons.fire({
          title: 'Xóa thành viên?',
          text: "Bạn có muốn xóa!",
          icon: 'info',
          showCancelButton: true,
          confirmButtonText: 'Đồng ý',
          cancelButtonText: 'Hoàn tác',
          reverseButtons: false
    }).then((result) => {
    if (result.value) {
        var Data = $('#thanh_vien').DataTable().rows($('.table-active')).data();
		  for (var i = 0; i < Data.length; i++) {
		    id = Data[i][0].match(/">(.*)</)[1];
		    xoa_thanh_vien(i, id);
		}
    } 
    })	
    return false;
})
function xoa_thanh_vien(i,id) {
		 $.get('API/api_admin.php', { xoa_thanh_vien: id }, function(data, status) {
              var Data = JSON.parse(data)
                if(Data.success){
                    Swal.fire("Success!","Xóa Thành Công","success");
                    $('#thanh_vien').DataTable().row($('#table_'+id+'')).remove().draw();
                }
         })
}s
</script>
<?php
}else{
    echo "<script>Swal.fire('Thông Báo','Bạn Không Có Quyền Vào Đây','error'); setTimeout(function(){ window.location  = '$domain'; }, 2000);</script>";    
} 
?>