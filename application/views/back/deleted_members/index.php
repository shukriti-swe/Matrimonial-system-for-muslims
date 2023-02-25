<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
	<div id="page-head">
		<!--Page Title-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<div id="page-title">
			<h1 class="page-header text-overflow"><?php echo translate('disabled_members')?></h1>
		</div>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<!--End page title-->
		<!--Breadcrumb-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<ol class="breadcrumb">
			<li><a href="#"><?php echo translate('home')?></a></li>
			<li><a href="#"><?php echo translate('members')?></a></li>
			<li class="active"><?php echo translate('disabled_members')?></li>
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
				<h3 class="panel-title"><?php echo translate('disabled_members_list')?></h3>
			</div>
			<div class="panel-body">
				<table id="members_table" class="table table-striped table-bordered" cellspacing="0" width="100%">
					<thead>
					<tr>
						<th data-sortable="false">
							<?php echo translate('user_image')?>
						</th>
						<th>
							<?php echo translate('Member ID')?>
						</th>
						<th>
							<?php echo translate('name')?>
						</th>
						<th>
							<?php echo translate('registered')?>
						</th>
						<th>
							<?php echo translate('email')?>
						</th>
						<th>
							<?php echo translate('password')?>
						</th>
						<th>
							<?php echo translate('package')?>
						</th>
						<th>
							Switch Member To
						</th>
						<th>
							<?php echo translate('member_status')?>
						</th>
						<!-- <th width= "15%" data-sortable="false">
							<?php echo translate('options')?>
						</th> -->
						<th>
							Email Sent
						</th>
					</tr>
					</thead>
				</table>
			</div>
		</div>
		<!--===================================================-->
		<!-- End Striped Table -->
	</div>
	<!--===================================================-->
	<!--End page content-->
</div>
<!--Default Bootstrap Modal-->
<!--===================================================-->
<div class="modal fade" id="restore_modal" role="dialog" tabindex="-1" aria-labelledby="restore_modal" aria-hidden="true">
    <div class="modal-dialog" style="width: 400px;">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
                <h4 class="modal-title"><?php echo translate('confirm_your_action')?></h4>
            </div>
           	<!--Modal body-->
            <div class="modal-body">
            	<p><?php echo translate('are_you_sure_you_want_to')?> "<b><?php echo translate('restore')?></b>" <?php echo translate('this_user?')?>?</p>
            	<div class="text-right">
            		<input type="hidden" id="member_id" name="member_id" value="">
            		<button data-dismiss="modal" class="btn btn-default btn-sm" type="button" id="modal_close"><?php echo translate('close')?></button>
                	<button class="btn btn-primary btn-sm" id="cfm_restore" value=""><?php echo translate('confirm')?></button>
            	</div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="switch_modal" role="dialog" tabindex="-1" aria-labelledby="switch_modal" aria-hidden="true">
    <div class="modal-dialog" style="width: 400px;">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
                <h4 class="modal-title"><?php echo translate('confirm_your_action')?></h4>
            </div>
           	<!--Modal body-->
            <div class="modal-body">
            	<p><?php echo translate('are_you_sure_you_want_to_switch_this_user')?></p>
            	<div class="text-right">
            		<input type="hidden" id="switchMember_id" name="member_id" value="">
            		<input type="hidden" id="switch_status" name="switch_status" value="">
            		<button data-dismiss="modal" class="btn btn-default btn-sm switchCancelbtn" type="button" id="modal_close"><?php echo translate('close')?></button>
                	<button class="btn btn-primary btn-sm" id="switchConfirmBtn"><?php echo translate('confirm')?></button>
            	</div>
            </div>
        </div>
    </div>
</div>


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
                	<button class="btn btn-danger btn-sm" id="delete_member" value=""><?php echo translate('delete')?></button>
            	</div>
            </div>
           
        </div>
    </div>
</div>


<div class="modal fade" id="mail_modal" role="dialog" tabindex="-1" aria-labelledby="mail_modal " aria-hidden="true">
    <div class="modal-dialog" style="width: 400px;">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
                <h4 class="modal-title">Confirm Sending Email</h4>
            </div>
           	<!--Modal body-->
            <div class="modal-body">
            	<p>Are you sure you want to send email?</p>
            	<div class="text-right">
            		<button data-dismiss="modal" class="btn btn-default btn-sm" type="button" id="modal_close"><?php echo translate('close')?></button>
                	<button class="btn btn-danger btn-sm" id="send_email" value="">Send Email</button>
            	</div>
            </div>
           
        </div>
    </div>
</div>
<!--===================================================-->
<!--End Default Bootstrap Modal-->
<script>
	setTimeout(function() {
	    $('#success_alert').fadeOut('fast');
	    $('#danger_alert').fadeOut('fast');
	}, 5000); // <-- time in milliseconds
</script>
<script>
    $(document).ready(function () {
    	var url = "<?php echo base_url('admin/disabled_members/list_data') ?>";
		$('#members_table').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax":{
				"url": url,
				"dataType": "json",
				"type": "POST",
				"data":{  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' }
			},
	    	"columns": [
				{ "data": "image" },
				{ "data": "member_id" },
				{ "data": "name" },
				{ "data": "registered" },
				{ "data": "email" },
				{ "data": "password" },
				{ "data": "package" },
				{ "data": "switch" },
				{ "data": "member_status" },
				// { "data": "options" },
				{ "data": "email_sent" },
			],
			"drawCallback": function( settings ) {
		        $('.add-tooltip').tooltip();
		    }
	    });
    });

    function switchMember(member_id)
    {
    	var newPackage = $('#switchPackageTo_'+member_id).val()

	    $("#switch_status").val(newPackage);
	    $("#switchMember_id").val(member_id);
	}

	$("#switchConfirmBtn").click(function(){

		membership = $("#switch_status").val();
		memberId = $("#switchMember_id").val();

    	$.ajax({
    		type: 'POST',
    		dataType:'text',
		    url: "<?=base_url()?>admin/switchDeletedMember/" + membership + "/" + memberId,
		    success: function(data){
		    	if (data == "true")
		    	{
		    		window.location.href = "<?=base_url()?>admin/deleted_members";
		    	}
		    },
			fail: function (error) {
			    alert(error);
			}
		});
    });

    function restore(member_id){
	    $("#member_id").val(member_id);
	}

	$("#cfm_restore").click(function(){
    	$.ajax({
		    url: "<?=base_url()?>admin/member_restore/"+$("#member_id").val(),
		    success: function(response) {
		    	// alert($("#member_id").val());
				window.location.href = "<?=base_url()?>admin/deleted_members";
		    },
			fail: function (error) {
                                debugger
			    alert(error);
			}
		});
    })
	
	   function delete_member(id){
	    $("#delete_member").val(id);
	}

	$("#delete_member").click(function(){
    	$.ajax({
		    url: "<?=base_url()?>admin/delete_deleted_member/"+$("#delete_member").val(),
		    success: function(response) {
				window.location.href = "<?=base_url()?>admin/deleted_members";
		    },
			fail: function (error) {
                                debugger
			    alert(error);
			}
		});
    })
	   function send_email(id){
	    $("#send_email").val(id);
	}

	$("#send_email").click(function(){
    	$.ajax({
		    url: "<?=base_url()?>admin/send_email/"+$("#send_email").val(),
		    success: function(response) {
				window.location.href = "<?=base_url()?>admin/deleted_members";
		    },
			fail: function (error) {
                                debugger
			    alert(error);
			}
		});
    })
</script>