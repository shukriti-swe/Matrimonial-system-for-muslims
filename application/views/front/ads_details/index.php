<?php

$check_paypal = $this->Crud_model->filter_one("business_settings" , "business_settings_id" , 4);
$paypalEmail = $this->Crud_model->filter_one("business_settings" , "business_settings_id" , 3);

$paypalEmail_ = $paypalEmail[0]['value'];
if ($check_paypal[0]['value'] == "sandbox" ) {
    $action = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
}else{

    $action = 'https://www.paypal.com/cgi-bin/webscr';
}

?>

<style>
 .hide {
  display: none;
  }
</style>
<section class="slice sct-color-1">
	<div class="card-title card-bg">
		<h3 class="heading heading-6">
			Your Advertisement 
		</h3>
	</div>
	<div class="container">
		<span class="clearfix"></span><br/><br/>



		<?php
		 if ($ads->status == 3) {?>
			<div class="alert alert-danger alert-dismissible fade show" role="alert">
			  <strong>As soon as your advertisement is checked & approved, it will be displayed for all to see.</strong>.
			</div>
		<?php } ?>

		<?php 
			$today = date('Y-m-d');

			$this->db->from('advertisements');
			$this->db->join('advertisement_plans', 'advertisement_plans.id = advertisements.advertisement_plans_id');
			$this->db->where('advertisements.advertisements_id', $ads->advertisements_id );
			$this->db->where('advertisements.end_date <', $today );
			$result = $this->db->get()->result();

		if (count($result) > 0) { ?>
			<div class="alert alert-warning alert-dismissible fade show" role="alert">
			  <strong>Your Advertisement date expired please pay payment!!</strong>.
			</div>

			<div class="">
				<form action="<?= $action; ?>" method="post">
                    <input type="hidden" name="cmd" value="_xclick">
                    <input type="hidden" name="business" value="<?= $paypalEmail_; ?>">
                    <input type="hidden" name="item_name" value="Advertisement <?= $result[0]->duration ?> month ">
                    <input type="hidden" name="item_number" value="1">
                    <input type="hidden" name="amount" value="<?= $result[0]->amount ?>">
                    <input type="hidden" name="no_shipping" value="0">
                    <input type="hidden" name="no_note" value="1">
                    <input type="hidden" name="currency_code" value="USD">
                    <input type="hidden" id="custom" name="custom" value="advertisement_<?= $result[0]->advertisements_id ?>_<?= $result[0]->duration ?>"> 

                    <input type="hidden" name="cancel_return" value="<?= base_url()."home/paypal_cancel_advertise" ?>">
                    <input type="hidden" name="return" value="<?= base_url()."home/paypalAdvertisementSuccess/advertisement" ?>">

                    <input type="image" style="max-width: 100px" src="<?= base_url('/') ?>template/front/images/paypal.jpg" border="0" name="submit" alt="PayPal - The safer, easier way to pay online." title="PayPal">
                    <img alt="" border="0" src="<?= base_url('/') ?>template/front/images/paypal.jpg" width="1" height="1">

                </form>


				<a>
					<img style="max-width: 100px" src="<?php echo base_url()?>template/front/images/stripe.jpg" onclick="stripe_payment('<?= $result[0]->advertisements_id ?>' , '<?= $result[0]->stripe_prize_id ?>' , '<?= $result[0]->amount ?>' , '<?= $result[0]->duration ?>' )" >
				</a>

			</div>
			<br>
		<?php } ?>

		<?php 

		$this->db->from('advertisements');
		$this->db->join('advertisement_plans', 'advertisement_plans.id = advertisements.advertisement_plans_id');
		$this->db->join('advertisements_payment', 'advertisements_payment.advertisement_id = advertisements.advertisements_id');
		$this->db->where('advertisements.advertisements_id', $ads->advertisements_id );
		$result = $this->db->get()->result();
		// echo "string";
		// print_r($result);die();
		?>
		<?php if (isset($result) && !empty($result)): ?>
		 <?php  if ($result[0]->payment_status != "completed" ) { ?>
			
			<div class="alert alert-warning alert-dismissible fade show" role="alert">
			  <strong>Your Advertisement is awaiting. Please make payment.</strong>.
			</div>

	     <?php	} ?>
		<?php endif ?>

			<form class="form-horizontal" id="advertisements_form" action="" method="post">
			<div class="panel-body" style=" border-style: solid;border-color: #e91e63;">
			    <div class="text-right mb-4" style="padding: 0.8em !important; background-color: #e91e63;">
			         <button type="button" class="btn btn-styled btn-base-1" data-target="#advertisements_modal" data-toggle="modal" style="color: #e91e63; background-color: #ffffff;">Edit</button>
			    </div>
			   <div class="" style="padding-left: 45%;">
			    <?php if (isset($ads->company_logo) && !empty($ads->company_logo)): ?>
					<div class="form-group" style="margin-bottom: 0;">
						<span for="demo-hor-inputemail"><img style="max-height:60px;max-width:150px;" src="<?= base_url()?>uploads/ads_logo/<?= $ads->company_logo?>"></span>
					</div>
				<?php endif ?>
				 <div class="form-group">
				   <h4 class="heading heading-xs strong-600 text-uppercase mb-1" style=""><?= $ads->title ?></h4>
				   <p style="margin-bottom: 0; font-size:12px;line-height: 1;"><?= $ads->address ?></p>
                   <p style="margin-bottom: 0; font-size:12px;line-height: 1;" ><?= $ads->city_state ?></p>
                   <p style="margin-bottom: 0; font-size:12px;line-height: 1;"><?= $ads->ads_phone ?></p>
                   <p style="margin-bottom: 0; font-size:12px;line-height: 1;"><?= $ads->ads_email ?></p>
                   <?php if ($ads->company_url != null): ?>
                    <p style="margin-bottom: 0;font-size:12px;line-height: 1;" >Visit Company URL <a href="<?= $ads->company_url ?>"> Here </a></p>
                   <?php endif ?>
				</div>
				
				<div class="form-group">

					<div class="row">
						<div class="col-sm-4">	
						</div>

						<div class="col-sm-4" >	
							<?php if (isset($result) && !empty($result)): ?>
							<?php  if ($result[0]->payment_status != "completed") { ?>
							<div class="" style="display: flex; justify-content: center">
								<form action="<?= $action; ?>" method="post">
				                    <input type="hidden" name="cmd" value="_xclick-subscriptions">
				                    <input type="hidden" name="business" value="<?= $paypalEmail_; ?>">
				                    <input type="hidden" name="item_name" value="Advertisement <?= $result[0]->duration ?> month ">
				                    <input type="hidden" name="item_number" value="1">
				                    <input type="hidden" name="no_shipping" value="0">
				                    <input type="hidden" name="no_note" value="1">
				                    <input type="hidden" name="currency_code" value="USD">
				                    <input type="hidden" id="custom" name="custom" value="advertisement_<?= $result[0]->advertisements_id ?>_<?= $result[0]->duration ?>"> 
				                    <input type="hidden" name="a3" value="<?= $result[0]->amount ?>">
							        <input type="hidden" name="p3" value="<?= $result[0]->duration ?>">
							        <input type="hidden" name="t3" value="M">

				                    <input type="hidden" name="cancel_return" value="<?= base_url()."home/paypal_cancel_advertise" ?>">
				                    <input type="hidden" name="return" value="<?= base_url()."home/paypalAdvertisementSuccess/advertisement" ?>">
				                    
				                    <input type="image" style="max-width: 100px" src="<?= base_url('/') ?>template/front/images/paypal.jpg" border="0" name="submit" alt="PayPal - The safer, easier way to pay online." title="PayPal">
				                    <img alt="" border="0" src="<?= base_url('/') ?>template/front/images/paypal.jpg" width="1" height="1">
				                </form>
								<a>
									<img style="max-width: 100px" src="<?php echo base_url()?>template/front/images/stripe.jpg" onclick="stripe_payment('<?= $result[0]->advertisements_id ?>' , '<?= $result[0]->stripe_prize_id ?>' , '<?= $result[0]->amount ?>' , '<?= $result[0]->duration ?>' )" >
								</a>
							</div>
							<?php } ?>	
						<?php endif ?>
						</div>

						<div class="col-sm-4">	
							
						</div>

					</div>
				</div>
				   </div>
				<br/><br/>
			</div>
		</form>
	</div>
