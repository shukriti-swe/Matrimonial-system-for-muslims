<style>
 .card-inner-title-wrapper-two {
    display: block;
    background: #efefef;
    text-align: center;
    /*padding: 10px;*/
    margin: -16px;
    overflow: hidden;
    margin-bottom: 20px;
    text-transform: uppercase;
    position: relative;
}

div#coverTitle {
  border-style: solid;
  border-color: #e91e63;
}
input[type=radio] {
    height: 18px;
    width: 18px;
    margin-top: 3px;
}
.ui-helper-clearfix.ui-corner-all{
    width:100%;
}
#error_date{
    position: relative;
    bottom: 15px;
    font-size: 13px;
    font-weight: bold;
}
#error_package{
    position: relative;
    bottom: 10px;
    font-size: 13px;
    font-weight: bold;
}
.after-payment-message{
    margin-top: 8px;
    margin-bottom: 5px;
    width: 98%;
    margin-left: 9px;
    padding: 8px;
}

</style>
<div id="info_additional_personal_details">
    <div class="card-title card-bg" >
        <h4 class="heading heading-6 check" style="margin:0;font-size: 20px !important;">
           MY COVER PAGE PHOTO<br/> <p style="margin:-8px;font-size: 11px;"> Display your photo on the Home Screen</p><p style="margin:-9px;font-size: 10px;"> No Refunds!</p>
        </h4>
    </div>
<?php  

$this->db->from('cover_pic_payment');
$this->db->join('cover_pic_plan', 'cover_pic_plan.plan_id = cover_pic_payment.member_plan_id');
$this->db->where('member_id' , $this->session->userdata('member_id') );
$this->db->where('expired',0);
$this->db->order_by('cover_pic_payment_id', 'DESC');
$variable = $this->db->get()->result_array();
$variable_for_count = $variable;

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
        $variable = $variable;
    }
}
// echo "<pre>";print_r($variable);

$check_paypal = $this->Crud_model->filter_one("business_settings" , "business_settings_id" , 4);
$paypalEmail = $this->Crud_model->filter_one("business_settings" , "business_settings_id" , 3);

$paypalEmail_ = $paypalEmail[0]['value'];
if ($check_paypal[0]['value'] == "sandbox" ) {
    $action = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
}else{

    $action = 'https://www.paypal.com/cgi-bin/webscr';
}

$ads = $this->db->where('member_id', $this->session->userdata('member_id'))->order_by("cover_pics_id" , 'DESC')->limit(1)->get('cover_pics')->result();
$rejectCheck = $this->db->where('member_id', $this->session->userdata('member_id'))->where('status',3)->order_by("cover_pics_id" , 'DESC')->limit(1)->get('cover_pics')->result();

if ( count($ads) ) {
    $img = json_decode($ads[0]->image , true)[0]['image'];
}

$display_member = $this->db->where('member_id',$this->session->userdata('member_id'))->get('member')->row('display_member');

?>

