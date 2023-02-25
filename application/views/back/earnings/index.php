<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
	<div id="page-head">
		<!--Page Title-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<div id="page-title">
			<h1 class="page-header text-overflow"><?php echo translate('membership_earnings')?></h1>

		</div>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<!--End page title-->
		<!--Breadcrumb-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<ol class="breadcrumb">
			<li><a href="#"><?php echo translate('home')?></a></li>
			<li class="active"><a href="#"><?php echo translate('membership_earnings')?></a></li>
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
				<h3 class="panel-title"><?php echo translate('membership_earnings_list')?></h3>
			</div>
			<div class="panel-body">
				<div class="row">
					<table id="earnings_table" class="table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
						<tr>
							<th>
								<?php echo translate('member_id')?>
							</th>
							<th>
								<?php echo translate('member_name')?>
							</th>
							<th>
								<?php echo translate('status')?>
							</th>
							<th>
								<?php echo translate('register_date')?>
							</th>
							<th>
								<?php echo translate('invoice_no')?>
							</th>
							<!--<th>-->
							<!--	<?php echo translate('package')?>-->
							<!--</th>-->

							<!-- <th>
								<?php //echo translate('status')?>
							</th> -->
							<th>
								<?php echo translate('amount')?>
							</th>
							<th>
								<?php echo translate('billing_period')?>
							</th>
							<!-- <th>
								<?php //echo translate('due_date')?>
							</th> -->
							<th>
								<?php echo translate('billing_date')?>
							</th>
							<th>
								<?php echo translate('switch')?>
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
<div class="modal fade" id="earnings_modal" role="dialog" tabindex="-1" aria-labelledby="earnings_modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
                <h4 class="modal-title" id="modal_title"></h4>
            </div>
            <!--Modal body-->
            <div class="modal-body" id="modal_body" style="word-wrap: break-word">
            	
            </div>
        	<div class="col-sm-12 text-center" id="validation_info" style="margin-top: -30px">

        	</div>            
            <!--Modal footer-->
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-danger btn-sm" type="button" id="modal_close"><?php echo translate('close')?></button>
                <!-- <button class="btn btn-primary btn-sm" id="save_earnings" value="0"><?php echo translate('save')?></button> -->
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
                	<button class="btn btn-danger btn-sm" id="delete_earning" value=""><?php echo translate('delete')?></button>
            	</div>
            </div>
           
        </div>
    </div>
</div>
<!--===================================================-->
<!-- member swich modal -->
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
<!--End Default Bootstrap Modal-->
<script>
    function paymentProcessFunc(dateStr, index){
        const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sept", "Oct", "Nov", "Dec"];
        let dateObj = new Date(dateStr);
        let month = monthNames[dateObj.getMonth()];
        let day = String(dateObj.getDate()).padStart(2, '0');
        let year = dateObj.getFullYear();
        let timezoneDate = month  + '-'+ day  + '-' + year;
        timezoneTime = new Date(dateStr).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
        $('.paymentProcessDate'+index).html(timezoneDate);
    }
    function dueDateFunc(dateStr, index){
        const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sept", "Oct", "Nov", "Dec"];
        let dateObj = new Date(dateStr);
        let month = monthNames[dateObj.getMonth()];
        let day = String(dateObj.getDate()).padStart(2, '0');
        let year = dateObj.getFullYear();
        let timezoneDate = month  + '-'+ day  + '-' + year;
        timezoneTime = new Date(dateStr).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
        $('.dueDate'+index).html(timezoneDate +" "+ timezoneTime);
    }
    function nextBillingFunc(dateStr, index){
        const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sept", "Oct", "Nov", "Dec"];
        let dateObj = new Date(dateStr);
        let month = monthNames[dateObj.getMonth()];
        let day = String(dateObj.getDate()).padStart(2, '0');
        let year = dateObj.getFullYear();
        let timezoneDate = month  + '-'+ day  + '-' + year;
        timezoneTime = new Date(dateStr).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
        $('.nextBillingDate'+index).html(timezoneDate);
    }
</script>
<script>
	setTimeout(function() {
	    $('#success_alert').fadeOut('fast');
	    $('#danger_alert').fadeOut('fast');
	}, 5000); // <-- time in milliseconds
</script>
<script>
    $(document).ready(function () {
        $('#earnings_table').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax":{
				"url": "<?php echo base_url('admin/earnings/list_data') ?>",
				"dataType": "json",
				"type": "POST",
				"data":{  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' }
			},
	    	"columns": [
				{ "data": "member_id" },
				{ "data": "member_name" },
				{ "data": "down_graded" },
				{ "data": "payment_process_date" },
				{ "data": "invoice_no" },
				//{ "data": "package" },
				{ "data": "amount" },
				{ "data": "billing_cycle" },
				//{ "data": "status" },
				//{ "data": "due_date" },
				{ "data": "next_billing_date" },
				{ "data": "switch" },
			],
			"drawCallback": function( settings ) {
		        $('.add-tooltip').tooltip();
		    }
	    });
    });

     // swich member js code
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
		    url: "<?=base_url()?>admin/member_switch/" + membership + "/" + memberId,
		    success: function(data){
		    	location.reload();
		    },
			fail: function (error) {
			    alert(error);
			}
		});
    });
</script>
<script>
	function get_detail(id) {
	    $("#modal_title").html("<?=translate('payment_details')?>");
	    $("#modal_body").html("<div class='text-center'><i class='fa fa-refresh fa-5x fa-spin'></i></div>");
	    $("#save_earnings").val(1);
	    $('#validation_info').html("");
	    $.ajax({
		    url: "<?=base_url()?>admin/earnings/view_detail/"+id,
		    success: function(response) {
				$("#modal_body").html(response);
		    },
			fail: function (error) {
                                debugger
			    alert(error);
			}
		});
	}

	function delete_earning(id){
	    $("#delete_earning").val(id);
	}

	$("#delete_earning").click(function(){
    	$.ajax({
		    url: "<?=base_url()?>admin/earnings/delete/"+$("#delete_earning").val(),
		    success: function(response) {
				window.location.href = "<?=base_url()?>admin/earnings";
		    },
			fail: function (error) {
                                debugger
			    alert(error);
			}
		});
    })
</script>