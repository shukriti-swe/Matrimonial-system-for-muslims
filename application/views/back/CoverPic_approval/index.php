<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
	<div id="page-head">
		<!--Page Title-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<div id="page-title">
			<h1 class="page-header text-overflow"><?php echo translate('add_new_cover_pic')?></h1>

		</div>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<!--End page title-->
		<!--Breadcrumb-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<ol class="breadcrumb">
			<li><a href="#"><?php echo translate('home')?></a></li>
			<li class="active"><a href="#"><?php echo translate('add_new_cover_pic')?></a></li>
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
				<h3 class="panel-title"><?php echo translate('add_new_cover_pic')?></h3>
			</div>
			<div class="panel-body">
				<div class="row">
					<table id="approval_table" class="table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
						<tr>
							<th>
								<?php echo translate('member_id')?>
							</th>
							<!--<th>
								<?php echo translate('member_email')?>
							</th> -->
							 <th>
								<?php echo translate('member_name')?>
							</th>
							<th>
								<?php echo translate('package')?>
							</th>

							<!--<th>-->
							<!--	<?php echo translate('client_date')?>-->
							<!--</th>-->

							<th>
								<?php echo translate('photo_showing')?>
							</th>

							<th>
								<?php echo translate('paid')?>
							</th>
							
							<th>
								<?php echo translate('status')?>
							</th>
							<th>
								<?php echo translate('actions')?>
							</th>

						</tr>
						</thead>
						<tbody>

							<?php if (count($all_data)) { ?>

								<?php foreach ($all_data as $key => $value) {
									$img_check = $this->db->where('member_id',$value->member_id)->limit(1)->get('cover_pics')->row();
									$member_name= $this->db->where('member_id',$value->member_id)->get('member')->row();
								 ?>
									<tr>
										<td> <?= $member_name->display_member ?>  </td>
										<td> <?= $member_name->first_name. ' '. $member_name->last_name  ?>  </td>
										<td> <?= $value->name ?>  </td>
										<?php if ($value->image_reject == 1){ ?>
										<td>  Rejected  </td>
										<?php }else{ ?>
										<td>  Waiting For Approval  </td>
										<?php } ?>
										<td> <?=  date("F d , Y" , strtotime($value->payment_date) ); ?>     </td>
										<td>
											<?php if ($value->image_reject == 1){ ?>
												<button class="btn btn-warning btn-sm">Rejected</button>
											<?php }else{ ?>
												<?php if (isset($img_check)){ ?>
													<!--Pendding coverpic priview-->
													<?php  
													$img = json_decode($value->image,true )[0]['image'];
													if (isset($img)) { ?>
															<a href='<?= base_url("/uploads/home_slide/".$img ) ?>' target='_blank' class='btn btn-success btn-xs add-tooltip' data-toggle='tooltip' data-placement='top' title= 'priview'><i class='fa fa-eye'></i></a>
											
														<button data-target='#reject_cover_modal' data-toggle='modal' class='btn btn-danger btn-xs add-tooltip  delete_modal_click' data-toggle='tooltip' data-placement='top' title= 'Reject' onclick='confirm_reject("<?= $img_check->cover_pics_id ?>")'><i class='fa fa-close'></i></button>
														<button data-target='#approved_modal' data-toggle='modal' class='btn btn-success btn-xs add-tooltip  success_modal_click' data-toggle='tooltip' data-placement='top' title= 'Approved' onclick='confirm_approval("<?= $value->cover_pic_payment_id ?>")'><i class='fa fa-check'></i></button>
													<?php }else{ ?>
														<p class="text-danger">Watting For Photo</p>
													<?php } ?>
												<?php }else{ ?>
													<p class="text-danger">Watting For Photo</p>
												<?php } ?>
											<?php } ?>
									    </td>
										
									</tr>
								<?php } ?>
							<?php } ?>


							<?php foreach ($all_data_approved as $key => $value) {
								$member_name= $this->db->where('member_id',$value->member_id)->get('member')->row();
							 ?>
								<tr>
									<td> <?=$member_name->display_member?> </td>
									<td>  <?= $member_name->first_name. ' '. $member_name->last_name  ?>  </td>
									<td> <?=$value->name?> </td>

									<td>
										<?php if ($value->cover_pic_start_date ) {
											echo date("F d" , strtotime($value->cover_pic_start_date) ); echo " - ";
											echo date("F d, Y" , strtotime($value->cover_pic_end_date) );
										} ?>
									</td>
									
									<td> <?= date("F d, Y" , strtotime($value->cover_pic_payment_payment_date) ) ?> </td>
									<td>

									<?php  if ($value->cover_pic_status == 0) { ?>
										<a href="<?=base_url()?>admin/CoverPic_approval/add_picture/<?=$value->cover_pic_payment_id?>" id="demo-dt-view-btn" class="btn btn-mint add-tooltip" style="width: 100%" ><i class="fa fa-plus"></i> <?php echo translate('add_new_cover_pic')?></a> 
									<?php } ?>

									

									<?php  if ($value->cover_pic_status == 1) { ?>

										<?php if ( strtotime($value->cover_pic_end_date) >= strtotime( date("Y-m-d") ) ) { ?>
											<button class="btn btn-success btn-sm">Showing</button>
										<?php } ?>	

										<?php if ( strtotime($value->cover_pic_end_date) < strtotime( date("Y-m-d") ) ) { ?>
											<button class="btn btn-danger btn-sm">Expired</button>
										<?php } ?>	
											
									<?php } ?>
									
								    </td>
								    <td>
								    	<button data-target='#delete_modal' data-toggle='modal' class='btn btn-danger btn-xs add-tooltip  delete_modal_click' data-toggle='tooltip' data-placement='top' title= 'delete' value="<?=$value->cover_pics_id ?>"><i class='fa fa-close'></i></button>

								    	<?php 
								    	$img = json_decode($value->image,true )[0]['image'];
								    	{ ?>
								    		<a href='<?= base_url("/uploads/home_slide/".$img ) ?>' target='_blank' class='btn btn-success btn-xs add-tooltip' data-toggle='tooltip' data-placement='top' title= 'preview'><i class='fa fa-eye'></i></a>
								    	<?php } ?>

                                    	
								    </td>
								</tr>
							<?php } ?>

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
<!--===================================================-->
<div class="modal fade" id="delete_modal" role="dialog" tabindex="-1" aria-labelledby="delete_modal" aria-hidden="true">
    <div class="modal-dialog" style="width: 400px;">
        <div class="modal-content">
        	<input type="hidden" id="coverPicID" value="">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
                <h4 class="modal-title"><?php echo translate('confirm_delete')?></h4>
            </div>
            <!--Modal body-->
            <div class="modal-body">
                <p><?php echo translate('are_you_sure_you_want_to_delete_this_package?')?></p>
                <div class="text-right">
                    <button data-dismiss="modal" class="btn btn-default btn-sm" type="button" id="modal_close"><?php echo translate('close')?></button>
                    <button class="btn btn-danger btn-sm" id="delete_package" value=""><?php echo translate('delete')?></button>
                </div>
            </div>
           
        </div>
    </div>