<div class="card-body">
    <section class="sct-color-1 pricing-plans pricing-plans--style-1">  
        <div class="container">
            <div class="row p-2" style="padding: 4px .5rem!important;">   
                <div class="col-sm-12 m-0 p-0">
                    <?php  if ( isset($variable_for_count) && count($variable_for_count) == 0 ) { ?>
                        <div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
                            <div id="info_basic_info">
                                <div class="card-inner-title-wrapper-two pt-0">
                                    <h3 class="card-inner-title" style="font-size:16px;">
                                        Choose Date
                                    </h3>
                                </div>
                                <div id="error_date" class="text-danger"></div>
                                <div style="min-height: 240px;">
                                    <div id="error_date" class="text-danger" style=""></div>
                                    <input type="hidden" name="selected_date" id="selected_date">
                                    <div id="datepicker" class="form-control" style="width:100%; height:auto; position: relative;bottom: 15px;border:none;padding: 0;" placeholder="Choose Date" onchange="chng_date(this)" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php }  ?>
                        <div class="row" style="margin: 0;">
                        <div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x <?= (isset($variable_for_count) && count($variable_for_count) == 0)? 'col-md-6':'col-md-12'; ?>">
                            <div id="info_basic_info">
                                <?php  if ( isset($variable_for_count) && count($variable_for_count) == 0 ) { ?>
                                <div class="card-inner-title-wrapper-two pt-0">
                                    <h3 class="card-inner-title" style="font-size:16px;">Choose Package</h3>
                                </div>
                                <?php } ?>
                               <div id="error_package" class="text-danger"></div>
                                <div class="row">
                                    <?php foreach ($variable as $key => $value) { ?>
                                        <?php $show_button = 1; ?>

                                        <?php  if ( isset($variable_for_count) && count($variable_for_count) == 0 ) { ?>

                                            <div class="col-md-6">
                                                <div class="form-check form-group">
                                                  <input class="form-check-input" type="radio" name="details" id="exampleRadios<?= $value['plan_id'] ?>" value="<?php echo $value['plan_id'] ?>" amount="<?php echo $value['amount'] ?>" price_id="<?php echo $value['price_id'] ?>" style="">
                                                  <label class="form-check-label" for="exampleRadios<?= $value['plan_id'] ?>" style="font-size: 14px; color: #383838; font-weight:bold;"><?php echo $value['week'] ?> Week = <?=currency('', 'def')?><?php echo $value['amount'] ?>
                                                  </label>
                                                </div>
                                            </div>
                                                
                                        <?php }else{ ?>
                                        <div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x col-md-12"  style="bottom: 17px">
                                        <div id="info_basic_info" style="padding-bottom: 10px">
                                            <div class="card-inner-title-wrapper-two pt-0">
                                                <h3 class="card-inner-title" style="font-size:16px;">Current Package</h3>
                                            </div>
                                            <div class="col-md-12" style="color: gray;background: #fff">
                                                <div class="row">
                                                    <div class="col-md-4" style="padding: 0">
                                                        Package: <?php echo $value['week'] ?> Week = <?=currency('', 'def')?><?php echo $value['amount'] ?>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="row">
                                                        Paid Date: <?php echo $value['payment_date'] ?>
                                                        </div>                
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="row">
                                                       Payment Type: <?php echo $value['payment_by'] ?>
                                                        </div>                
                                                    </div>
                                                </div>
                                            </div>
                                            <?php  if ( isset($value['end_date']) && !empty($value['end_date']) ) { ?>
                                                <div class="col-md-12" style="color: gray;background: #fff;padding: 0">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                           Photo Show: <?= isset($value['start_date']) && !empty($value['start_date']) ? date("F d" , strtotime($value['start_date']) )." - ".date("F d , Y" , strtotime($value['end_date']) ) : ""; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            </div>
                                        </div>
                                        <?php } ?>

                                        <!-- after payment -->

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
                            } ?>     
                            <div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x" style="width: 100%">
                                <div id="info_basic_info">
                                    <div class="card-inner-title-wrapper-two pt-0">
                                        <h3 class="card-inner-title" style="font-size:16px;">
                                            SCREEN PAGE INSTRUCTIONS 
                                        </h3>
                                    </div>
                                    <div style="color: gray" class="row">
                                        <div class="col-md-6" >
                                            <p style="font-size:13px;"><b><u>PHOTO</u></b></p>
                                            <p>
                                            •   Limit, one (1) photo ONLY! <br>
                                            •   Photo should be close-up, bright, clear, & recent.<br>
                                            •   Please allow 24hrs. for screening.<br>
                                            •   If Photo is rejected please upload another.   <br>
                                            •   Please check email for Invoice.<br>
                                            •   Photo Display starts once photo is approved.<br>
                                            •   Please Note: Photo will be viewed exactly as seen bellow!
                                            </p>   
                                        </div>
                                        <div class="col-md-6">
                                            <p style="font-size:13px;"><b><u> HOW TO CUSTOM SIZE YOUR PHOTO FOR FREE:</u></b></p>
                                            <p>
                                            •   Canva.com <br>
                                            •   Select: Custom dimensions<br>
                                            •   Width:  800<br>
                                            •   Height: 450 <br>
                                            •   Click: Uploads, Upload Media, Device<br>
                                            •   Select: Your Photo<br>
                                            •   Adjust: photo size to canvas<br>
                                            •   Click: Download & Save<br>

                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php } ?>                                   
                <?php } ?>
                                        <!-- cover pic -->

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
                                            
                                            <div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x col-md-12">
                                                <div id="info_basic_info">
                                                    <div class="card-inner-title-wrapper-two pt-0">
                                                        <h3 class="card-inner-title" style="font-size:16px;"><!-- PACKAGE ACTIVATION IS WAITING --> COVER PHOTO <span style="float: right;"></span></h3>
                                                    </div>
                                                    <?php if (isset($rejectCheck) && !empty($rejectCheck)): ?>
                                                        <p class="text-danger" style="font-weight: bold">Your image is rejected! please Upload new picture</p>
                                                    <?php endif ?>
                                                    <div style="text-align:center">
                                                        <div style="width: 100%;text-align: right;color: #000;font-weight: 600;font-size:16px;">
                                                            <span><?=$display_member?></span>
                                                        </div>
                                                        <img src="<?= base_url('/uploads/home_slide/'.$img['image']) ?>" style="width: 100% !important;">
                                                        <b><u>PLEASE NOTE: PHOTO WILL BE VIEWED EXACTLY AS SEEN HERE! </u></b>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php } ?>
                                            <div class="ss_upload_image">
                                            <i class="fa fa-upload" aria-hidden="true" onclick="upload_cover_pic()" title="UPLOAD" ></i>Upload Photo

                                            <div id="upload_cover_pic_show" style="display: none;" >
                                                <form  enctype="multipart/form-data" id="upload_cover_pic_image">

                                                    <input type="file" name="image" class="form-control imgInp" required id="Image_upload_cover" style="height: 40px;margin-bottom: 3px">
                                                    <div id="Image_upload_cover_error" class="text-denger"></div>
                                                    <input type="hidden" name="plan_id" value="<?= $value['plan_id']; ?>">
                                                    <div class="panel-footer text-center">
                                                        <button type="submit" class="btn btn-primary btn-sm btn-labeled"><?php echo translate('Submit')?></button>
                                                    </div>
                                                </form>

                                            </div>
                                            </div>
                                            <div id="size_error_message" class="text-denger"></div>
                                            <div class="text-denger" style="margin-left:10px;">Photo Size 800x450 works best! </div>
                                            
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
                                            <div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x col-md-12">
                                                <div id="info_basic_info">
                                                    <div class="card-inner-title-wrapper-two pt-0">
                                                       <h3 class="card-inner-title" style="font-size:16px;"> PACKAGE IS ACTIVATED </h3>
                                                    </div>
                                                    <div>
                                                        <img src="<?= base_url('/uploads/home_slide/'.$img['image']) ?>" width="100% " style="width: 100% !important;" >
                                                    </div>
                                                </div>
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
                                                $date = date('Y-m-d');
                                                $d = date("Y-m-d", strtotime('-1 days'));
                                                if ($value['end_date'] < $d) {
                                                    $this->db->where('cover_pic_payment_id',$value['cover_pic_payment_id'])->update('cover_pic_payment',['expired'=> 1]);
                                                }
                                            ?>
                                            <div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x col-md-12">
                                                <div id="info_basic_info">
                                                    <div class="card-inner-title-wrapper-two pt-0">
                                                        <h3 class="card-inner-title" style="font-size:16px;"> PACKAGE IS EXPIRED </h3>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    <?php } ?>

                                    <!-- after payments -->

                                <?php } ?>
                                </div>
                            </div>
                        </div>
                        <?php  if ( isset($variable_for_count) && count($variable_for_count) == 0 ) { ?>
                        <div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x col-md-6">
                            <div id="info_basic_info">
                                <div class="card-inner-title-wrapper-two pt-0">
                                    <h3 class="card-inner-title" style="font-size:16px;">
                                        Choose Payment Type
                                    </h3>
                                </div>
                                <div>
                                    <div style="text-align:center;position: relative;bottom: 15px;">
                                        <a>
                                            <img style="max-width: 80px" src="<?= base_url('/') ?>template/front/images/stripe.jpg" onclick="stripe_payment()" >
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php }  ?>
                    </div>
                </div>

                <script>
                $( function() {
                    $( "#datepicker" ).datepicker( { minDate: +1, maxDate: "+12M +10D" });
                } );
                </script>
             </div>

        </div>
    </section>
