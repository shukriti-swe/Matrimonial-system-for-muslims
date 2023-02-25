<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
	<div id="page-head">
		<!--Page Title-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<div id="page-title">
			<h1 class="page-header text-overflow"><?= translate('social_media_setting')?></h1>

		</div>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<!--End page title-->
		<!--Breadcrumb-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<ol class="breadcrumb">
			<li><a href="#"><?= translate('home')?></a></li>
			<li><a href="#"><?= translate('social_media_setting')?></a></li>
		</ol>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<!--End breadcrumb-->
	</div>
	<!--Page content-->
	<!--===================================================-->
	<div id="page-content">
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
				<h3 class="panel-title"><?= translate('social_media_setting_configuration')?></h3>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
						<?php foreach ($data as  $value) {	?>
						<div class="row form-group">
							<form action="<?=base_url('admin/update_social_media_setting/'.$value->id)?>" method="post">
								<div class="col-md-2">
									<label class="col-sm-3 control-label" for="seo_keywords"><b><?= $value->title; ?> </b></label>
								</div>
								<div class="col-md-6">
									<textarea class="form-control" rows="3" name="content"><?= $value->content; ?></textarea>
								</div>
								<div class="col-md-4">
									<button class="btn btn-success " >Update</button>

									<input class="changeUserStatus" type="checkbox" data-toggle="toggle" data-on="Enabled" data-off="Disabled" name="status" 
									id="<?= $value->id; ?>" 
									<?php if ($value->status == 'enable') { ?> checked
									<?php }else{ ?>
									<?php } ?>
									>
								</div>
								
							</form>
						</div><br>
						 <?php } ?>

					</div>				
				</div>				
			</div>
		</div>
	</div>
</div>
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script>
$(document).ready(function () {

	$('.changeUserStatus').change(function(){
	    var status = $(this).prop('checked') == true ? 'enable' : 'disable';
	    var id     = $(this).attr('id');

 		console.log(status);
 		console.log(id);

	    $.ajax({
	        url: `<?= base_url(); ?>/admin/change_status`,
	        type: 'post',
	        data: {
	            id: id,
	            status: status 
	        },
	        success: function (result) {
	        }
	    });
	})

});


  $(function() {
    $('#toggle').bootstrapToggle({
      on: 'Enabled',
      off: 'Disabled'
    });
  })
</script>
<script>
	setTimeout(function() {
	    $('#success_alert').fadeOut('fast');
	    $('#danger_alert').fadeOut('fast');
	}, 5000); // <-- time in milliseconds
</script>