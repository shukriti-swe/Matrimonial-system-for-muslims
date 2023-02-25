<!--Horizontal Form-->
<!--===================================================-->
<?php
foreach ($get_body_type as $value) 
{
?>
	<form class="form-horizontal" id="body_type_form" action="" method="post">
		<div class="panel-body">
			<div class="form-group">
				<label class="col-sm-3 control-label" for="demo-hor-inputemail"><b>Body Type Name</b></label>
				<div class="col-sm-8">
					<input type="hidden" class="form-control" name="body_type_id" value="<?=$value->body_type_id;?>">
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