<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
	<div id="page-head">
		<!--Page Title-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<div id="page-title">
			<h1 class="page-header text-overflow"><?php echo translate('Advertisements')?></h1>

		</div>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<!--End page title-->
		<!--Breadcrumb-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<ol class="breadcrumb">
			<li><a href="#"><?php echo translate('home')?></a></li>
			<li><a href="#"><?php echo translate('Configuration')?></a></li>
			<li class="active"><a href="#">Advertisements</a></li>
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
				<h3 class="panel-title">Advertisements</h3>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-12 pull-right" style="padding-bottom: 10px">
						<!-- <a href="<?=base_url()?>admin/on_behalf/add_on_behalf" class="btn btn-primary btn-sm btn-labeled fa fa-plus">Create New</a> -->
						<button data-target="#advertisements_modal" data-toggle="modal" id="add_advertisements" class="btn btn-primary btn-sm btn-labeled fa fa-plus"><?php echo translate('create_new')?></button>
					</div>
				</div>
				<div class="row">
					<table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
						<tr>
							<th>No.</th>
							<th>
								<?php echo translate('Bus. Name.')?>
							</th>
							<th>
								<?php echo translate('address.')?>
							</th>
							<th>
								<?php echo translate('Email_/_Phone')?>
							</th>
							<th>
								<?php echo translate('Package')?>
							</th>
							<!--<th>
								<?php echo translate('phone')?>
							</th>-->
							<th>
								<?php echo translate('payment_Type')?>
							</th>
							<th>
								<?php echo translate('date_start.')?>
							</th>
							<th>
								<?php echo translate('date_end.')?>
							</th>
							<th>
								<?php echo translate('status.')?>
							</th>
							<th width="10%">
								<?php echo translate('action')?>
							</th>
							<th>
								<?php echo translate('send_mail')?>
							</th>
						</tr>
						</thead>
						<tbody>
							<?php
								$i = 1;
								foreach ($all_advertisements as $value) 
								{							
								?>
									<tr>
										<td><?=$i?></td>
										<td>
											<?=$value['title'];?>
										</td>
										<td>
											<?=$value['address'];?>
										</td>
										<td>
											<?=$value['ads_email'];?><br>
											<?=$value['ads_phone'];?>
										</td>
										<!--<td>
											<?=$value['ads_phone'];?>
										</td>-->
										<td>
											<?=$value['duration'];?> Month
											<!--<p style="color:red;font-weight: bold;"><?=$value->payment_status;?></p> -->
										</td>
										<td>
											<p style="color:red;font-weight: bold;"><?=$value['payment_by'];?></p>
										</td>
										<td>
											<?=$value['start_date'];?>
										</td>	
										<td>
										<?=$value['end_date'];?>	
										</td>
										<td>
											<?php
											$today = date('Y-m-d');
											$result = $this->db->where('advertisements_id',$value['advertisements_id'])->where('end_date <',$today)->get("advertisements")->result();
									
                                            if (count($result) > 0) {
												$this->db->where('advertisements_id',$value['advertisements_id'])->where('end_date <',$today)->update("advertisements",['status'=>5,'payment_status'=>3]);
											}
											 if ($value['status'] == 3){ ?>
												<button data-target="#approve_modal" data-toggle="modal" class="btn btn-primary btn-xs add-tooltip" data-toggle="tooltip" data-placement="top" title="<?=translate('approve')?>" onclick="approved_advertisements(<?=$value['advertisements_id']?>)"><i class="fa fa-check"></i></button>

												<button data-target="#reject_modal" data-toggle="modal" class="btn btn-primary btn-xs add-tooltip" data-toggle="tooltip" data-placement="top" title="<?=translate('Reject')?>" onclick="reject_advertisements(<?=$value['advertisements_id']?>)"><i class="fa fa-ban"></i></button>

											<?php }else if($value['status'] == 4){ ?>

												<button class="btn btn-danger btn-sm" type="button">Rejected</button>
											<?php }else if(count($result) > 0){ ?>

												<button class="btn btn-danger btn-sm" type="button">Expired</button>
											<?php }else if($value['status'] == 0){ ?>
										
												<button class="btn btn-success btn-sm" type="button">Approved</button>
											
											<?php } else if($value['status'] == 8){ ?>
											<button class="btn btn-warning btn-sm" type="button">Renew</button>
											<?php } ?>
										</td>
										<td>
											<button data-target="#advertisements_modal" data-toggle="modal" class="btn btn-primary btn-xs add-tooltip" data-toggle="tooltip" data-placement="top" title="<?=translate('edit')?>" onclick="edit_advertisements(<?=$value['advertisements_id']?>)"><i class="fa fa-edit"></i></button>
											<button data-target="#delete_modal" data-toggle="modal" class="btn btn-danger btn-xs add-tooltip" data-toggle="tooltip" data-placement="top" title="<?=translate('delete')?>" onclick="delete_advertisements(<?=$value['advertisements_id']?>)"><i class="fa fa-trash"></i></button>
										
										</td>
										<td>
											<?php if($value['email_status'] == '0'){?>
									         <i class="fa fa-check bg-success"></i><span> Advertisement submit</span><br>
											<?php } else if($value['email_status'] == '1'){ ?>
											<i class="fa fa-check bg-success"></i><span> Approve</span><br>
											<?php } else if($value['email_status'] == '2'){?>
											<i class="fa fa-check bg-success"></i><span> Reject</span><br>
											<?php } else if($value['email_status'] == '3'){?>
											<i class="fa fa-check bg-success"></i><span> Expire</span><br>
											<?php } else if($value['email_status'] == '4'){?>
											 <i class="fa fa-check bg-success"></i><span> Renew</span><br>
											<?php } ?>
											<button data-target="#send_email_modal" data-toggle="modal" class="btn btn-success btn-xs add-tooltip send_email_advertisements" data-toggle="tooltip" data-placement="top" ads-id="<?=$value['advertisements_id'] ?>" ads-email="<?=$value['ads_email']?>" title="<?=translate('Send Email')?>"><i class="fa fa-envelope"></i></button>
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
		color: red;
	}
