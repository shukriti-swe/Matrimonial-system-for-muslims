<!--Horizontal Form-->
<!--===================================================-->
<style>
 .hide {
  display: none;
  }
 .intl-tel-input{
	  display:block;
  }
</style>
<form class="form-horizontal" id="advertisements_form" method="post">
	<div class="panel-body">
		<div class="form-group">
			<label class="col-sm-3 control-label" for="demo-hor-inputemail"><b>Adviser Name</b></label>
			<div class="col-sm-8">
				<input type="text" class="form-control" name="adviser_name" value="" required>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label" for="demo-hor-inputemail"><b>Name of Business</b></label>
			<div class="col-sm-8">
				<input type="text" class="form-control" name="title" id="title" value="" required>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label" for="demo-hor-inputemail"><b>Street Address of business</b></label>
			<div class="col-sm-8">
				<textarea class="form-control" name="address" id="address" required rows="3"></textarea>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label" for="demo-hor-inputemail"><b>City &amp; State</b></label>
			<div class="col-sm-8">
				<textarea class="form-control" name="city_state" id="city_state" required rows="3"></textarea>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-3 control-label" for="demo-hor-inputemail"><b>Package</b></label>
			<div class="col-sm-8">
				<select class="form-control" name="advertisement_plans_id" id="advertisement_plans_id">
					<option value="">Select plan</option>
					<?php foreach ($ads_plans as $value) { ?>
						<option value="<?= $value->id?>"><?= $value->duration?> Months ($<?= $value->amount?>)</option>
					<?php }?>
				</select>
			</div>
		</div>
		<div class="row">
		     <div class="form-group">
			<div class="col-sm-4">		 
			<label class="control-label" for="demo-hor-inputemail"><b>Logo Background Color</b></label>
			<br><small class="text-info">(Click the color name) </small>
			</div>
			<div class="col-sm-8">
			<input type="text" name="color"  class="form-control colorpicker-common spectrum with-add-on basic" value="black" id="color">		
		</div>		
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label" for="demo-hor-inputemail"><b>Email</b></label>
			<div class="col-sm-8">
				<input class="form-control" type="email" name="ads_email" id="ads_email">
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label" for="demo-hor-inputemail"><b>Phone</b></label>
			<div class="col-sm-8">
				<input class="form-control ads_phone" type="tel" name="ads_phone" id="phone" onclick="formatingPhoneNumber()">
				<span id="valid-msg" class="hide">Valid</span>
			          <span id="error-msg" class="hide">Invalid number</span>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label" for="demo-hor-inputemail"><b>Company URL</b></label>
			<div class="col-sm-8">
				<input class="form-control" type="url" name="company_url" id="company_url">
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label" for="demo-hor-inputemail"><b>Company Logo</b></label>
			<div class="col-sm-8">
				<input type="file" name="company_logo" class="form-control form-control-md" id="company_logo" style="height: 37px">
			</div>
		</div>
	</div>
</form>
<!--===================================================-->
<!--End Horizontal Form-->
<script>
	
	$('#duration').change(function(){
		var value = $(this).val();
		
	})
	function formatingPhoneNumber() {
	  $('#ads_phone').on('input', function() {
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
	$(".basic").spectrum();
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
  autoPlaceholder: true,
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