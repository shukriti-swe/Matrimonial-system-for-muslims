<style>


div#coverTitle {
  border-style: solid;
  border-color: #e91e63;
}
</style>

<div id="info_additional_personal_details">
    <div class="card-title card-bg">
		<h4 class="heading heading-6 ">
			DISPLAY YOUR PHOTO ON THE COVER PAGE<br/> <p style="margin:0;">OF</p> MATCH MADE IN JANNAH
		</h4>
	</div>
							
    <div class="card-inner-title-wrapper pt-0">
        <h3 class="card-inner-title">
            <div id="" > 
                <div style="margin-top: 15px;text-align:center" >
                     
                                          <p>PERSONAL PHOTO, ENGAGEMENT PHOTO, SPECIAL EVENT PHOTO</p>

                   
                </div>
            </div>
        </h3>
    </div>
<?php  

$this->db->from('cover_pic_payment');
$this->db->join('cover_pic_plan', 'cover_pic_plan.plan_id = cover_pic_payment.member_plan_id');
$this->db->where('member_id' , $this->session->userdata('member_id') );
$this->db->order_by('cover_pic_payment_id', 'DESC');
$variable = $this->db->get()->result_array();

if (count($variable) == 0 ) {
    $variable = $this->db->get("cover_pic_plan")->result_array();
}else{
    $member_plan_id = array_column($variable, 'member_plan_id');
    $xxxxx = $this->db->get("cover_pic_plan")->result_array();
    $plan_id = array_column($xxxxx, 'plan_id');
    $result = array_diff($plan_id , $member_plan_id);

    if (count($result)) {
        $this->db->from('cover_pic_plan');
        $this->db->where_in('plan_id', $result);
        $rest = $this->db->get()->result_array();
        $final_res = array_merge($variable,$rest);
        $variable = $final_res;
    }
}


$check_paypal = $this->Crud_model->filter_one("business_settings" , "business_settings_id" , 4);
$paypalEmail = $this->Crud_model->filter_one("business_settings" , "business_settings_id" , 3);

$paypalEmail_ = $paypalEmail[0]['value'];
if ($check_paypal[0]['value'] == "sandbox" ) {
    $action = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
}else{

    $action = 'https://www.paypal.com/cgi-bin/webscr';
}

$ads = $this->db->where('member_id', $this->session->userdata('member_id'))->order_by("cover_pics_id" , 'DESC')->limit(1)->get('cover_pics')->result();

if ( count($ads) ) {
    $img = json_decode($ads[0]->image , true)[0]['image'];
}


?>