</div>



<script type="text/javascript">


    var date_;

    function myFunc(num) {
        $(".date_field_"+num+"").show();
    }

   function chng_date(argument ) {

        date = argument.value;
        $("#selected_date").val(date)
        date_ = date;

        // if (date =="" ) {
        //     $(".payment_button_"+num+"").hide();
        // }else{
        //     $(".payment_button_"+num+"").show();
        // }

        // result = $("#custom_"+num+"").val();
        // new_val = result+"_"+date;

        // $("#custom_"+num+"").val(new_val)

    }


    function stripe_payment() {
        var length = $('input[name="details"]:checked').length;
        var plan_id = $('input[name="details"]:checked').val();
        var amount = $('input[name="details"]:checked').attr('amount');
        var price = $('input[name="details"]:checked').attr('price_id');
        var date = $("#selected_date").val();
        if (length == 0) {
            $('#error_package').html('Please Choose Your Package');
            return false;
        }else{
            $('#error_package').html('');
        }
        if (date == '') {
            $('#error_date').html('Please Choose your date');
            return false;
        }else{
            $('#error_date').html('');
        }
        var success_url = '<?php echo base_url() . 'home/coverPic_stripe_payment' ?>';
        var cancel_url = '<?php echo base_url() . 'home/profile' ?>';

        var _key = '<?php echo STRIPE_KEY; ?>';
        var stripe = Stripe(_key);

        let current_datetime = new Date(date)
        let formatted_date = current_datetime.getDate() + "-" + (current_datetime.getMonth() + 1) + "-" + current_datetime.getFullYear()

        // When the customer clicks on the button, redirect
        // them to Checkout.
        stripe.redirectToCheckout({
          lineItems: [{price: price, quantity: 1}],
          mode: 'payment',
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
                    //location.reload();
					window.location.href = "<?=base_url("/home/profile?thanks=2")?>";
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
        width: 100%;
       text-align:center;
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



