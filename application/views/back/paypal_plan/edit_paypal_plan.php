<!--Horizontal Form-->
<!--===================================================-->
<?php
foreach ($get_paypal_plan as $value) 
{
?>
	<form class="form-horizontal" id="paypal_plan_form" action="" method="post">
		<div class="panel-body">
			<div class="form-group">
				<label class="col-sm-3 control-label" for="demo-hor-inputemail"><b>Plan Id</b></label>
				<div class="col-sm-8">
					<input type="hidden" class="form-control" name="id" value="<?=$value->id;?>">
					<input type="text" class="form-control" name="plan_id" value="<?=$value->plan_id;?>" readonly>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label" for="demo-hor-inputemail"><b>Plan Description</b></label>
				<div class="col-sm-8">
					<input type="text" class="form-control" name="description" value="<?=$value->description;?>" readonly>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label" for="demo-hor-inputemail"><b>Plan Type</b></label>
				<div class="col-sm-8">
					<input type="text" class="form-control" name="type" value="<?=$value->type;?>" readonly>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label" for="demo-hor-inputemail"><b>Plan Amount</b></label>
				<div class="col-sm-8">
					<input type="text" class="form-control" name="amount" value="<?=$value->amount;?>">
				</div>
			</div>
		</div>
	</form>
<?php
}
?>
<!--===================================================-->
<!--End Horizontal Form-->