<div class="card-body">
	<section class="sct-color-1 pricing-plans pricing-plans--style-1">
		<div class="container">
			<div class="row p-2">
            <?php foreach ($variable as $key => $value) { ?>

			
				<div class="col-sm-6 m-0 p-0">
					<div class="card-title card-bg-c">
						<h6 class="heading heading-6">
							<?= isset($value['name']) ? strtoupper($value['name']) : ""; ?> 
						</h6>
					</div>

					<?php $show_button = 1; ?>

					<div class="single-prices">
						<div class="price-tags p-40">
							<!--<h2>Cost</h2>-->

							<?php  if ( isset($value['amount']) && !empty($value['amount']) ) { ?>
                <!--                    <h2> <?=currency('', 'def')?><?php echo $value['amount'] ?>-->
						          <!--<span>(USD)</span>  <span>per <?php echo $value['week'] ?> week </span> </h2>-->
                                    <h2><?php echo $value['week'] ?> week = <?=currency('', 'def')?><?php echo $value['amount'] ?></h2>
                            <?php }  ?>
                            
                            <?php if (array_key_exists('end_date' , $value ) ) { ?>
								<?php if ($value['end_date'] == null ) { ?>
									<?php
										$this->db->from('cover_pics');
								        $this->db->where('member_id', $this->session->userdata('member_id') );
								        $this->db->order_by("cover_pics_id" , "DESC");
								        $this->db->limit(1);
								        $pic_status = $this->db->get()->result_array();

								        if (count($pic_status)) {
								        	$img = json_decode($pic_status[0]['image'] , true )[0];
								        }
								        
									?>

									<?php if (isset($img)) { ?>
										<div class="">
											<h4> PACKAGE ACTIVATION IS WAITING </h4>
											<img src="<?= base_url('/uploads/home_slide/'.$img['image']) ?>" width="100%" style="width: 100% !important;height: 100% !important;">
										</div>
									<?php } ?>
									<div class="ss_upload_image">
									<i class="fa fa-upload" aria-hidden="true" onclick="upload_cover_pic()" title="UPLOAD" ></i>

									<div id="upload_cover_pic_show" style="display: none;" >
                                        <!--<form action="<?= base_url('/home/sendCover_pic') ?>" method="POST" enctype="multipart/form-data">-->
                                        <!--    <input type="file" name="image" class="form-control imgInp" required id="Image_upload_cover">-->
                                        <!--    <input type="hidden" name="plan_id" value="<?= $value['plan_id']; ?>">-->
                                        <!--    <div class="panel-footer text-center">-->
                                        <!--        <br>-->
                                        <!--        <button type="submit" class="btn btn-primary btn-sm btn-labeled"><?php echo translate('Submit')?></button>-->
                                        <!--    </div>-->
                                        <!--</form>-->
                                        <form  enctype="multipart/form-data" id="upload_cover_pic_image">

                                            <input type="file" name="image" class="form-control imgInp" required id="Image_upload_cover">
                                            <div id="Image_upload_cover_error" class="text-denger"></div>
                                            <input type="hidden" name="plan_id" value="<?= $value['plan_id']; ?>">
                                            <div class="panel-footer text-center">
                                                <br>
                                                <button type="submit" class="btn btn-primary btn-sm btn-labeled"><?php echo translate('Submit')?></button>
                                            </div>
                                        </form>
                                    </div>
                                    </div>
                                    <div id="size_error_message" class="text-denger"></div>
                                    <div class="text-denger">Image Must be 800*450 Pixel </div>
									
								<?php } ?>

								<?php if ( $value['end_date']  >= date("Y-m-d")  && $value['end_date'] != null ) { ?>
									<?php
										$this->db->from('cover_pics');
								        $this->db->where('member_id', $this->session->userdata('member_id') );
								        $this->db->order_by("cover_pics_id" , "DESC");
								        $this->db->limit(1);
								        $pic_status = $this->db->get()->result_array();
								        $img = json_decode($pic_status[0]['image'] , true )[0];
									?>
									<div class="">
										<h4> PACKAGE IS ACTIVATED </h4>
										<img src="<?= base_url('/uploads/home_slide/'.$img['image']) ?>" width="100% " style="width: 100% !important;height: 100% !important;" >
									</div>
								<?php } ?>


								<?php if ( $value['end_date']  < date("Y-m-d")  && $value['end_date'] != null ) { ?>
									<?php
										$this->db->from('cover_pics');
								        $this->db->where('member_id', $this->session->userdata('member_id') );
								        $this->db->order_by("cover_pics_id" , "DESC");
								        $this->db->limit(1);
								        $pic_status = $this->db->get()->result_array();
								        $img = json_decode($pic_status[0]['image'] , true )[0];
									?>
									<div class="price-items space-142">
										<h4> PACKAGE IS EXPIRED </h4>
									</div>
								<?php } ?>

						
							<?php } ?>
							
						</div>
                        <?php  if ( !isset($value['payment_date']) && empty($value['payment_date']) ) { ?>
						<div class="row">
							<div class="col-md-5">
								<label style="font-size:14px;">Choose Date</label>
							</div>
							<div class="col-md-7">
								<input type="text" id="datepicker_<?= $key; ?>" class="form-control" width="50%" placeholder="Choose Date" onchange="chng_date(this , '<?= $key ?>')" autocomplete="off">
							</div>
						</div>
						<?php }  ?>
						<div class="">	
						</div>


						<div class="price-footer pt-2">
							<h4>PACKAGE DETAILS</h4>

							<?php  if ( isset($value['end_date']) && !empty($value['end_date']) ) { ?>

							<div class="d-flex align-self-baseline">
								<div class="w-50">
									<h6>PHOTO SHOWING</h6>
								</div>
								<div class="w-50">
									<h6>
		                                <span> <?= isset($value['start_date']) && !empty($value['start_date']) ? date("F d" , strtotime($value['start_date']) )." - ".date("F d , Y" , strtotime($value['end_date']) ) : ""; ?>  </span>
									</h6>
								</div>
							</div>

							<?php }  ?>

							<?php  if ( isset($value['amount']) && !empty($value['amount']) ) { ?>
							<div class="d-flex ">
								<div class="w-50">
									<h6>PRICE</h6>
								</div>
								<div class="w-50">
									<h6>
		                               <span>(USD)</span>  <?php echo $value['amount'] ?>
									</h6>
								</div>
							</div>

							<?php }  ?>
							<div class="d-flex ">
								<div class="w-50">
									<h6>TIME PERIOD</h6>
								</div>
								<div class="w-50">
									<h6><?php echo $value['week'] ?> week</h6>
								</div>
							</div>
                            
							<?php  if ( isset($value['payment_date']) && !empty($value['payment_date']) ) { ?>
							<div class="d-flex ">
								<div class="w-50">
									<h6>PAID DATE</h6>
								</div>
								<div class="w-50">
									<h6><?php echo date("F d" , strtotime($value['payment_date']) ); ?> </h6>
								</div>
							</div>
							<?php }  ?>

							<?php  if ( isset($value['payment_by']) && !empty($value['payment_by']) ) { ?>

							<div class="d-flex ">
								<div class="w-50">
									<h6>PAYMENT TYPE</h6>
								</div>
								<div class="w-50">
									<h6><?php echo $value['payment_by']; ?> (recurring) </h6>
								</div>
							</div>
							<?php }  ?>

							<?php if (array_key_exists('end_date' , $value ) ) { ?>

								<?php if ( $value['end_date']  == null ) { $show_button = 0;  ?>
								<div class="d-flex ">
									<div class="w-50">
										<h6>Status</h6>
									</div>
									<div class="w-50">
										<h6> 
											<label class="text-success" >Please upload a pic for Admin Approval</label>

											<!--<i class="fa fa-upload" aria-hidden="true" onclick="upload_cover_pic()" title="UPLOAD" ></i>-->

											<!--<div id="upload_cover_pic_show" style="display: none;" >-->
           <!--                                     <form action="<?= base_url('/home/sendCover_pic') ?>" method="POST" enctype="multipart/form-data" >-->

           <!--                                         <input type="file" name="image" class="form-control imgInp" required id="Image_upload_cover">-->

           <!--                                         <input type="hidden" name="plan_id" value="<?= $value['plan_id']; ?>">-->

           <!--                                         <div class="panel-footer text-center">-->
           <!--                                             <br>-->
           <!--                                            <button type="submit" class="btn btn-primary btn-sm btn-labeled"><?php echo translate('Submit')?></button>-->
           <!--                                         </div>-->
           <!--                                     </form>-->
           <!--                                 </div>-->

									    </h6>
									</div>
								</div>
								<?php break; }  ?>



							<?php if ( $value['end_date']  >= date("Y-m-d")  && $value['end_date'] != null ) { $show_button = 0; ?>
								<div class="d-flex ">
									<div class="w-50">
										<h6><button class="btn btn-success btn-sm" >Approved</button></h6>
									</div>
									<div class="w-50">
										<h6> 
											 <?= isset($value['start_date']) && !empty($value['start_date']) ? date("F d" , strtotime($value['start_date']) )." - ".date("F d , Y" , strtotime($value['end_date'])) : ""; ?> 
									    </h6>
									</div>
								</div>
							<?php break; }  ?>

							<?php if ( $value['end_date']  < date("Y-m-d")  && $value['end_date'] != null ) {         $show_button = 1; ?>
								<div class="d-flex ">
									<div class="w-50">
										<h6><button class="btn btn-danger btn-sm" >Expired </button></h6>
									</div>
									<div class="w-50">
										<h6> 
											
										    <span class="btn btn-sm btn-danger"><?= date("F d , Y" , strtotime($value['end_date'])); ?></span> </p> 

									    </h6>
									</div>
								</div>
							<?php }  ?>

							<?php }  ?>

						</div>

						<?php if ($show_button == 1 ) { ?>
							<div class="price-footer p-36">
								<h4>SELECT PAYMENT PLAN</h4>

								<button type="submit" class="btn btn-styled btn-base-1 btn-md" onclick="myFunc('<?= $key ?>')">Get The Plan</button>
								<br>
								
								<div class="date_field_<?= $key ?>" style="display: none;" >
									<small> <b>Choose A Date First To purchase Package</b>  </small>
									<!--<input type="text" id="datepicker_<?= $key; ?>" class="form-control" width="50%" placeholder="Choose Date First To purchase" onchange="chng_date(this , '<?= $key ?>')" autocomplete="off">-->
								</div>
								<br>

								<div class="payment_button_<?= $key; ?>" style="display: none;">

									<div style="display: flex;margin-left: 78px;">
										<div>
		                                    
		                                    
		             <!--                       <form action="<?= $action; ?>" method="post">-->
			            <!--                        <input type="hidden" name="cmd" value="_xclick-subscriptions">-->
			            <!--                        <input type="hidden" name="business" value="<?= $paypalEmail_; ?>">-->
			            <!--                        <input type="hidden" name="item_name" value="<?= $value['name'] ?> PACKAGE" id="item_name">-->
			            <!--                        <input type="hidden" name="item_number" value="1">-->
			            <!--                        <input type="hidden" name="no_shipping" value="0">-->
			            <!--                        <input type="hidden" name="no_note" value="1">-->
			            <!--                        <input type="hidden" name="currency_code" value="USD">-->
			            <!--                        <input type="hidden" name="rm" value="2">-->

											    <!--<input type="hidden" name="a3" value="<?= $value['amount'] ?>">-->
											    <!--<input type="hidden" name="p3" value="<?= $value['week'] ?>">-->
											    <!--<input type="hidden" name="t3" value="W">-->

			            <!--                        <input type="hidden" id="custom_<?= $key ?>" name="custom" value="cover_<?= $this->session->userdata('member_id'); ?>_<?= $value['plan_id']; ?>"> -->

			            <!--                        <input type="hidden" name="cancel_return" value="<?= base_url()."home/paypal_cancel_cover_pic" ?>">-->
	              <!--                              <input type="hidden" name="return" value="<?= base_url()."home/paypal_success_cover_pic" ?>">-->

			            <!--                        <input type="image" name="submit" style="max-width: 100px"-->
											    <!--src="<?= base_url('/') ?>template/front/images/paypal-subscribe.jpg"-->
											    <!--alt="Subscribe" title="Paypal" >-->
											    <!--<img alt="" width="1" height="1"-->
											    <!--src="<?= base_url('/') ?>template/front/images/paypal-subscribe.jpg" >-->

			            <!--                    </form>-->


										</div>

										<div>
											<a>
		                                        <img style="max-width: 100px" src="<?= base_url('/') ?>template/front/images/stripe.jpg" onclick="stripe_payment('<?= $value['plan_id']; ?>' , '<?= $value['price_id'] ?>' , '<?= $value['amount']; ?>' )" >
		                                    </a>
		                                    
		                                    <a>
		                                        <img style="max-width: 100px" src="<?= base_url('/') ?>template/front/images/paypal-subscribe.jpg" onclick="paypal_payment('<?= $value['plan_id']; ?>' )" >
		                                    </a>
										</div>
									</div>

                                </div>

							</div>

						<?php } ?>

					</div>
				</div>

				<script>
                $( function() {
                $( "#datepicker_<?= $key; ?>" ).datepicker( { minDate: +1, maxDate: "+12M +10D" });
                } );
                </script>
			

             <?php } ?>
             </div>

		</div>
	</section>
