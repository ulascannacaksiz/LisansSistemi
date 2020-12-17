<?php
include "x.php";
$linksil = '<div id="silislem"><a href="" onclick="silfonks()"> SİL </a></div>';
echo $linksil;
echo'<a href="" onclick="confirmDelete2()">Ajax in this Delete will work</a>';

    //Some code

?>
<a href="" onclick="confirmDelete2()">Ajax in this Delete will work</a>
<script>
    $(document).on("click", ".btn-delete", function(e){
    e.preventDefault();
    url = $(this).attr("href");
    swal({
            title:"Do you want delete this item?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false,
            confirmButtonText: "Delete",
            cancelButtonText: "Cancel",
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
        },
        function(isConfirm){
            if(isConfirm){
                $.ajax({
                    url: url,
                    type: "POST",
                    success: function(resp){
                        window.location.href = base_url + resp;
                    }
                });
                }
            return false;
        });
    });
	</script>