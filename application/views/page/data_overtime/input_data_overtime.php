 <link href="<?php echo base_url(); ?>/assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" />
	<link href="<?php echo"".base_url().""; ?>assets/js/plugins/datapicker/datepicker3.css" rel="stylesheet" type="text/css" />
   		<link href="<?php echo"".base_url().""; ?>assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
	<style>
		
	</style>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            INPUT DATA LEMBUR
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url() ?>index.php/home"><i class="fa fa-home"></i> Home</a></li>
			<li><a href="<?php echo base_url(); ?>/index.php/data_overtime/index"><i class="fa fa-calendar"></i> Data Lembur </a></li>
            <li class="active">Input Data Lembur </li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
			<div class="row">
				<div class="col-md-12">
					<div class="box box-primary">
						<div class="box-body">
							<form id="form_input_shoes">
							<div class="col-md-6">
									<input type="hidden" name="user_id" value="<?php echo $this->session->userdata('id_user'); ?>"class="form-control" id="user_id" >
									
									
									<div class="form-group">
										<label for="exampleInputEmail1">Tanggal </label>
										<input type="text" name="date" class="datepicker form-control" readonly="readonly"id="tanggal" >
											<div id="tanggal_alert" style="color:red"></div>
									</div>
								
									<div class="form-group">
									<label for="exampleInputEmail1">Jam Masuk</label>
									  <div class='input-group date' id='jam_masuk'>
										<input type='text' class="form-control" name="start_hour" id="start_hour" readonly />
										<span class="input-group-addon">
										  <span class="glyphicon glyphicon-time"></span>
										</span>
									  </div>
									  <div id="start_hour_alert" style="color:red"></div>
									</div>
									
										<div class="form-group">
									<label for="exampleInputEmail1">Jam Keluar</label>
									  <div class='input-group date' id='jam_keluar'>
										<input type='text' class="form-control" name="end_hour" id="end_hour" readonly />
										<span class="input-group-addon">
										  <span class="glyphicon glyphicon-time"></span>
										</span>
									  </div>
									    <div id="end_hour_alert" style="color:red"></div>
									</div>
									<div class="form-group">
										<label for="exampleInputEmail1">Keterangan </label>
										<input type="text" name="keterangan" class="form-control" id="keterangan" >
											<div id="keterangan_alert" style="color:red"></div>
									</div>
									
									
									
									<input type="submit" value="simpan" class="btn btn-block btn-success" style="width:100px">
									
								
							</div>
							
						
					</div><!-- /.box -->
				</div>	
			</div>
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
		
	
<script src="<?php echo"".base_url().""; ?>/assets/js/moment.js"></script>
<script src="<?php echo"".base_url().""; ?>/assets/js/bootstrap-datetimepicker.min.js"></script>
		 <script src="<?php echo"".base_url().""; ?>/assets/js/plugins/datapicker/bootstrap-datepicker.js"></script>
	
		<script type="text/javascript">
			$(function () {
				$('#jam_masuk').datetimepicker({
					format: 'HH:mm',
					 ignoreReadonly: true
                });
				$('#jam_keluar').datetimepicker({
					format: 'HH:mm',
					 ignoreReadonly: true
                });
			
			});
		</script>
			<script>
			 $('.datepicker').datepicker({
				format: 'yyyy-mm-dd',
				autoclose:true
			 });
		</script>
<script>
	$('#form_input_shoes').submit(function(e){
			var end_hour=$("#end_hour").val();
	var start_hour=$("#start_hour").val();
	var tanggal=$("#tanggal").val();
	var keterangan=$("#keterangan").val();
	
	
	if(end_hour == ""){
		$("#end_hour_alert").html('Tanggal Selesai Ijin Tidak Boleh Kosong');
	}else{
		
	}
	if(start_hour == ""){
		$("#start_hour_alert").html('Tanggal Mulai Ijin Tidak Boleh Kosong');
	}else{
		
	}
	if(tanggal == ""){
		$("#tanggal_alert").html('Alasan Tidak Boleh Kosong');
	}else{
		
	}
	if(keterangan == ""){
		$("#keterangan_alert").html('Keterangan Tidak Boleh Kosong');
	}else{
		
	}
	if(end_hour != "" && start_hour != "" && tanggal != "" && keterangan != ""){
		formData = new FormData($(this)[0]);
			$.ajax({
					url 	: '<?php echo base_url(); ?>/index.php/data_overtime/save_overtime',
					type	: 'POST',
					data	: formData,
					async	: false,
					cache	: false,
					processData : false,
					contentType	: false,
					success:function (data){
	
						//location.href = "<?php echo base_url() ?>index.php/shoes_index_controller";
						sweetAlert({
	                                                   title: "Berhasil!", 
                                                        text: "Berhasil Masuk!", 
                                                        type: "success",
														
														 showCancelButton: false,//There won't be any cancle button
															showConfirmButton  : true ,
                                                        }
														, function() {
																	//location.href='<?php echo base_url() ?>/index.php/data_overtime/index';
																	location.reload();
														}
														);
						
					}
				})
		
	}
			return false;
	});
</script>
<script>
			$(document).ready(function(){
            $.ajax({
                url     : '<?php echo base_url() ?>index.php/brands_controller/data_brands',
                type    : 'GET',
                async   : false,
                cache   : false,
                processData : false,
                contentType : false,
                success:function (data_master_equipment){
						$('#brands_get').append('<option value="">--Select Brands--</option>');
                    $.each(data_master_equipment.data, function(i, item){
                        $('#brands_get').append('<option value="'+item.id_brands+'">'+item.name_brands+'</option>');
                    })
                }
            })
		});
</script>
<script>
			$(document).ready(function(){
            $.ajax({
                url     : '<?php echo base_url() ?>index.php/shoes_category_controller/data_shoes_category',
                type    : 'GET',
                async   : false,
                cache   : false,
                processData : false,
                contentType : false,
                success:function (data_master_equipment){
						$('#category_shoes').append('<option value="">--Select Category Shoes--</option>');
                    $.each(data_master_equipment.data, function(i, item){
                        $('#category_shoes').append('<option value="'+item.id_category+'">'+item.name_category+'</option>');
                    })
                }
            })
		});
</script>
   <script src="<?php echo"".base_url().""; ?>/assets/js/admin.js"></script>
	

	   <script src="<?php echo"".base_url().""; ?>/assets/plugins/node-waves/waves.js"></script>

