<!--Horizontal Form-->
<!--===================================================-->
<?php
foreach ($get_advertisements as $value) 
{
?>
	<form class="form-horizontal" id="advertisements_form" action="" method="post">
		<div class="panel-body">
			<div class="form-group">
				<label class="col-sm-3 control-label" for="demo-hor-inputemail"><b></b></label>
				<div class="col-sm-8">
					<?php if ($value->company_logo != null): ?>
						<img style="height:200px;width:200px;" src="<?=base_url()?>uploads/ads_logo/<?= $value->company_logo; ?>">
					<?php endif ?>
					<input type="file" name="company_logo" id="company_logo">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label" for="demo-hor-inputemail"><b>Name</b></label>
				<div class="col-sm-8">
					<input type="hidden" class="form-control" name="advertisements_id" id="advertisements_id" value="<?=$value->advertisements_id;?>">
					<input type="text" class="form-control" name="title" id="title" value="<?=$value->title;?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label" for="demo-hor-inputemail"><b>Address</b></label>
				<div class="col-sm-8">
					<textarea class="form-control" name="address" id="address" rows="4"><?=$value->address;?></textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label" for="demo-hor-inputemail"><b>City & State</b></label>
				<div class="col-sm-8">
					<textarea class="form-control" name="city_state"  id="city_state" rows="4"><?=$value->city_state;?></textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label" for="demo-hor-inputemail"><b>Phone</b></label>
				<div class="col-sm-8">
					<input type="tel" class="form-control ads_phone" name="ads_phone" id="phone" value="<?=$value->ads_phone;?>">
					<span id="valid-msg" class="hide">Valid</span>
			        <span id="error-msg" class="hide">Invalid number</span>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label" for="demo-hor-inputemail"><b>Package</b></label>
				<div class="col-sm-8">
					<select class="form-control" name="advertisement_plans_id" disabled="">
						<option value="">Select plan</option>
						<?php foreach ($ads_plans as $plan) { ?>
							<option value="<?= $plan->id?>" <?php echo ($plan->id == $value->advertisement_plans_id) ? "selected" : ''; ?> ><?= $plan->duration?> Months ($<?= $plan->amount?>)</option>
						<?php }?>

					</select>
				</div>
			</div>
			<div class="row">
		      <div class="form-group">
				 <div class="col-sm-3">
				<label class="control-label" for="demo-hor-inputemail"><b>Logo Background Color</b><small class="m-2 text-info">(Click the color name) </small></label>
				
				</div>
			<div class="col-sm-8">
			<input type="text" name="color"  class="form-control colorpicker-common spectrum with-add-on basic" value="<?=$value->color;?>" id="color">		
			</div>		
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label" for="demo-hor-inputemail"><b>Start Date</b></label>
				<div class="col-sm-8">
					<input type="date" class="form-control" name="start_date" value="<?=$value->start_date;?>" disabled>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label" for="demo-hor-inputemail"><b>End Date</b></label>
				<div class="col-sm-8">
					<input type="date" class="form-control" name="end_date" id="end_date" value="<?=$value->end_date;?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label" for="demo-hor-inputemail"><b>Email</b></label>
				<div class="col-sm-8">
					<input type="text" class="form-control" name="ads_email" id="ads_email" value="<?=$value->ads_email;?>">
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-sm-3 control-label" for="demo-hor-inputemail"><b>Company URL: </b></label>
				<div class="col-sm-8">
					<input type="text" class="form-control" name="company_url" id="company_url" value="<?=$value->company_url;?>" >
				</div>
			</div>	
		</div>
	</form>
<script>
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
<style>
 .hide {
  display: none;
  }
 .intl-tel-input{
	  display:block;
  }
</style>
<?php
}
?>
<!--===================================================-->
<!--End Horizontal Form-->