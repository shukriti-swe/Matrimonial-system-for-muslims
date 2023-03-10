<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
	<div id="page-head">
		<!--Page Title-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<div id="page-title">
			<h1 class="page-header text-overflow"><?php echo translate('manage_staffs')?></h1>

		</div>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<!--End page title-->
		<!--Breadcrumb-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<ol class="breadcrumb">
			<li><a href="#"><?php echo translate('home')?></a></li>
			<li><a href="#"><?php echo translate('staffs_panel')?></a></li>
			<li class="active"><a href="#"><?php echo translate('manage_staff')?></a></li>
			
		</ol>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<!--End breadcrumb-->
	</div>
	<!--Page content-->
	<!--===================================================-->
	<div id="page-content">
		<!-- Basic Data Tables -->
		<!--===================================================-->
		<div class="panel">
			<?php if (!empty($success_alert)): ?>
				<div class="alert alert-success" id="success_alert" style="display: block">
	                <button class="close" data-dismiss="alert"><i class="pci-cross pci-circle"></i></button>
	                <?=$success_alert?>
	            </div>
			<?php endif ?>
			<?php if (!empty($danger_alert)): ?>
				<div class="alert alert-danger" id="danger_alert" style="display: block">
	                <button class="close" data-dismiss="alert"><i class="pci-cross pci-circle"></i></button>
	                <?=$danger_alert?>
	            </div>
			<?php endif ?>
			<div class="panel-heading">
				<h3 class="panel-title"><?php echo translate('all_roles')?></h3>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-12 pull-right" style="padding-bottom: 10px">
						<!-- <a href="<?=base_url()?>admin/role/add_role" class="btn btn-primary btn-sm btn-labeled fa fa-plus">Create New</a> -->
						<a href='<?=base_url()?>admin/admins/add_admin' id='demo-dt-view-btn' class='btn btn-primary btn-sm btn-labeled fa fa-plus' data-toggle='tooltip' data-placement='top' title='' >Create New</a>
						<!-- <button data-target="#role_modal" data-toggle="modal" id="add_role" class="btn btn-primary btn-sm btn-labeled fa fa-plus"><?php echo translate('create_new')?></button> -->
					</div>
				</div>
				<div class="row">
					<table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
						<tr>
							<th width="10%">#</th>
							<th>
								<?php echo translate('name')?>
							</th>
							<th>
								<?php echo translate('email')?>
							</th>
							<th>
								<?php echo translate('role')?>
							</th>
							
							<th width="15%">
								<?php echo translate('options')?>
							</th>
						</tr>
						</thead>
						<tbody>
           
							<?php  $masters = $this->db->get_where('admin', array('admin_id' => 1))->result();

								foreach ($masters as $master) 
								{ 
							?>
							<tr>
										<td><?=1?></td>
										<td>
											<?=$master->name?>
										</td>
										<td><?=$master->email?></td>
										 <td><?='Master'?></td>
										<td>
											
										</td>
									</tr>
							<?php }
								$i = 2;
								foreach ($all_admins as $row) 
								{
								?>
									<tr>
										<td><?=$i?></td>
										<td>
											<?=$row->name;?>
										</td>
										<td><?=$row->email;?></td>
										 <td><?php echo $this->Crud_model->get_type_name_by_id('role', $row->role); ?></td>
										<td>
											<a href='<?=base_url()?>admin/admins/edit_admin/<?=$row->admin_id?>' id='demo-dt-view-btn' class='btn btn-primary btn-xs add-tooltip' data-toggle='tooltip' data-placement='top' title="<?=translate('edit')?>" ><i class='fa fa-edit'></i></a>
											
											<button data-target="#delete_modal" data-toggle="modal" class="btn btn-danger btn-xs add-tooltip" data-toggle="tooltip" data-placement="top" title="<?=translate('delete')?>" onclick="delete_admins(<?=$row->admin_id?>)"><i class="fa fa-trash"></i></button>
										</td>
									</tr>
								<?php
									$i++;
								}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<!--===================================================-->
		<!-- End Striped Table -->
	</div>
	<!--===================================================-->
	<!--End page content-->
</div>
<style>
	#validation_info p {
		margin: 0px;
		color: #DE1B1B;
	}
