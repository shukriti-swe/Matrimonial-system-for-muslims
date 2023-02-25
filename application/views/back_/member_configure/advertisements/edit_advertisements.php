<!--Horizontal Form-->
<!--===================================================-->
<?php
foreach ($get_advertisements as $value) 
{
?>
	<form class="form-horizontal" id="advertisements_form" action="" method="post">
		<div class="panel-body">
			<div class="form-group">
				<label class="col-sm-3 control-label" for="demo-hor-inputemail"><b>Ads Title</b></label>
				<div class="col-sm-8">
					<input type="hidden" class="form-control" name="advertisements_id" value="<?=$value->advertisements_id;?>">
					<input type="text" class="form-control" name="title" value="<?=$value->title;?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label" for="demo-hor-inputemail"><b>Ads Info</b></label>
				<div class="col-sm-8">
					<textarea class="form-control" name="address" rows="4"><?=$value->address;?></textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label" for="demo-hor-inputemail"><b>Ads Plan</b></label>
				<div class="col-sm-8">
					<select class="form-control" name="advertisement_plans_id" disabled="">
						<option value="">Select plan</option>
						<?php foreach ($ads_plans as $plan) { ?>
							<option value="<?= $plan->id?>" <?php echo ($plan->id == $value->advertisement_plans_id) ? "selected" : ''; ?> ><?= $plan->duration?> Month ($<?= $plan->amount?>)</option>
						<?php }?>

					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label" for="demo-hor-inputemail"><b>Start Date</b></label>
				<div class="col-sm-8">
					<input type="date" class="form-control" name="start_date" value="<?=$value->start_date;?>" disabled>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label" for="demo-hor-inputemail"><b>End Date</b></label>
				<div class="col-sm-8">
					<input type="date" class="form-control" name="end_date" value="<?=$value->end_date;?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label" for="demo-hor-inputemail"><b>Ads Email</b></label>
				<div class="col-sm-8">
					<input type="text" class="form-control" name="ads_email" value="<?=$value->ads_email;?>" disabled>
				</div>
			</div>

		</div>
	</form>
<?php
}
?>
<!--===================================================-->
<!--End Horizontal Form-->