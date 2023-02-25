<section class="slice sct-color-1">
	<div class="card-title card-bg">
		<h3 class="heading heading-6">
		Add Advertisement
		</h3>
	</div>
	<center>
		<div class="container">
			<span class="clearfix"></span><br/><br/>
				<div class="text-danger">
					<?php echo validation_errors(); ?>
				</div>
				<form class="form-horizontal" id="advertisements_form" action="<?=base_url()?>home/advertisement/from_submit" method="post">
				<div class="panel-body" style="border-style: solid;border-color: #e91e63;">
					<div class="form-group">
						<label class="col-sm-3 control-label" for="demo-hor-inputemail"><b> <?= translate('name_of_bunnisness') ?> </label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="title" id="title" value="" placeholder="<?= translate('name_of_bunnisness') ?>">
						<div id="title_error" class="text-danger"></div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="demo-hor-inputemail"><b><?= translate('address') ?></b></label>
						<div class="col-sm-8">
							<textarea class="form-control" name="address" id="info" placeholder="<?= translate('address') ?>" rows="5"></textarea>
						<div id="info_error" class="text-danger"></div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label" for="demo-hor-inputemail"><b> <?= translate('phone') ?> </label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="phone" id="phone" value="" placeholder="<?= translate('phone') ?>">
						<div id="phone_error" class="text-danger"></div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label" for="demo-hor-inputemail"><b>Ads Plan</b></label>
						<div class="col-sm-8">
							<select class="form-control" name="advertisement_plans_id" id="advertisement_plans_id">
								<option value="">Select Duration</option>
								<?php foreach ($ads_plans as $value) { ?>
								<option value="<?= $value->id?>"><?= $value->duration?> Month ($<?= $value->amount?>)</option>
								<?php }?>
							</select>
						<div id="advertisement_plans_id_error" class="text-danger"></div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="demo-hor-inputemail"><b><?= translate('email') ?></b></label>
						<div class="col-sm-8">
							<input type="email" class="form-control" name="ads_email" id="ads_email" value="" required="" placeholder="<?= translate('email') ?>">
						<div id="ads_email_error" class="text-danger"></div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-8">
						<button class="btn btn-secondary" type="submit" id="advertisement-submit"><?= translate('add_your_advertise') ?></button>
							
						</div>
					</div>

				</div>
			</form>
		</div>
	</center>

</section>
<script type="text/javascript">
	$('#advertisement-submit').click(function(){
		var title = $('#title').val();
		var info = $('#info').val();
		var advertisement_plans_id = $('#advertisement_plans_id').val();
		var ads_email = $('#ads_email').val();
		var phone = $('#phone').val();

		if (phone == '') {
			$('#phone_error').html('Please provide your phone no');
			return false;
		}else{
			$('#phone_error').html('');
		}

		if (title == '') {
			$('#title_error').html('Please provide your Name Of Bunnisness');
			return false;
		}else{
			$('#title_error').html('');
		}

		if (info == '') {
			$('#info_error').html('Please provide your address');
			return false;
		}else{
			$('#info_error').html('');
		}

		if (advertisement_plans_id == '') {
			$('#advertisement_plans_id_error').html('Please provide your advertisement plans');
			return false;
		}else{
			$('#advertisement_plans_id_error').html('');
		}

		if (ads_email == '') {
			$('#ads_email_error').html('Please provide your email');
			return false;
		}else{
			$('#ads_email_error').html('');
		}


	})
</script>