</style>
<!--Default Bootstrap Modal-->
<!--===================================================-->
<div class="modal fade" id="admins_modal" admins="dialog" tabindex="-1" aria-labelledby="admins_modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
                <h4 class="modal-title" id="modal_title"></h4>
            </div>
            <!--Modal body-->
            <div class="modal-body" id="modal_body">
            	
            </div>
        	<div class="col-sm-12 text-center" id="validation_info" style="margin-top: -30px">

        	</div>            
            <!--Modal footer-->
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default btn-sm" type="button" id="modal_close"><?php echo translate('close')?></button>
                <button class="btn btn-primary btn-sm" id="save_admins" value="0"><?php echo translate('save')?></button>
            </div>
        </div>
    </div>
</div>
<!--===================================================-->
<!--End Default Bootstrap Modal-->
<!--Default Bootstrap Modal For DELETE-->
<!--===================================================-->
<div class="modal fade" id="delete_modal" admins="dialog" tabindex="-1" aria-labelledby="delete_modal" aria-hidden="true">
    <div class="modal-dialog" style="width: 400px;">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
                <h4 class="modal-title"><?php echo translate('confirm_delete')?></h4>
            </div>
           	<!--Modal body-->
            <div class="modal-body">
            	<p><?php echo translate('are_you_sure_you_want_to_delete_this_data?')?></p>
            	<div class="text-right">
            		<button data-dismiss="modal" class="btn btn-default btn-sm" type="button" id="modal_close"><?php echo translate('close')?></button>
                	<button class="btn btn-danger btn-sm" id="delete_admins" value=""><?php echo translate('delete')?></button>
            	</div>
            </div>
           
        </div>
    </div>
</div>
<!--===================================================-->
<!--End Default Bootstrap Modal For DELETE-->
<script>
	setTimeout(function() {
	    $('#success_alert').fadeOut('fast');
	    $('#danger_alert').fadeOut('fast');
	}, 5000); // <-- time in milliseconds
</script>
<script>
	$("#add_admins").click(function(){
	    $("#modal_title").html("Add admins");
	    $("#modal_body").html("<div class='text-center'><i class='fa fa-refresh fa-5x fa-spin'></i></div>");
	    $("#save_admins").val(1);
	    $('#validation_info').html("");
	    $.ajax({
		    url: "<?=base_url()?>admin/admins/add_admins",
		    success: function(response) {
				$("#modal_body").html(response);
		    },
			fail: function (error) {
                                debugger
			    alert(error);
			}
		});
	});

	function edit_admins(id){
		$("#modal_title").html("Edit admins");
	    $("#modal_body").html("<div class='text-center'><i class='fa fa-refresh fa-5x fa-spin'></i></div>");
	    $("#save_admins").val(2);
	    $('#validation_info').html("");
	    $.ajax({
		    url: "<?=base_url()?>admin/admins/edit_admins/"+id,
		    success: function(response) {
				$("#modal_body").html(response);
		    },
			fail: function (error) {
                                debugger
			    alert(error);
			}
		});
	}

	$("#save_admins").click(function(){
		var check = $("#save_admins").val();
		var form = $("#admins_form");
		if (check == 1) {
			var page_url = "<?=base_url()?>admin/admins/do_add"
		} 
		if (check == 2) {
			var page_url = "<?=base_url()?>admin/admins/update"
		}
	    $.ajax({
		    type: "POST",
		    url: page_url,
		    cache: false,
		    data: form.serialize(),
		    success: function(response) {
		    	if (IsJsonString(response)) {
		    		// Displaying Validation Error for ajax submit
		    		var JSONArray = $.parseJSON(response);
		    		var html = "";
		    		$.each(JSONArray, function(row, fields) {
		    			html = fields['ajax_error'];
		    		});
		    		$('#validation_info').html(html);
		    	}
		    	else {
		    		window.location.href = "<?=base_url()?>admin/admins";
		    	}
		    },
			fail: function (error) {
                                debugger
			    alert(error);
			}
		});
	});

	function delete_admins(id){
	    $("#delete_admins").val(id);
	}

	$("#delete_admins").click(function(){
    	$.ajax({
		    url: "<?=base_url()?>admin/admins/delete/"+$("#delete_admins").val(),
		    success: function(response) {
				window.location.href = "<?=base_url()?>admin/admins";
		    },
			fail: function (error) {
                                debugger
			    alert(error);
			}
		});
    })

    function IsJsonString(str) {
	    try {
	        JSON.parse(str);
	    } catch (e) {
	        return false;
	    }
	    return true;
	}
</script>