</style>
<!--Default Bootstrap Modal-->
<!--===================================================-->
<div class="modal fade" id="advertisements_modal" role="dialog" tabindex="-1" aria-labelledby="advertisements_modal" aria-hidden="true">
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
        	<div class="col-sm-12 text-center text-danger" id="validation_info" style="margin-top: -30px">

        	</div>            
            <!--Modal footer-->
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default btn-sm" type="button" id="modal_close"><?php echo translate('close')?></button>
                <button class="btn btn-primary btn-sm" id="save_advertisements" value="0"><?php echo translate('save')?></button>
            </div>
        </div>
    </div>
</div>
<!--===================================================-->
<!--End Default Bootstrap Modal-->
<!--Default Bootstrap Modal For DELETE-->
<!--===================================================-->
<div class="modal fade" id="delete_modal" role="dialog" tabindex="-1" aria-labelledby="delete_modal" aria-hidden="true">
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
                	<button class="btn btn-danger btn-sm" id="delete_advertisements" value=""><?php echo translate('delete')?></button>
            	</div>
            </div>
           
        </div>
    </div>
</div>
<!--===================================================-->
<!--End Default Bootstrap Modal For DELETE-->
<!--Default Bootstrap Modal-->
<!--===================================================-->
<div class="modal fade" id="approve_modal" role="dialog" tabindex="-1" aria-labelledby="approve_modal" aria-hidden="true">
    <div class="modal-dialog" style="width: 400px;">
        <div class="modal-content">
        	<input type="hidden" name="advertisements_id" id="approve_advertisement_id" value="">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
                <h4 class="modal-title"><?php echo translate('confirm_approve')?></h4>
            </div>
           	<!--Modal body-->
            <div class="modal-body">
            	<p><?php echo translate('are_you_sure_you_want_to_approve_this?')?></p>
            	<div class="text-right">
            		<input type="hidden" id="approveMemberId">
            		<input type="hidden" id="approveImageType">
            		<input type="hidden" id="approveitemId">
            		<button data-dismiss="modal" class="btn btn-default btn-sm" type="button" id="modal_close"><?php echo translate('close')?></button>
                	<button class="btn btn-success btn-sm" id="approve_ads" value=""><?php echo translate('approve')?></button>
            	</div>
            </div>
           
        </div>
    </div>
