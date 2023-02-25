<!--Horizontal Form-->
<!--===================================================-->
<?php
foreach ($get_maritalstatus as $value) 
{
?>
	<form class="form-horizontal" id="maritalstatus_form" action="" method="post">
		<div class="panel-body">
			<div class="form-group">
				<label class="col-sm-3 control-label" for="demo-hor-inputemail"><b>Marital status Name</b></label>
				<div class="col-sm-8">
					<input type="hidden" class="form-control" name="marital_status_id" value="<?=$value->marital_status_id;?>">
					<input type="text" class="form-control" name="name" value="<?=$value->name;?>">
				</div>
			</div>
		</div>
	</form>
<?php
}
?>
<!--===================================================-->
<!--End Horizontal Form-->