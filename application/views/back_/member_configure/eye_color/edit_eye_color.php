<!--Horizontal Form-->
<!--===================================================-->
<?php
foreach ($get_eye_color as $value) 
{
?>
	<form class="form-horizontal" id="eye_color_form" action="" method="post">
		<div class="panel-body">
			<div class="form-group">
				<label class="col-sm-3 control-label" for="demo-hor-inputemail"><b>Eye Color Name</b></label>
				<div class="col-sm-8">
					<input type="hidden" class="form-control" name="eye_color_id" value="<?=$value->eye_color_id;?>">
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