</div><!--Default Bootstrap Modal-->
<!--===================================================-->
<div class="modal fade" id="reject_modal" role="dialog" tabindex="-1" aria-labelledby="approve_modal" aria-hidden="true">
    <div class="modal-dialog" style="width: 400px;">
        <div class="modal-content">
        	<input type="hidden" name="advertisements_id" id="reject_advertisement_id" value="">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
                <h4 class="modal-title"><?php echo translate('confirm_reject')?></h4>
            </div>
           	<!--Modal body-->
            <div class="modal-body">
            	<p><?php echo translate('are_you_sure_you_want_to_reject_this?')?></p>
            	<div class="text-right">
            		<button data-dismiss="modal" class="btn btn-default btn-sm" type="button" id="modal_close"><?php echo translate('close')?></button>
                	<button class="btn btn-success btn-sm" id="reject_ads" value=""><?php echo translate('Reject')?></button>
            	</div>
            </div>
           
        </div>
    </div>
</div>
<!--Default Bootstrap Modal-->
<!--===================================================-->
<div class="modal fade" id="send_email_modal" role="dialog" tabindex="-1" aria-labelledby="approve_modal" aria-hidden="true">
    <div class="modal-dialog" style="width: 400px;">
        <div class="modal-content">
        	<input type="hidden" name="advertisements_id" id="send_mail_ads_id" value="">
        	<input type="hidden" name="ads_email" id="send_mail_email_id" value="">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
                <h4 class="modal-title"><?php echo translate('Send Email')?></h4>
            </div>
           	<!--Modal body-->
            <div class="modal-body">
            	<p><?php echo translate('are_you_sure_you_want_to_send_email_notification_to_this_business?')?></p>
            	<div class="text-right">
            		<button data-dismiss="modal" class="btn btn-default btn-sm" type="button" id="modal_close"><?php echo translate('close')?></button>
                	<button class="btn btn-success btn-sm" id="send_mail_notification_ads" value=""><?php echo translate('Send')?></button>
            	</div>
            </div>
           
        </div>
    </div>
</div>
<script>
	setTimeout(function() {
	    $('#success_alert').fadeOut('fast');
	    $('#danger_alert').fadeOut('fast');
	}, 5000); // <-- time in milliseconds
