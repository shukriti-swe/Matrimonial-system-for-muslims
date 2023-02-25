<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
	<div id="page-head">
		<!--Page Title-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<div id="page-title">
			<h1 class="page-header text-overflow"><?php echo translate('picture_video_approval')?></h1>

		</div>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<!--End page title-->
		<!--Breadcrumb-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<ol class="breadcrumb">
			<li><a href="#"><?php echo translate('home')?></a></li>
			<li class="active"><a href="#"><?php echo translate('picture_video_approval')?></a></li>
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
				<h3 class="panel-title"><?php echo translate('approval_list')?></h3>
			</div>
			<div class="panel-body">
				<div class="row">
					<table id="approval_table" class="table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
						<tr>
							<th>
								<?php echo translate('member_id')?>
							</th>
							<th>
								<?php echo translate('member_name')?>
							</th>
							<th>
								<?php echo translate('member_since')?>
							</th>
							<th>
								<?php echo translate('package')?>
							</th>
							<th>
								<?php echo translate('type')?>
							</th>
							<th>
								<?php echo translate('actions')?>
							</th>
							<th>
								<?php echo translate('request_submitted')?>
							</th>
						</tr>
						</thead>
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
<div class="modal fade" id="approve_modal" role="dialog" tabindex="-1" aria-labelledby="approve_modal" aria-hidden="true">
    <div class="modal-dialog" style="width: 400px;">
        <div class="modal-content">
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
                	<button class="btn btn-success btn-sm" id="approve_image" value=""><?php echo translate('approve')?></button>
            	</div>
            </div>
           
        </div>
    </div>
</div>

<div class="modal fade" id="reject_modal" role="dialog" tabindex="-1" aria-labelledby="reject_modal" aria-hidden="true">
    <div class="modal-dialog" style="width: 400px;">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
                <h4 class="modal-title"><?php echo translate('confirm_reject')?></h4>
            </div>
           	<!--Modal body-->
            <div class="modal-body">
            	<p><?php echo translate('are_you_sure_you_want_to_reject_this?')?></p>
            	<div class="text-right">
            		<input type="hidden" id="rejectMemberId">
            		<input type="hidden" id="rejectImageType">
            		<input type="hidden" id="rejectitemId">
            		<button data-dismiss="modal" class="btn btn-default btn-sm" type="button" id="modal_close"><?php echo translate('close')?></button>
                	<button class="btn btn-danger btn-sm" id="reject_image" value=""><?php echo translate('reject')?></button>
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
        $('#approval_table').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax":{
				"url": "<?php echo base_url('admin/picture_video_approval/list_data') ?>",
				"dataType": "json",
				"type": "POST",
				"data":{  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' }
			},
	    	"columns": [
				{ "data": "member_id" },
				{ "data": "member_name" },
				{ "data": "member_since" },
				{ "data": "package" },
				{ "data": "type" },
				{ "data": "actions" },
				{ "data": "request_submitted" },
			],
			"drawCallback": function( settings ) {
		        $('.add-tooltip').tooltip();
		    }
	    });
    });
</script>
<script>
	function approve(flag, memberId, type, itemId){
	    $("#approve_image").val(flag);
	    $("#approveMemberId").val(memberId);
	    $("#approveImageType").val(type);
	    $("#approveitemId").val(itemId);
	}

	$("#approve_image").click(function(){

		approve = $("#approve_image").val();
		approveMemberId = $("#approveMemberId").val();
		approveImageType = $("#approveImageType").val();
		approveitemId = $("#approveitemId").val();

		formData = {'approve': approve, 'approveMemberId': approveMemberId, 'approveImageType': approveImageType, 'approveitemId': approveitemId};

    	$.ajax({
		    url: "<?=base_url()?>admin/approve_gallery_image/",
		    data: formData,
		    type: "POST",
		    success: function(response) {
				location.reload();
		    },
			fail: function (error) {
                debugger
			    alert(error);
			}
		});
    })

	function reject(flag, memberId, type, itemId){
	    $("#reject_image").val(flag);
	    $("#rejectMemberId").val(memberId);
	    $("#rejectImageType").val(type);
	    $("#rejectitemId").val(itemId);
	}

	$("#reject_image").click(function(){
  		
  		reject = $("#reject_image").val();
		rejectMemberId = $("#rejectMemberId").val();
		rejectImageType = $("#rejectImageType").val();
		rejectitemId = $("#rejectitemId").val();

		formData = {"reject": reject, "rejectMemberId": rejectMemberId, "rejectImageType": rejectImageType, "rejectitemId": rejectitemId};

    	$.ajax({
		    url: "<?=base_url()?>admin/reject_gallery_image/",
		    data: formData,
		    type: "POST",
		    success: function(response) {
				location.reload();
		    },
			fail: function (error) {
                debugger
			    alert(error);
			}
		});
    })
</script>