<style>
 .hide {
  display: none;
  }
 .intl-tel-input{
	  display:block;
  }
</style>
<section class="slice sct-color-1">
	<?php if (!empty($success_alert)) : ?>
		<div class="col-6 ml-auto mr-auto" id="success_alert">
			<div class="alert alert-success alert-dismissible fade show" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<?= $success_alert ?>
			</div>
		</div>
	<?php endif ?>
	<div class="card-title card-bg">
			<h3 class="heading heading-6">
			<?php echo translate('Business Advertisement Information') ?>
			</h3>
		</div>
	<div class="container">

		<span class="clearfix"></span>
		<span class="space-xs-xl"></span>
		<div class="row justify-content-center">
			<div class="col-lg-8">
				<!-- Contact form -->
				<form class="form-default" role="form" method="POST" action="<?=base_url()?>home/advertisement" enctype="multipart/form-data">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group has-feedback">
								<label for="" class="text-uppercase c-gray-light" style="color: black !important;font-weight: bold;"><?php echo translate('name_of_applicant') ?></label>
								<input type="text" name="adviser_name" id="adviser_name" class="form-control form-control-md" value="<?= (isset($adviser_name))?$adviser_name:"";?>">
								<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
								<div class="help-block with-errors"></div>
							</div>
							<div id="adviser_name_error" class="text-danger"></div>
							<p class="text-danger"><?php echo form_error('adviser_name'); ?></p>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group has-feedback">
								<label for="" class="text-uppercase c-gray-light" style="color: black !important;font-weight: bold;"><?php echo translate('name_of_business') ?></label>
								<input type="text" name="title" id="title" class="form-control form-control-md" value="<?= (isset($ads_title))?$ads_title:"";?>">
								<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
								<div class="help-block with-errors"></div>
							</div>
							<div id="title_error" class="text-danger"></div>
							<p class="text-danger"><?php echo form_error('title'); ?></p>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<div class="form-group has-feedback">
								<label for="" class="text-uppercase c-gray-light" style="color: black !important;font-weight: bold;"><?php echo translate('Street Address of business') ?> </label>
								<textarea name="address" id="info" class="form-control no-resize" rows="3"  maxlength="300"><?= (isset($address))?$address:""; ?></textarea>
								<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
								<div class="help-block with-errors"></div>
							</div>
							<div id="info_error" class="text-danger"></div>
							<p class="text-danger"><?php echo form_error('address'); ?></p>

						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group has-feedback">
								<label for="" class="text-uppercase c-gray-light" style="color: black !important;font-weight: bold;"><?php echo translate('City &amp; State') ?></label>
								<input type="text" name="city_state" id="city_state" class="form-control form-control-md" value="<?= (isset($city_state))?$city_state:"";?>">
								<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
								<div class="help-block with-errors"></div>
							</div>
							<div id="city_state_error" class="text-danger"></div>
							<p class="text-danger"><?php echo form_error('city_state'); ?></p>

						</div>
					</div>
					<div class="row">
									<div class="col-sm-6">
							<div class="form-group has-feedback">
								<label for="" class="text-uppercase c-gray-light" style="color: black !important;font-weight: bold;"><?php echo translate('phone') ?></label>
								<input id="phone" type="tel" name="phone" value="<?= (isset($city_state)) ? $city_state : ""; ?>" class="form-control form-control-md"  onclick="formatingPhoneNumber()">
								<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
								<div class="help-block with-errors"></div>
							</div>
							<span id="valid-msg" class="hide">Valid</span>
							<span id="error-msg" class="hide">Invalid number</span>
							<div id="phone_error" class="text-danger"></div>
							<p class="text-danger"><?php echo form_error('phone'); ?></p>

						</div>
						<div class="col-md-6">
							<div class="form-group has-feedback">
								<label for="" class="text-uppercase c-gray-light" style="color: black !important;font-weight: bold;"><?php echo translate('email_address') ?></label>
								<input type="email" name="ads_email" id="ads_email" class="form-control form-control-md" value="<?= (isset($ads_email))?$ads_email:"";?>">
								<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
								<div class="help-block with-errors"></div>
							</div>
							<div id="ads_email_error" class="text-danger"></div>
							<p class="text-danger"><?php echo form_error('ads_email'); ?></p>

						</div>
					</div>
					
					<div class="row">
						<div class="col-md-6">
							<div class="form-group has-feedback">
								<label for="" class="text-uppercase c-gray-light" style="color: black !important;font-weight: bold;"><?php echo translate('url') ?></label>
								<input type="text" name="company_url" id="company_url" class="form-control form-control-md" value="<?= (isset($company_url))?$company_url:"";?>">
								<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
								<div class="help-block with-errors"></div>
							</div>
							<div id="company_url_error" class="text-danger"></div>
							<p class="text-danger"><?php echo form_error('company_url'); ?></p>

						</div>
						<div class="col-sm-6">
							<div class="form-group has-feedback">
								<label for="" class="text-uppercase c-gray-light" style="color: black !important;font-weight: bold;"><?php echo translate('company_logo') ?></label>
								<input type="file" name="company_logo" class="form-control form-control-md" id="company_logo" style="height: 37px">
								<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
								<div class="help-block with-errors"></div>
							</div>
							<div id="company_logo_error" class="text-danger"></div>
							<div  class="text-danger"><?= (isset($failed_image))?$failed_image:""; ?></div>

						</div>
					</div>
					
					
						<div class="row">
					<div class="col-md-12">
							<div class="form-group has-feedback">
								<label for="" class="text-uppercase c-gray-light" style="color: black !important;font-weight: bold;"><?php echo translate('Logo Background Color') ?></label><small class="ml-2 text-info">(Click the color name)</small>
								<input type="text" name="color" id="company_url" class="form-control colorpicker-common spectrum with-add-on basic" value="black">
								<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
								<div class="help-block with-errors"></div>
							</div>
					</div>
					</div>
					
					<div class="row">
						<div class="col-md-12">
							<div class="form-group has-feedback">
								<label for="" class="text-uppercase c-gray-light" style="color: black !important;font-weight: bold;"><?php echo translate('add_plan') ?> </label>

								<select class="form-control" name="advertisement_plans_id" id="advertisement_plans_id">
									<option value="">Select Duration</option>
									<?php foreach ($ads_plans as $value) { ?>
									<option value="<?= $value->id?>"><?= $value->duration?> Months ($<?= $value->amount?>)</option>
									<?php }?>
								</select>

								<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
								<div class="help-block with-errors"></div>
							</div>
							<div id="advertisement_plans_id_error" class="text-danger"></div>
						</div>
					</div>

					<div class="">
						<button type="submit" id="advertisement-submit" name="submit" value="submit" class="btn btn-styled btn-base-1 mt-4"><?php echo translate('add_your_advertisement') ?></button>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
