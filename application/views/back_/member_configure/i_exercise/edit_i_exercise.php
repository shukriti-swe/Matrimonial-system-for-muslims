<!--Horizontal Form-->
<!--===================================================-->
<?php
foreach ($get_i_exercise as $value) 
{
?>
	<form class="form-horizontal" id="i_exercise_form" action="" method="post">
		<div class="panel-body">
			<div class="form-group">
				<label class="col-sm-3 control-label" for="demo-hor-inputemail"><b>i_exercise Name</b></label>
				<div class="col-sm-8">
					<input type="hidden" class="form-control" name="i_exercise_id" value="<?=$value->i_exercise_id;?>">
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