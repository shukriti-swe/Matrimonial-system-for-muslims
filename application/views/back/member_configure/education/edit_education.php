<!--Horizontal Form-->
<!--===================================================-->
<?php
foreach ($get_education as $value) 
{
?>
	<form class="form-horizontal" id="education_form" action="" method="post">
		<div class="panel-body">
			<div class="form-group">
				<label class="col-sm-3 control-label" for="demo-hor-inputemail"><b>Body Type Name</b></label>
				<div class="col-sm-8">
					<input type="hidden" class="form-control" name="education_id" value="<?=$value->education_id;?>">
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