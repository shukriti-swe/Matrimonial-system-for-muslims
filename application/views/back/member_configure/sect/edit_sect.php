<!--Horizontal Form-->
<!--===================================================-->
<?php
foreach ($get_sect as $value) 
{
?>
	<form class="form-horizontal" id="sect_form" action="" method="post">
		<div class="panel-body">
			<div class="form-group">
				<label class="col-sm-3 control-label" for="demo-hor-inputemail"><b>Sect Name</b></label>
				<div class="col-sm-8">
					<input type="hidden" class="form-control" name="sect_id" value="<?=$value->sect_id;?>">
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