<script>
	$(document).ready(function() {
		setTimeout(function() {
			$('.alert-success').fadeOut('fast');
		}, 5000); // <-- time in milliseconds
	});
</script>

<script type="text/javascript">
	// Used to format phone number
	function formatingPhoneNumber() {
	  $('#phone').on('input', function() {
	    var number = $(this).val().replace(/[^\d]/g, '')
	    if (number.length == 7) {
	      number = number.replace(/(\d{3})(\d{4})/, "$1-$2");
	    } else if (number.length == 10) {
	      number = number.replace(/(\d{3})(\d{3})(\d{4})/, "($1) $2-$3");
	      //$('#phone_error').html('');
	    }
	  //   else{
	  //   	$('#phone_error').html('Phone number must be 10 digit');
			// return false;
	  //   }
	    $(this).val(number)
	  });
	}
	$('#advertisement-submit').click(function(){
		var adviser_name = $('#adviser_name').val();
		var title = $('#title').val();
		var city_state = $('#city_state').val();
		var info = $('#info').val();
		var advertisement_plans_id = $('#advertisement_plans_id').val();
		var ads_email = $('#ads_email').val();
		var phone = $('#phone').val();
		var company_url = $('#company_url').val();

		
		if (adviser_name == '') {
			$('#adviser_name_error').html('Please provide your name');
			return false;
		}else{
			$('#adviser_name_error').html('');
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

		if (city_state == '') {
			$('#city_state_error').html('Please provide your  City & State');
			return false;
		}else{
			$('#city_state_error').html('');
		}

		if (phone == '') {
			$('#phone_error').html('Please provide your phone no');
			return false;
		}else{
			$('#phone_error').html('');
		}



		

		if (ads_email == '') {
			$('#ads_email_error').html('Please provide your email');
			return false;
		}else{
			$('#ads_email_error').html('');
		}
		
		var testt =company_url.substring(0, 4);
		
		if (testt != 'http') {
			
			$('#company_url_error').html('Please provide valid url like https://www.test.com');
			return false;
		}else{
			$('#company_url_error').html('');
		}
		
		if (advertisement_plans_id == '') {
			$('#advertisement_plans_id_error').html('Please provide your advertisement plans');
			return false;
		}else{
			$('#advertisement_plans_id_error').html('');
		}


	})

</script>

<script>
 $(document).ready(function(e) {
  var telInput = $("#phone"),
  errorMsg = $("#error-msg"),
  validMsg = $("#valid-msg");

// initialise plugin
telInput.intlTelInput({

  allowExtensions: true,
  formatOnDisplay: true,
  autoFormat: true,
  autoHideDialCode: true,
  autoPlaceholder: false,
  defaultCountry: "auto",
  ipinfoToken: "yolo",

  nationalMode: false,
  numberType: "MOBILE",
  //onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
  preferredCountries: ['sa', 'ae', 'qa','om','bh','kw','ma'],
  preventInvalidNumbers: true,
  separateDialCode: true,
  initialCountry: "auto",
  geoIpLookup: function(callback) {
  $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
    var countryCode = (resp && resp.country) ? resp.country : "";
    callback(countryCode);
  });
},
   utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/utils.js"
});

var reset = function() {
  telInput.removeClass("error");
  errorMsg.addClass("hide text-danger");
  validMsg.addClass("hide text-success");
};

// on blur: validate
telInput.blur(function() {
  reset();
  if ($.trim(telInput.val())) {
    if (telInput.intlTelInput("isValidNumber")) {
      validMsg.removeClass("hide text-success");
    } else {
      telInput.addClass("error");
      errorMsg.removeClass("hide text-danger");
    }
  }
});

// on keyup / change flag: reset
telInput.on("keyup change", reset);
	
});
</script>