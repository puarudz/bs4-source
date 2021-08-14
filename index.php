<?php
ob_start();
session_start();
include_once("config.php");
include_once("main/head.php");
?>
<body>
<?php if($username){ ?>
<script type="text/javascript">
    $(document).ready(function(){
        setInterval(() => {
                $.post('API/api_money.php', { type: 'get_money' }, function(data) {
                            Data = JSON.parse(data)
                            $('#sodu').text(Data.vnd);
                        })
            },1e3);
        $.post('API/api_notication.php', { type: 'get_thongbao' }, function(data) {
            Data = JSON.parse(data)
            kunloc = '';
            if(Data.id,Data.title,Data.text){
                $('#btn-notification').click();
                kunloc +='<div class="text-center">\n';
                kunloc +='<img  src="https://www.flaticon.com/svg/static/icons/svg/2905/2905459.svg" style="width:80px" class="rounded-circle">\n';
                kunloc +='<div class="mt-3 font-wegiht-bold">'+Data.title+'</div>\n';
                kunloc +='<div class="m-1">'+Data.text+'</div>\n';
                kunloc +='<div class="m-2"><button onclick="off('+Data.id+')" class="btn-sm btn btn-outline-success">Tôi Đã Đọc!!!!</button></div>\n';
                kunloc +='</div>\n';
                $('#view-data-notification').html(kunloc);
            /*const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: true
            })
            swalWithBootstrapButtons.fire({
                title: ""+Data.title+"",
                text: ""+Data.text+"",
                icon: ""+Data.type+"",
                showCancelButton: true,
                confirmButtonText: "Loại bỏ tin này",
                cancelButtonText: 'Cancel!',
                everseButtons: true
            }).then((result) => {
            
            if (result.value) {
                $.post('API/api_notication.php', { type: 'update_thongbao' , id: Data.id}, function(msg) {
                        Data_ = JSON.parse(msg)
                        if(Data_.success){
                            Swal.fire('Cảm ơn!','Cảm ơn bạn đã đóng góp cho hệ thống','success'); 
                        }else if(Data_.error){
                            Swal.fire('Thử lại sau!','Lỗi severs','error'); 
                        }
                })
            }
            })
           return false;*/
           }
    })
})
function off(id){
        $.post('API/api_notication.php', { type: 'update_thongbao' , id: id}, function(msg) {
           Data_ = JSON.parse(msg)
        if(Data_.success){
            $('.close').click();
            Swal.fire('Cảm ơn!','Cảm ơn bạn đã đóng góp cho hệ thống','success'); 
            return false;
        }else if(Data_.error){
            Swal.fire('Lỗi severs','Hãy Thử lại sau!','error'); 
            return false;
        }
     })
}
</script>
<?php } ?>
<div id="wrapper" class="wrapper">
<?php include_once("main/case.php"); ?>
</div>