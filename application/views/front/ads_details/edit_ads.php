<section class="slice sct-color-1">
	<div class="card-title card-bg">
		<h3 class="heading heading-6">
		Ads Details
		</h3>
	</div>
	<div class="container">
		<span class="clearfix"></span><br/><br/>
			<form class="form-horizontal" id="advertisements_form" action="" method="post">
			<div class="panel-body">
				<div class="form-group">
					<label class="col-sm-3 control-label" for="demo-hor-inputemail"><b>Ads Title: </b> <strong><?=$ads->title;?></strong></label>
					<div class="col-sm-8">
						<input type="hidden" class="form-control" name="advertisements_id" value="<?=$ads->advertisements_id;?>">
						<input type="text" class="form-control" name="title" value="<?=$ads->title;?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label" for="demo-hor-inputemail"><b>Ads Info</b></label>
					<div class="col-sm-8">
						<textarea class="form-control" name="address" rows="5"><?=$ads->address;?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label" for="demo-hor-inputemail"><b>Duration</b></label>
					<div class="col-sm-8">
						<select class="form-control" name="duration" disabled="">
							<option value="">Select Duration</option>
							<?php if ($ads->duration == 1){ ?>
								<option selected="" value="1">1 Month</option>
							<?php }else{ ?>
								<option  value="1">1 Month</option>
							<?php } ?>

							<?php if ($ads->duration == 6){ ?>
								<option selected="" value="6">6 Month</option>
							<?php }else{ ?>
								<option  value="6">6 Month</option>
							<?php } ?>

							<?php if ($ads->duration == 12){ ?>
								<option selected="" value="12">1 Year</option>
							<?php }else{ ?>
								<option  value="12">1 Year</option>
							<?php } ?>

						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label" for="demo-hor-inputemail"><b>Start Date</b></label>
					<div class="col-sm-8">
						<input type="date" class="form-control" name="start_date" value="<?=$ads->start_date;?>" disabled>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label" for="demo-hor-inputemail"><b>End Date</b></label>
					<div class="col-sm-8">
						<input type="date" class="form-control" name="end_date" value="<?=$ads->end_date;?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label" for="demo-hor-inputemail"><b>Email</b></label>
					<div class="col-sm-8">
						<input type="date" class="form-control" name="ads_email" value="<?=$ads->ads_email;?>" disabled>
					</div>
				</div>

			</div>
		</form>
	</div>
</section>