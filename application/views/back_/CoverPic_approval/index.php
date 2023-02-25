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
							<th>
								<?php echo translate('member_name')?>
							</th>

							<th>
								<?php echo translate('package')?>
							</th>

							<th>
								<?php echo translate('client_date')?>
							</th>

							<th>
								<?php echo translate('photo_showing')?>
							</th>

							<th>
								<?php echo translate('paid')?>
							</th>

							<th>
								<?php echo translate('payment_type')?>
							</th>
							
							<th>
								<?php echo translate('actions')?>
							</th>

						</tr>
						</thead>
						<tbody>

							<?php if (count($all_data)) { ?>
								<?php foreach ($all_data as $key => $value) { ?>
									<tr>
										<td> <?= $value->member_profile_id ?>  </td>
										<td> <?= $value->email ?>  </td>
										<td> <?= $value->name ?>  </td>

										<td> <?=  date("F d , Y" , strtotime($value->client_date) ); ?>  </td>

										<td>  </td>
										<td> <?=  date("F d , Y" , strtotime($value->payment_date) ); ?>     </td>
										<td> <?= $value->payment_by ?>  </td>
										<td> 
											<a href="<?=base_url()?>admin/CoverPic_approval/add_picture/<?=$value->cover_pic_payment_id?>" id="demo-dt-view-btn" class="btn btn-mint add-tooltip" style="width: 100%" ><i class="fa fa-plus"></i> <?php echo translate('approve_cover_pic')?></a> 
									    </td>
										
									</tr>
								<?php } ?>
							<?php } ?>


							<?php foreach ($all_data_approved as $key => $value) { ?>
								<tr>
									<td> <?=$value->member_profile_id?> </td>
									<td> <?=$value->email?> </td>
									<td> <?=$value->name?> </td>
									<td> <?=  date("F d , Y" , strtotime($value->client_date) ); ?>  </td>

									<td>
										<?php if ($value->cover_pic_start_date ) {
											echo date("F d" , strtotime($value->cover_pic_start_date) ); echo " - ";
											echo date("F d, Y" , strtotime($value->cover_pic_end_date) );
										} ?>
									</td>
									
									<td> <?= date("F d, Y" , strtotime($value->cover_pic_payment_payment_date) ) ?> </td>
									<td> <?=$value->payment_by ?> </td>
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
    });
</script>
