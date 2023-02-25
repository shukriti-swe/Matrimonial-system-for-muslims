<style>


div#coverTitle {
  border-style: solid;
  border-color: #e91e63;
}
</style>

<div id="info_additional_personal_details">
    <div class="card-inner-title-wrapper pt-0">
        <h3 class="card-inner-title pull-left">
            <div id="coverTitle" > 
                <div style="margin: 10px" >
                    <center>
                     <h3>DISPLAY YOUR PHOTO ON THE COVER PAGE OF
         MATCH MADE IN JANNAH</h3> 
                    <p>PERSONAL PHOTO, ENGAGEMENT PHOTO, SPECIAL EVENT PHOTO</p>
                    </center>
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



<div class="table-full-width">

    <!-- <center>
        <?php if (isset($img)) { ?>
            <img src="<?= base_url("/uploads/home_slide/".$img ) ?>" width="50%" >
            <br>

        <?php if ($ads[0]->status == 0 ) { ?>
            <button class="btn btn-warning btn-sm" >Waiting for Admin Approval</button>
        <?php } ?>

        <?php if ($ads[0]->status == 1 ) { ?>
            <?php if (strtotime($ads[0]->end_date)  >= date("Y-m-d") ) { ?>
                
                 <button class="btn btn-success btn-sm" > Approve</button><br>
                 <?= date("F d" , strtotime($ads[0]->start_date) )." - ".date("F d , Y" , strtotime($ads[0]->end_date) )  ?>

            <?php } ?>

            <?php if (strtotime($ads[0]->end_date)  < date("Y-m-d") ) { ?>
                
                 <button class="btn btn-danger btn-sm" > Expired </button><br>
                 <?= date("F d , Y" , strtotime($ads[0]->end_date) )  ?>

            <?php } ?>

        <?php } ?>

        <?php } ?>

    </center> -->
    
        <div class="table-full-width">


            <table class="table table-xs table-profile table-striped table-bordered table-responsive-sm">
                    <tbody>

                        <tr>
                            <th> PACKAGE </th>
                            <th> DISPLAY DATE </th>
                            <th> PHOTO SHOWING </th>
                            <th> PAID  </th>
                            <th> PAYMENT TYPE </th>
                            <th> STATUS  </th>
                        </tr>

                        <?php foreach ($variable as $key => $value) { ?>
                        <tr>
                            <td class="td-label">
                                <span> <?= isset($value['name']) ? $value['name'] : ""; ?> </span>
                            </td>

                            <td class="td-label">
                                <?php  if ( !isset($value['member_plan_id']) && empty($value['member_plan_id']) ) { ?>
                                    
                                    <input type="text" id="datepicker_<?= $key; ?>" class="form-control" width="50%" placeholder="Choose Date" onchange="chng_date(this , '<?= $key ?>')" autocomplete="off">

                                    <small> <b>Choose A Date First To purchase Package</b>  </small>
                                <?php }  ?>
                                
                            </td>

                            <td class="td-label">

                                <?php  if ( isset($value['end_date']) && !empty($value['end_date']) ) { ?>
                                    <span> <?= isset($value['start_date']) && !empty($value['start_date']) ? date("F d" , strtotime($value['start_date']) )." - ".date("F d , Y" , strtotime($value['end_date']) ) : ""; ?>  </span>
                                <?php }  ?>

                                <?php  if ( !isset($value['member_plan_id']) && empty($value['member_plan_id']) ) { ?>
                                    <span> $<?= $value['amount']."/".$value['week']."wk" ?> </span>
                                <?php }  ?>
                                
                            </td>

                            <td class="td-label">
                                <span> <?= isset($value['payment_date']) && !empty($value['payment_date']) ? date("F d" , strtotime($value['payment_date']) ) : ""; ?></span>
                            </td>

                            <td class="td-label">
                                <span> <?= isset($value['payment_by']) && !empty($value['payment_by']) ? $value['payment_by'] : ""; ?> </span>
                            </td>

                            <td class="td-label">

                                <?php if (array_key_exists('end_date' , $value ) ) { ?>

                                    <?php if ( $value['end_date']  == null ) {   ?>
                                        <button class="btn btn-warning btn-sm" >Please upload a pic for Admin Approval</button>

                                            <i class="fa fa-upload" aria-hidden="true" onclick="upload_cover_pic()" title="UPLOAD" ></i>

                                            <div id="upload_cover_pic_show" style="display: none;" >

                                                <form action="<?= base_url('/home/sendCover_pic') ?>" method="POST" enctype="multipart/form-data" >

                                                    <input type="file" name="image" class="form-control imgInp" required id="Image_upload_cover">

                                                    <input type="hidden" name="plan_id" value="<?= $value['plan_id']; ?>">

                                                    <div class="panel-footer text-center">
                                                        <br>
                                                        <button type="submit" class="btn btn-primary btn-sm btn-labeled"><?php echo translate('Submit')?></button>
                                                    </div>
                                                    
                                                </form>
                                                
                                            </div>

                                 <?php break; }  ?>


                                    <?php if ( $value['end_date']  >= date("Y-m-d")  && $value['end_date'] != null ) { ?>

                                        <button class="btn btn-success btn-sm" >Approved</button> <p class="btn">Start Date : <span class="btn btn-sm btn-light"> <?= $value['start_date']; ?> </span> . Expire Date : <span class="btn btn-sm btn-info"><?= $value['end_date']; ?></span>   </p>  
                                    <?php break; }  ?>


                                    <?php if ( $value['end_date'] < date("Y-m-d") && $value['end_date'] != null ) {
                                        $expired_id[] = $value['plan_id'];
                                     ?>
                                        Expire Date : <span class="btn btn-sm btn-danger"><?= $value['end_date']; ?></span>   </p>  

                                        <div class="payment_button" style="display: none;">
                                            <form action="<?= $action; ?>" method="post">
                                                <input type="hidden" name="cmd" value="_xclick">
                                                <input type="hidden" name="business" value="<?= $paypalEmail_; ?>">
                                                <input type="hidden" name="item_name" value="PACKAGE">
                                                <input type="hidden" name="item_number" value="1">
                                                <input type="hidden" name="amount" value="<?= $value['amount'] ?>">
                                                <input type="hidden" name="no_shipping" value="0">
                                                <input type="hidden" name="no_note" value="1">
                                                <input type="hidden" name="currency_code" value="USD">
                                                <input type="hidden" id="custom_<?= $key ?>" name="custom" value="<?= $this->session->userdata('member_id'); ?>_<?= $value['plan_id']; ?>"> 

                                                <input type="hidden" name="cancel_return" value="<?= base_url()."home/paypal_cancel_cover_pic" ?>">
                                                <input type="hidden" name="return" value="<?= base_url()."home/paypal_success_cover_pic" ?>">
                                                <input type="hidden" name="notify_url" value="<?= base_url()."home/paypal_notify_cover_pic" ?>">

                                                <input type="image" style="max-width: 100px" src="<?= base_url('/') ?>template/front/images/paypal.jpg" border="0" name="submit" alt="PayPal - The safer, easier way to pay online." title="PayPal">
                                                <img alt="" border="0" src="<?= base_url('/') ?>template/front/images/paypal.jpg" width="1" height="1">

                                            </form>

                                            <a>
                                                <img style="max-width: 100px" src="<?= base_url('/') ?>template/front/images/stripe.jpg" onclick="stripe_payment('<?= $value['plan_id']; ?>' , '<?= $value['price_id'] ?>' , '<?= $value['amount']; ?>' )" >
                                            </a>

                                        </div>
                                        
                                    <?php  }  ?>
                                <?php }else{ ?>

                                    <div class="payment_button" style="display: none;">
                                        <form action="<?= $action; ?>" method="post">
                                            <input type="hidden" name="cmd" value="_xclick">
                                            <input type="hidden" name="business" value="<?= $paypalEmail_; ?>">
                                            <input type="hidden" name="item_name" value="PACKAGE">
                                            <input type="hidden" name="item_number" value="1">
                                            <input type="hidden" name="amount" value="<?= $value['amount'] ?>">
                                            <input type="hidden" name="no_shipping" value="0">
                                            <input type="hidden" name="no_note" value="1">
                                            <input type="hidden" name="currency_code" value="USD">
                                            <input type="hidden" id="custom_<?= $key ?>" name="custom" value="<?= $this->session->userdata('member_id'); ?>_<?= $value['plan_id']; ?>"> 

                                            <input type="hidden" name="cancel_return" value="<?= base_url()."home/paypal_cancel_cover_pic" ?>">
                                            <input type="hidden" name="return" value="<?= base_url()."home/paypal_success_cover_pic" ?>">
                                            <input type="hidden" name="notify_url" value="<?= base_url()."home/paypal_notify_cover_pic" ?>">

                                            <input type="image" style="max-width: 100px" src="<?= base_url('/') ?>template/front/images/paypal.jpg" border="0" name="submit" alt="PayPal - The safer, easier way to pay online." title="PayPal" >
                                            <img alt="" border="0" src="<?= base_url('/') ?>template/front/images/paypal.jpg" width="1" height="1">

                                        </form>

                                        <a>
                                            <img style="max-width: 100px" src="<?= base_url('/') ?>template/front/images/stripe.jpg" onclick="stripe_payment('<?= $value['plan_id']; ?>' , '<?= $value['price_id'] ?>' , '<?= $value['amount']; ?>' )" >
                                        </a>

                                    </div>

                                <?php } ?>
                            </td>
                        </tr>

                        <script>
                        $( function() {
                        $( "#datepicker_<?= $key; ?>" ).datepicker( { minDate: +1, maxDate: "+12M +10D" });
                        } );
                        </script>

                        <?php } ?>

                    </tbody>
            </table>

            <div id="error-message"></div>
        </div>
    </div>
</div>

<script type="text/javascript">

    var date_;

    function chng_date(argument , num) {

        date = argument.value;
        date_ = date;

        if (date =="" ) {
            $(".payment_button").hide();
        }else{
            $(".payment_button").show();
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
          mode: 'payment',
          successUrl: success_url+'/'+plan_id+'/'+amount+'/'+formatted_date,
          cancelUrl: cancel_url,
        })
        .then(function (result) {
          if (result.error) {
            var displayError = document.getElementById('error-message');
            displayError.textContent = result.error.message;
          }
        });
    }

    function upload_cover_pic() {
        $("#upload_cover_pic_show").show();
        $("#Image_upload_cover").click();
    }
    

</script>