</script>
<script>
	$("#add_advertisements").click(function(){
	    $("#modal_title").html("Add advertisements");
	    $("#modal_body").html("<div class='text-center'><i class='fa fa-refresh fa-5x fa-spin'></i></div>");
	    $("#save_advertisements").val(1);
	    $('#validation_info').html("");
	    $.ajax({
		    url: "<?=base_url()?>admin/advertisements/add_advertisements",
		    success: function(response) {
		    	console.log(response);
				$("#modal_body").html(response);
		    },
			fail: function (error) {
			    alert(error);
			}
		});
	});
	

	function edit_advertisements(id){
		$("#modal_title").html("Edit advertisements");
	    $("#modal_body").html("<div class='text-center'><i class='fa fa-refresh fa-5x fa-spin'></i></div>");
	    $("#save_advertisements").val(2);
	    $('#validation_info').html("");
	    $.ajax({
		    url: "<?=base_url()?>admin/advertisements/edit_advertisements/"+id,
		    success: function(response) {
				$("#modal_body").html(response);
		    },
			fail: function (error) {
			    alert(error);
			}
		});
	}

	$("#save_advertisements").click(function(e){
		var check = $("#save_advertisements").val();
		var form = $("#advertisements_form");
		if (check == 1) {
			var page_url = "<?=base_url()?>admin/advertisements/do_add"
		} 
		if (check == 2) {
			var page_url = "<?=base_url()?>admin/advertisements/update"
		}
		e.preventDefault();
		var fd = new FormData();
        var files = $('#company_logo')[0].files;
		fd.append('file',files[0]);
		fd.append('company_logo',true);
		var form = $("#advertisements_form").serialize();
		var advertisements_id = $("#advertisements_id").val();
		var title = $("#title").val();
		var address = $("#address").val();
		var ads_phone = $("#ads_phone").val();
		var city_state = $("#city_state").val();
		var end_date = $("#end_date").val();
		var ads_email = $("#ads_email").val();
		var color = $("#color").val();
		var company_url = $("#company_url").val();
		var advertisement_plans_id = $("#advertisement_plans_id").val();
		
		fd.append('data',form);
		fd.append('ads_email',ads_email);
		fd.append('end_date',end_date);
		fd.append('city_state',city_state);
		fd.append('ads_phone',ads_phone);
		fd.append('address',address);
		fd.append('title',title);
		fd.append('company_url',company_url);
		fd.append('color',color);
		fd.append('advertisements_id',advertisements_id);
		fd.append('advertisement_plans_id',advertisement_plans_id);
	    $.ajax({
		    type: "POST",
		    url: page_url,
		    //cache: false,
		    //data: form.serialize(),
			data:fd,
			contentType: false,
			processData: false,
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
		    		window.location.href = "<?=base_url()?>admin/advertisements";
		    	}
		    },
			fail: function (error) {
			    alert(error);
			}
		});
	});

	function delete_advertisements(id){
	    $("#delete_advertisements").val(id);
	}

	$("#delete_advertisements").click(function(){
    	$.ajax({
		    url: "<?=base_url()?>admin/advertisements/delete/"+$("#delete_advertisements").val(),
		    success: function(response) {
				window.location.href = "<?=base_url()?>admin/advertisements";
		    },
			fail: function (error) {
			    alert(error);
			}
		});
    })

    function approved_advertisements(id){
    	$("#approve_advertisement_id").val(id);
    }
    $("#approve_ads").click(function(){
    	$.ajax({
		    url: "<?=base_url()?>admin/advertisements_approve/"+$("#approve_advertisement_id").val(),
		    success: function(response) {
				window.location.href = "<?=base_url()?>admin/advertisements";
		    },
			fail: function (error) {
			    alert(error);
			}
		});
    })

    function reject_advertisements(id){
    	$("#reject_advertisement_id").val(id);
    }


    $("#reject_ads").click(function(){
    	$.ajax({
		    url: "<?=base_url()?>admin/advertisements_reject/"+$("#reject_advertisement_id").val(),
		    success: function(response) {
		    	console.log(response);
				window.location.href = "<?=base_url()?>admin/advertisements";
		    },
			fail: function (error) {
			    alert(error);
			}
		});
    })

    $('.send_email_advertisements').click(function(){
    	var ads_id = $(this).attr('ads-id');
    	var ads_email = $(this).attr('ads-email');

    	$("#send_mail_ads_id").val(ads_id);
    	$("#send_mail_email_id").val(ads_email);
    })

    $('#send_mail_notification_ads').click(function(){
    	var ads_id = $("#send_mail_ads_id").val();
    	var ads_email =$("#send_mail_email_id").val();
    	$.ajax({
		    url: "<?=base_url()?>admin/approve_ads_send_url_notification/",
		    type: "POST",
		    data: {
		    	ads_id:ads_id,
		    	ads_email:ads_email,
		    },
		    success: function(response) {
		    	console.log(response);
			    location.reload();
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