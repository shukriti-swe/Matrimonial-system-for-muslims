<!--Horizontal Form-->
<!--===================================================-->
<?php
foreach ($get_hair_color as $value) 
{
?>
	<form class="form-horizontal" id="hair_color_form" action="" method="post">
		<div class="panel-body">
			<div class="form-group">
				<label class="col-sm-3 control-label" for="demo-hor-inputemail"><b>Hair Color Name</b></label>
				<div class="col-sm-8">
					<input type="hidden" class="form-control" name="hair_color_id" value="<?=$value->hair_color_id;?>">
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