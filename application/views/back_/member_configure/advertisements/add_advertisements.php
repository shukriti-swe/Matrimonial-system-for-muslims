<!--Horizontal Form-->
<!--===================================================-->
<form class="form-horizontal" id="advertisements_form" method="post">
	<div class="panel-body">
		<div class="form-group">
			<label class="col-sm-3 control-label" for="demo-hor-inputemail"><b>Ads Title</b></label>
			<div class="col-sm-8">
				<input type="text" class="form-control" name="title" value="" required>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label" for="demo-hor-inputemail"><b>Ads Info</b></label>
			<div class="col-sm-8">
				<textarea class="form-control" name="address" required rows="3"></textarea>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-3 control-label" for="demo-hor-inputemail"><b>Ads Plan</b></label>
			<div class="col-sm-8">
				<select class="form-control" name="advertisement_plans_id" id="advertisement_plans_id">
					<option value="">Select plan</option>
					<?php foreach ($ads_plans as $value) { ?>
						<option value="<?= $value->id?>"><?= $value->duration?> Month ($<?= $value->amount?>)</option>
					<?php }?>
				</select>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label" for="demo-hor-inputemail"><b>Ads Email</b></label>
			<div class="col-sm-8">
				<input class="form-control" type="email" name="ads_email" id="ads_email">
			</div>
		</div>
	</div>
</form>
<!--===================================================-->
<!--End Horizontal Form-->
<script type="">
	
	$('#duration').change(function(){
		var value = $(this).val();
		
	})
</script>