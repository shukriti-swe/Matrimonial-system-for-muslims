<section class="sct-color-1">
    <div class="container-fluid no-padding">
        <div class="row row-no-padding">
            <?php $slider_status = $this->db->get_where('frontend_settings', array('type' => 'slider_status'))->row()->value;
            $home_members_status = $this->db->get_where('frontend_settings', array('type' => 'home_members_status'))->row()->value;
            $home_parallax_status = $this->db->get_where('frontend_settings', array('type' => 'home_parallax_status'))->row()->value;
            $home_stories_status = $this->db->get_where('frontend_settings', array('type' => 'home_stories_status'))->row()->value;
            $home_plans_status = $this->db->get_where('frontend_settings', array('type' => 'home_plans_status'))->row()->value;
            $home_contact_status = $this->db->get_where('frontend_settings', array('type' => 'home_contact_status'))->row()->value;
            $slider_position = $this->db->get_where('frontend_settings', array('type' => 'slider_position'))->row()->value;
            if($slider_status=='yes'){
                $home_search_style = $this->db->get_where('frontend_settings', array('type' => 'home_search_style'))->row()->value;
                if ($home_search_style == '2') {
                    if($slider_position=='left'){
                        include_once 'slider_2.php';
                        include_once 'search.php';
                    } elseif($slider_position=='right'){
                        include_once 'search.php';
                        include_once 'slider_2.php';
                    }
                } elseif ($home_search_style == '1') {
                    include_once 'slider.php';
                }
            }
            ?>
        </div>
    </div>
</section>


<?php
    if($home_members_status=='yes'){
        include_once'premium_members.php';
    }?>
	<!--<hr style=" margin-top: 0rem !important;    margin-bottom: 0rem !important;    border-top: 2px solid #db4c7f;"  >-->
<?php
    if($home_parallax_status=='yes'){
        include_once'parallax.php';
    }?>

	<?php
  /*  if($home_stories_status=='yes'){
        include_once'happy_stories.php';
    }*/?>

	<?php
    if($home_plans_status=='yes'){
        include_once'packages.php';
    }?>

	<?php
    if($home_contact_status=='yes'){
        include_once'contact.php';
    }?>

<!-- advertisement start -->
								<div style="padding-left: 10%; padding-right: 10%;" class="bg-base-2">
								<div style="text-align: center;">
								   <b style="font-size: 1rem;">ADVERTISEMENTS</b>
								</div>
                                    <div class="row cols-xs-space cols-sm-space cols-md-space">                                   										
                                        <div class="col-md-2 col-lg-2  col-sm-6 col-6" style="text-align: left;line-height: 1;padding-left: 5px !important;padding-right: 5px !important;">
                                            <div class="col" style="padding-left: 2px !important;padding-right: 2px !important;">
												<h4 class="heading heading-xs strong-600 text-uppercase mb-1" style="color: #fff;">ZAYQA RESTAURANT</h4>
												<small style="line-height: 0.5rem;">29208, Orchard Lake Road,<br/>Farmington Hills, Mi 48334<br/>(248) 851-5557</small>											
                                            </div>
                                        </div>                                         
                                        <div class="col-md-2 col-lg-2  col-sm-6 col-6" style="text-align: left;line-height: 1;padding-left: 5px !important;padding-right: 5px !important;">
                                            <div class="col" style="padding-left: 2px !important;padding-right: 2px !important;">
                                                <h4 class="heading heading-xs strong-600 text-uppercase mb-1" style="color: #fff;">RABIA CLOTHES</h4>
												<small style="line-height: 0.5rem;">45270, Sedra Ct.<br/>Novi,Mi 48375<br/>(248) 435-8323</small>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-lg-2  col-sm-6 col-6" style="text-align: left;line-height: 1;padding-left: 5px !important;padding-right: 5px !important;">
                                            <div class="col" style="padding-left: 2px !important;padding-right: 2px !important;">
                                                <h4 class="heading heading-xs strong-600 text-uppercase mb-1" style="color: #fff;">UZMAS COLLECTION</h4>
												<small style="line-height: 0.5rem;">Clothes & Jewellery 3718<br/>Rochester Rd, Troy, MI 48083<br/>(248) 835-4864</small>
                                            </div>
                                        </div>
										<div class="col-md-2 col-lg-2  col-sm-6 col-6" style="text-align: left;line-height: 1;padding-left: 5px !important;padding-right: 5px !important;">
                                            <div class="col" style="padding-left: 2px !important;padding-right: 2px !important;">
												<h4 class="heading heading-xs strong-600 text-uppercase mb-1" style="color: #fff;">RAHATS CLOTHES</h4>
												<small style="line-height: 0.5rem;">49379 E. Central Park<br/>Shelby Twp, MI 48317<br/>(248) 219-3513</small>
                                            </div>
                                        </div> 
										<div class="col-md-2 col-lg-2  col-sm-6 col-6" style="text-align: left;line-height: 1;padding-left: 5px !important;padding-right: 5px !important;">
                                            <div class="col" style="padding-left: 2px !important;padding-right: 2px !important;">
												<h4 class="heading heading-xs strong-600 text-uppercase mb-1" style="color: #fff;">MERCY HOME HEALTH CARE</h4>
												<small style="line-height: 0.5rem;">1000 John R Road<br/>Ste # 206, Troy, MI 48083<br/>(248) 219-3513</small>
                                            </div>
                                        </div>    
										<div class="col-md-2 col-lg-2  col-sm-6 col-6" style="text-align: left;line-height: 1;padding-left: 5px !important;padding-right: 5px !important;">
                                            <div class="col" style="padding-left: 2px !important;padding-right: 2px !important;">
												<h4 class="heading heading-xs strong-600 text-uppercase mb-1" style="color: #fff;">OSTO & ASSOCIATED, INC</h4>
												<small style="line-height: 0.5rem;">3568 Nesting Ridge<br/>Rochester Hills, MI 48309<br/>(248) 219-3513</small>
                                            </div>
                                        </div>                                      
                                    </div>
                                </div>