</div>



<script type="text/javascript">

    var date_;

    function myFunc(num) {
    	$(".date_field_"+num+"").show();
    }

    function chng_date(argument , num) {

        date = argument.value;
        date_ = date;

        if (date =="" ) {
            $(".payment_button_"+num+"").hide();
        }else{
            $(".payment_button_"+num+"").show();
        }

        result = $("#custom_"+num+"").val();
        new_val = result+"_"+date;

        $("#custom_"+num+"").val(new_val)

    }

    function stripe_payment(plan_id , price , amount) {
        
        var success_url = '<?php echo base_url() . 'home/coverPic_stripe_payment' ?>';
        var cancel_url = '<?php echo base_url() . 'home/profile' ?>';

        var _key = '<?php echo STRIPE_KEY; ?>';
        var stripe = Stripe(_key);

        let current_datetime = new Date( date_ )
        let formatted_date = current_datetime.getDate() + "-" + (current_datetime.getMonth() + 1) + "-" + current_datetime.getFullYear()


        // When the customer clicks on the button, redirect
        // them to Checkout.
        stripe.redirectToCheckout({
          lineItems: [{price: price, quantity: 1}],
          mode: 'subscription',
          successUrl: success_url+'/'+plan_id+'/'+amount+'/'+formatted_date+'/{CHECKOUT_SESSION_ID}',
          cancelUrl: cancel_url,
        })
        .then(function (result) {
          if (result.error) {
            var displayError = document.getElementById('error-message');
            displayError.textContent = result.error.message;
          }
        });
    }
    
    function paypal_payment(plan_id) {
        $.ajax({
			type: "POST",
			url: "<?= base_url() ?>PaypalController/subscription_for_coverPicture",
			data: {
				plan_id:plan_id
			},
			success: function(response) {
			    window.location.href = response;
			}
		});
    }

    function upload_cover_pic() {
        $("#upload_cover_pic_show").show();
        $("#Image_upload_cover").click();
    }
    
    
    $('#upload_cover_pic_image').on('submit',function(e){
    	var  Image_upload_cover = $('#Image_upload_cover').val();
	    e.preventDefault();
	   // var data = $(this).serializeArray();
	    //console.log(data);
	    if (Image_upload_cover == '') {
            $('#Image_upload_cover_error').html('Please select your Image');
            return false;
        }else{
            $('#Image_upload_cover_error').html('');
        }
        $.ajax({
              url: '<?= base_url('/home/sendCover_pic') ?>',
              method:"POST",  
              data:new FormData(this),  
              contentType: false,  
              cache: false,  
              processData:false, 
              success:(response)=>{
                var data = JSON.parse(response);
                if (data.error) {
                    var error = data.error;
                    var html = '';
                    html+=`<div class="alert alert-success btn-outline alert-dismissible text-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> 
                            `+error+
                       `</div>`; 
                    $('#size_error_message').html(html);            
                }else{
                	location.reload();
                }

              },
              error:(response) => {
                console.log(response);
              },

        });
	})

</script>

<style>
    .price-footer h6{
        margin-top:5px;
    }
   .ss_upload_image {
        padding: 20px;
    border: 2px dashed #ccc;
    margin: 10px;
    }
    .ss_upload_image .fa-upload{
        font-size: 30px;
    color: #e91e63;
    }
    .ss_upload_image .btn-primary{
        background: #e91e63;
    border-color: #e91e63;
    }
    
</style>