</div>
<!--===================================================-->
<div class="modal fade" id="approved_modal" role="dialog" tabindex="-1" aria-labelledby="delete_modal" aria-hidden="true">
    <div class="modal-dialog" style="width: 400px;">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
                <h4 class="modal-title"><?php echo translate('confirm_delete')?></h4>
            </div>
            <!--Modal body-->
				<input type="hidden" name="paymentID" id="paymentID" value="">
				<div class="modal-body">
					<p><?php echo translate('are_you_sure_you_want_to_approve_this_cover_photo?')?></p>
					<div class="text-right">
						<button data-dismiss="modal" class="btn btn-default btn-sm" type="button" id="modal_close"><?php echo translate('close')?></button>
						<button class="btn btn-danger btn-sm" id="approved_cover_photo"><?php echo translate('ok')?></button>
					</div>
				</div>
           
        </div>
    </div>
</div>
<!--=======================Reject Cover Photo============================-->
<div class="modal fade" id="reject_cover_modal" role="dialog" tabindex="-1" aria-labelledby="delete_modal" aria-hidden="true">
    <div class="modal-dialog" style="width: 400px;">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
                <h4 class="modal-title"><?php echo translate('confirm_delete')?></h4>
            </div>
            <!--Modal body-->
				<input type="hidden" name="rj_cover_pic_id" id="rj_cover_pic_id" value="">
				<div class="modal-body">
					<p><?php echo translate('are_you_sure_you_want_to_reject_this_cover_photo?')?></p>
					<div class="text-right">
						<button data-dismiss="modal" class="btn btn-default btn-sm" type="button" id="modal_close"><?php echo translate('close')?></button>
						<button class="btn btn-danger btn-sm" id="reject_cover_photo"><?php echo translate('Reject')?></button>
					</div>
				</div>
           
        </div>
    </div>
</div>
<style>
	#validation_info p {
		margin: 0px;
		color: #DE1B1B;
	}
</style>

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
            
	    });
	    
	    
	    $('.delete_modal_click').click(function(){
	    	var id = $(this).val();
	    	$('#coverPicID').val(id);

	    })
		
		
		

	    $("#delete_package").click(function(){
	    	$.ajax({
	    		
			    url: "<?=base_url()?>admin/deleteCoverPic/"+$("#coverPicID").val(),
			    success: function(response) {
					window.location.href = "<?=base_url()?>admin/CoverPic_approval";
			    },
				fail: function (error) {
				    alert(error);
				}
			});
	    })
		
		
    });
	function confirm_approval(a){
	    $('#paymentID').val(a);
	}
	
	function confirm_reject(v){
		$('#rj_cover_pic_id').val(v);
	}
	
	$("#approved_cover_photo").click(function(e){
		e.preventDefault();
		var id = $('#paymentID').val();
		$.ajax({
			url: "<?=base_url()?>admin/CoverPic_approval/do_add/"+id,
			success: function(response) {
				window.location.href = "<?=base_url()?>admin/CoverPic_approval";
				console.log(response);
			},
			error: function (error) {
				alert(error);
			}
		});
	})
	
	$("#reject_cover_photo").click(function(e){
		e.preventDefault();
		var id = $('#rj_cover_pic_id').val();
		$.ajax({
			url: "<?=base_url()?>admin/CoverPic_approval_reject/"+id,
			success: function(response) {
				window.location.href = "<?=base_url()?>admin/CoverPic_approval";
				console.log(response);
			},
			error: function (error) {
				alert(error);
			}
		});
	})
	
	
</script>