<!-- advertisement end -->
<script src="<?=base_url()?>template/front/js/jquery.inputmask.bundle.min.js"></script>
<script>
    $(document).ready(function(){
    $(".height_mask").inputmask({
            mask: "9'99\"",
            greedy: false,
            definitions: {
                '*': {
                    validator: "[0-9]"
                }
            }
        });
    });
</script>
<script>
    $(document).ready(function(){
        $("#aged_from").change(function(){
            var from = parseInt($("#aged_from").val());
            var to = parseInt($("#aged_to").val());
            if (to < from) {
                var to = $("#aged_to").val(from);
            }
        });
        $("#aged_to").change(function(){
            var from = parseInt($("#aged_from").val());
            var to = parseInt($("#aged_to").val());
            if (to < from) {
                var to = $("#aged_to").val(from);
            }
        });
    });

     $(".s_religion").change(function(){
        var religion_id = $(".s_religion").val();
        if (religion_id == "") {
            $(".s_caste").html("<option value=''><?php echo translate('choose_a_religion_first')?></option>");
            $(".s_sub_caste").html("<option value=''><?php echo translate('choose_a_caste_first')?></option>");
        } else {
            $.ajax({
                url: "<?=base_url()?>home/get_dropdown_by_id_caste/caste/religion_id/"+religion_id, // form action url
                type: 'POST', // form submit method get/post
                dataType: 'html', // request type html/json/xml
                cache       : false,
                contentType : false,
                processData : false,
                success: function(data) {
                    $(".s_caste").html(data);
                    $(".s_sub_caste").html("<option value=''><?php echo translate('choose_a_caste_first')?></option>");
                },
                error: function(e) {
                    console.log(e)
                }
            });
        }
    });

    $(".s_caste").change(function(){
        var caste_id = $(".s_caste").val();
        if (caste_id == "") {
            $(".s_sub_caste").html("<option value=''><?php echo translate('choose_a_caste_first')?></option>");
        } else {
            $.ajax({
                url: "<?=base_url()?>home/get_dropdown_by_id_sub_caste/sub_caste/caste_id/"+caste_id, // form action url
                type: 'POST', // form submit method get/post
                dataType: 'html', // request type html/json/xml
                cache       : false,
                contentType : false,
                processData : false,
                success: function (data) {
                    if(data == false ){
                        $(".s_sub_caste").html("<option value=''><?php echo translate('none')?></option>");
                    } else {
                        $(".s_sub_caste").html(data);
                    };
               },
                error: function(e) {
                    console.log(e)
                }
            });
        }
    });
</script>