</section>
<!--Default Bootstrap Modal-->
<!--===================================================-->
<div class="modal fade" id="advertisements_modal" role="dialog" tabindex="-1" aria-labelledby="advertisements_modal" aria-hidden="true" style="background:rgba(0,0,0,.5)">
    <div class="modal-dialog">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <h5 class="modal-title">Update Advertisement</h5>
            </div>
			<div style="margin-left:10px;" id="validation_info"></div>
            <!--Modal body-->
            <div class="modal-body" id="modal_body" style="padding: 15px;">
            	<form class="form-horizontal" id="advertisements_edit_form" action="" method="post">
					<div class="panel-body">
						<div class="form-group row" style="margin-left: 35%;">
							<label class="col-sm-3 control-label" for="demo-hor-inputemail"></label>
							<?php if ($ads->company_logo != null): ?>
							<div class="col-sm-12" style="padding:0;">
								<img src="<?= base_url()?>uploads/ads_logo/<?= $ads->company_logo?>">
							</div>
							<?php endif ?>
							<input type="file" name="company_logo" id="company_logo">
						</div>
						<div class="form-group row">
							<label class="col-sm-4 control-label" for="demo-hor-inputemail"><b> <?= translate('name_of_applicant') ?> </b></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="adviser_name" id="adviser_name" value="<?=$ads->adviser_name;?>">
								<div class="text-danger" id="adviser_name_error"></div>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-4 control-label" for="demo-hor-inputemail"><b><?= translate('name_of_business') ?> </b></label>
							<div class="col-sm-8">
								<input type="hidden" class="form-control" name="advertisements_id" id="advertisements_id" value="<?=$ads->advertisements_id;?>">
								<input type="text" class="form-control" name="title" id="title" value="<?=$ads->title;?>">
								<div class="text-danger" id="title_error"></div>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-4 control-label" for="demo-hor-inputemail"><b> <?= translate('address') ?> </b></label>
							<div class="col-sm-8">
								<textarea class="form-control" name="address" id="address" rows="3"><?=$ads->address;?></textarea>
								<div class="text-danger" id="address_error"></div>
							</div>
						</div>

						<div class="form-group row">
							<label class="col-sm-4 control-label" for="demo-hor-inputemail"><b> <?= translate('City_&_State') ?> </b></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="city_state" id="city_state" value="<?=$ads->city_state;?>">
								<div class="text-danger" id="city_state_error"></div>
							</div>
						</div>
					<div class="form-group row">
							<label class="col-sm-4 control-label" for="demo-hor-inputemail"><b> <?= translate('phone') ?> </b></label>
							<div class="col-sm-8">
								<input id="phone" type="tel" class="form-control" name="ads_phone" id="ads_phone" value="<?=$ads->ads_phone;?>">
								<div class="text-danger" id="ads_phone_error"></div>
							</div>
							<span id="valid-msg" class="hide">Valid</span>
							<span id="error-msg" class="hide">Invalid number</span>
						</div>
						<div class="form-group row">
							<label class="col-sm-4 control-label" for="demo-hor-inputemail"><b> <?= translate('email') ?> </b></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="ads_email" id="ads_email" value="<?=$ads->ads_email;?>">
								<div class="text-danger" id="ads_email_error"></div>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-4 control-label" for="demo-hor-inputemail"><b> <?= translate('company_url') ?> </b></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="company_url" id="company_url" value="<?=$ads->company_url;?>">
								<div class="text-danger" id="company_url_error"></div>
							</div>
						</div>
						
						  <div class="form-group row">
						<div class="col-sm-4">	  
						<label class="control-label" for="demo-hor-inputemail"><b>Logo Background</b></label> 
						<br><small class="text-info">(Click the color name)</small>
						</div>	
						<div class="col-sm-8">
						<input type="text" name="color"  class="form-control colorpicker-common spectrum with-add-on basic" value="<?=$ads->color;?>" id="color">		
					        </div>		
				            </div>
					</div>
				</form>
            </div>          
            <!--Modal footer-->
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default btn-sm" type="button" id="modal_close"><?php echo translate('close')?></button>
                <button class="btn btn-primary btn-sm" id="save_advertisements" value="0"><?php echo translate('save')?></button>
            </div>
        </div>
    </div>
