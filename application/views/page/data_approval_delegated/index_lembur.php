    <style>
		.datepicker{
			z-index:1151 !important;
		}
	</style>
	<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            DATA LEMBUR UNTUK DISETUJUI
          </h1>
          <ol class="breadcrumb">
             <li><a href="<?php echo base_url() ?>index.php/home"><i class="fa fa-home"></i> Home</a></li>
           <li class="active">Data Lembur Untuk Disetujui </li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
			<div class="row">
				<div class="col-md-12">
					<div class="box box-primary">
						<div class="box-body">
							
							
							<table class="table table-striped" id="data-brands">
								<thead>
									<tr>
										<th>Nama Pegawai</th>
										<th>Tanggal</th>
										
										<th>Jam Mulai </th>
										<th>Jam Selesai </th>
										
										
										<th>Option</th>
									</tr>
								</thead>
								<tbody>
								
								</tbody>
							</table>
						</div><!-- /.box-body -->
					</div><!-- /.box -->
				</div>	
			</div>
					
				
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
		
	<script src="<?php echo"".base_url().""; ?>/assets/js/jquery.min.js" type="text/javascript"></script>
	<script>
		$(document).ready(function(){ 
			$("#data-brands").dataTable({
					"bPaginate": true,
					"bLengthChange": true,
					"bFilter": true,
					"bSort": true,
					"bInfo": true,
					"bAutoWidth": false,
					"processing": true,
					"ajax": '<?php echo base_url() ?>/index.php/data_overtime/get_data_overtime_approval_delegated',
					"columns": [
							{ "data": "nama_user.0.first_name" },
						{ "data": "date" },
						{ "data": "start_hour" },
						{ "data": "end_hour" },
					
						{ "data": "data_approval_status" },
						
						
						
						 /* { "data": "NOMOR_PENGAJUAN_PIB", 
							"render" : function(data){
										var data_array 					= data.split('-');
										var data_nomor_pengajuan 		= data_array[0];
										
                   							return '<a href="#"><button type="button" class="btn btn-info btn-sm"  data-toggle="modal" data-target="#myModal_bea_cukai" style="border-radius:0px;" onclick="edit_pib_bea_cukai('+data_array+')";><i class="fa fa-check"></i></button></a>'
						 }}, */
						{ "data": "id", 
						"render" : function(data){
							return '<a href="#"><button type="button" onclick="delete_master_shoes_category('+data+')" class="btn btn-warning btn-sm" style="border-radius:0px;" ><i class="fa fa-check"></i></button></a>'
						}}
					]
			});
			

			
				
		});
	</script>
	
	<script>
		function delete_master_shoes_category(id){
				var x;
				if (confirm("Do You Will Delete This Data??") == true) {
					url_edit = '<?php echo base_url()?>index.php/shoes_index_controller/delete_shoes_index/'+id,
					$.getJSON(url_edit, function (data){
						alert(data.result);
						location.reload();
					})
				} else {
					
				}
			}
	</script>
	<script>
		function delete_master_shoes_category(id){
	swal({   
    title: "Konfirmasi Approval Lembur",   
    text: "Apakah Anda Akan Menyetujui Lembur Ini?",   
    type: "warning",   
    showCancelButton: true,   
    confirmButtonColor: "#DD6B55", 
    confirmButtonText: "Approv",   
    cancelButtonText: "Cancel",   
    closeOnConfirm: false,   
    closeOnCancel: false 
}, function(isConfirm){   
    if (isConfirm) {
	
      url_edit = '<?php echo base_url()?>index.php/data_overtime/approval_lembur/'+id,
						$.getJSON(url_edit, function (data){
						sweetAlert({
	                                                   title: "Berhasil!", 
                                                        text: "Data Berhasil Diapprove!", 
                                                        type: "success",
														
														 timer: 1200,
														 showCancelButton: false,//There won't be any cancle button
															showConfirmButton  : false ,
                                                        }
														, function() {
																	location.reload();
																}
														);
					})
    }else{
        swal({title:"Cancelled",text:"", type:"error"},function(){
            location.reload();
        });
    }
});
			}
	</script>
  
	   <script src="<?php echo"".base_url().""; ?>/assets/js/admin.js"></script>
	

	   <script src="<?php echo"".base_url().""; ?>/assets/plugins/node-waves/waves.js"></script>


