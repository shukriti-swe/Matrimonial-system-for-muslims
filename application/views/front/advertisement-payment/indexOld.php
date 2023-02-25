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

<section class="slice sct-color-1">
	<div class="card-title card-bg">
		<h3 class="heading heading-6">
		Advertisement Payment
		</h3>
	</div>
	<div class="container">
		<span class="clearfix"></span><br/><br/>
			<div class="panel-body" style="text-align: center; border-style: solid;border-color: #e91e63;">
				<div class="form-group">
					<?php
					 $id = $ads_details->advertisements_id;
					 $data = $this->db->where('advertisement_id',$id)->get('advertisements_payment')->row();

					 $today = date('Y-m-d');

					$this->db->select('advertisements.advertisements_id , advertisement_plans.duration , advertisement_plans.amount , advertisement_plans.stripe_prize_id ');
					$this->db->from('advertisements');
					$this->db->join('advertisement_plans', 'advertisement_plans.id = advertisements.advertisement_plans_id');
					$this->db->join('advertisements_payment', 'advertisements_payment.advertisement_id = advertisements.advertisements_id');
					$this->db->where('advertisements_payment.advertisement_id', $id );
					$result = $this->db->get()->result();

					 $payment_status = $data->payment_status;
					 if ($payment_status == 'Pending'): ?>
						<div class="card-bg fade show" role="alert" style="color: #ffffff;">
						  <strong>Your advertisement is submited. Please make your payment.</strong>.
						</div>

					<?php endif ?>
				</div>
				<div class="form-group">
					<span class="col-sm-8 control-label" for="demo-hor-inputemail"><b><?= translate('name_of_bunnisness') ?> :</b> <?= $ads_details->title?></span>
				</div>
				<div class="form-group">
					<span class="col-sm-8 control-label" for="demo-hor-inputemail"><b><?= translate('address') ?>:</b> <?= $ads_details->address?> </span>
				</div>
				<div class="form-group">
					<span class="col-sm-8 control-label" for="demo-hor-inputemail"><b><?= translate('phone') ?>:</b> <?= $ads_details->ads_phone?> </span>
				</div>
				<div class="form-group">
					<span class="col-sm-8 control-label" for="demo-hor-inputemail"><b><?= translate('plan') ?>:</b> <?= $ads_details->duration?> Month</span>
				</div>
				<div class="form-group">
					<span class="col-sm-8 control-label" for="demo-hor-inputemail"><b><?= translate('email') ?>: </b> <?= $ads_details->ads_email?></span>
				</div>
				<div class="form-group">
					<span class="col-sm-8 control-label" for="demo-hor-inputemail"><b><?= translate('start_date') ?>: </b> <?= $ads_details->start_date?></span>
				</div>
				<div class="form-group">
					<span class="col-sm-8 control-label" for="demo-hor-inputemail"><b><?= translate('end_date') ?>: </b> <?= $ads_details->end_date?></span>
				</div>

				<div class="form-group">
					<a href="<?=base_url()?>home/adsdetails/<?= $ads_details->unique_id?>" class="btn btn-styled btn-base-1 mt-4"><?php echo translate('ads_url') ?></a>
				</div>

				<?php if ($payment_status == 'Pending'): ?> 
				<div class="form-group">
					<div style="margin-left: 40%">
						<div class="" style="display: flex;">
			                <form action="<?= $action; ?>" method="post">
	                            <input type="hidden" name="cmd" value="_xclick-subscriptions">
	                            <input type="hidden" name="business" value="<?= $paypalEmail_; ?>">
	                            <input type="hidden" name="item_name" value="Advertisement <?= $result[0]->duration ?> month" id="item_name">
	                            <input type="hidden" name="item_number" value="1">
	                            <input type="hidden" name="no_shipping" value="0">
	                            <input type="hidden" name="no_note" value="1">
	                            <input type="hidden" name="currency_code" value="USD">
							    <input type="hidden" name="a3" value="<?= $result[0]->amount ?>">
							    <input type="hidden" name="p3" value="<?= $result[0]->duration ?>">
							    <input type="hidden" name="t3" value="M">

	                            <input type="hidden" id="custom" name="custom" value="advertisement_<?= $result[0]->advertisements_id ?>_<?= $result[0]->duration ?>"> 

	                            <input type="hidden" name="cancel_return" value="<?= base_url()."home/paypal_cancel_advertise" ?>">
			                    <input type="hidden" name="return" value="<?= base_url()."home/paypalAdvertisementSuccess/advertisement" ?>">

	                            <input type="image" name="submit" style="max-width: 100px"
							    src="<?= base_url('/') ?>template/front/images/paypal-subscribe.jpg"
							    alt="Subscribe" title="Paypal" >
							    <img alt="" width="1" height="1"
							    src="<?= base_url('/') ?>template/front/images/paypal-subscribe.jpg" >

	                        </form>

							<a>
								<img style="max-width: 100px" src="<?php echo base_url()?>template/front/images/stripe.jpg" onclick="stripe_payment('<?= $result[0]->advertisements_id ?>' , '<?= $result[0]->stripe_prize_id ?>' , '<?= $result[0]->amount ?>' , '<?= $result[0]->duration ?>' )" >
							</a>


						</div>
					</div>
			    </div>

				<?php endif ?>


			</div>
	</div>
</section>


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