</div>
<!--===================================================-->
<!--End Default Bootstrap Modal-->
<script type="text/javascript">
	$('#save_advertisements').click(function(e){
		var id = $('#advertisements_id').val();
		var title = $('#title').val();
		var address = $('#address').val();
		var ads_email = $('#ads_email').val();
		var ads_phone = $('#ads_phone').val();
		var city_state = $('#city_state').val();
		var company_url = $('#company_url').val();
		var adviser_name = $('#adviser_name').val();
		var color = $('#color').val();
	    if (adviser_name == '') {
			$('#adviser_name_error').html('Please provide your name');
			return false;
		}else{
			$('#adviser_name_error').html('');
		}
		if (title == '') {
			$('#title_error').html('Please provide your ads title');
			return false;
		}else{
			$('#title_error').html('');
		}
	     if (address == '') {
			 $('#address_error').html('Please provide your ads info');
			 return false;
		 }else{
			 $('#address_error').html('');
		 }
		
	    if (ads_email == '') {
            $('#ads_email_error').html('Please provide your ads email');
            return false;
        }else{
            $('#ads_email_error').html('');
        }
	    if (ads_phone == '') {
            $('#ads_phone_error').html('Please provide your ads phone');
            return false;
        }else{
            $('#ads_phone_error').html('');
        }
	    if (city_state == '') {
            $('#city_state_error').html('Please provide your city & state');
            return false;
        }else{
            $('#city_state_error').html('');
        }
		e.preventDefault();
        var fd = new FormData();
        var files = $('#company_logo')[0].files;
		fd.append('file',files[0]);
		fd.append('company_logo',true);
		fd.append('ads_email',ads_email);
		fd.append('city_state',city_state);
		fd.append('ads_phone',ads_phone);
		fd.append('address',address);
		fd.append('title',title);
		fd.append('company_url',company_url);
		fd.append('adviser_name',adviser_name);
		fd.append('color',color);
		fd.append('id',id);
		//console.log(fd);return;
		$.ajax({
              url: '<?php echo base_url(); ?>home/updateAdvertisement',
              type: 'POST',
        	  data:fd,
			  contentType: false,
			  processData: false,
			  success: function(response) {
				  console.log(response);
				if(response == 'success'){
					location.reload();
				}
				if(response == 'logo_error'){
					$('#validation_info').html('Please upload image only jpeg, jpg & png!!');
				}else{
					$('#validation_info').html('');
				}
			  },
              error:(response) => {
                console.log(response);
              },

        });
	})
	
	function IsJsonString(str) {
	    try {
	        JSON.parse(str);
	    } catch (e) {
	        return false;
	    }
	    return true;
	}
</script>

<script type="text/javascript">
	function stripe_payment(advertisements_id , price , amount , duration) {
        var success_url = '<?php echo base_url() . 'home/advertisement_stripe_payment' ?>';
        var cancel_url = '<?php echo base_url() . 'home' ?>';

        var _key = '<?php echo STRIPE_KEY; ?>';
        var stripe = Stripe(_key);
        

        // When the customer clicks on the button, redirect
        // them to Checkout.
        stripe.redirectToCheckout({
          lineItems: [{price: price, quantity: 1}],
          mode: 'subscription',
          successUrl: success_url+'/'+advertisements_id+'/'+amount+'/'+duration+'/{CHECKOUT_SESSION_ID}',
          cancelUrl: cancel_url,
        })
        .then(function (result) {
          if (result.error) {
            var displayError = document.getElementById('error-message');
            displayError.textContent = result.error.message;
          }
        });
    }
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