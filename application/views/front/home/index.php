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

    <div style="padding: 20px 10%;" class="container-fluid bg-base-2">
        <div style="text-align: center;">
           <h4><b style="font-size: 1rem;">ADVERTISEMENTS</b></h4>
        </div>
		<div class="container" style="position:relative">
        <div class="row cols-xs-space cols-sm-space cols-md-space"> 
        <div class="col-md-2 col-lg-2  col-sm-12 col-12 text-center advertisement-click" style="padding: 0px">
             <a href="<?= base_url('/home/advertisement') ?>" class="btn btn-styled btn-xs btn-base-1 btn-shadow" style="font-size:16px !important;margin: 0px;font-weight: bold;">CLICK <br>to<br> ADVERTISE </a> 
         </div>
        <div class="swiper-js-container" style="width: 100%; margin-left:5%;">
            <div class="swiper-container" data-swiper-autoplay="true" data-swiper-items="5" data-swiper-space-between="20" data-swiper-md-items="2" data-swiper-md-space-between="20" data-swiper-sm-items="2" data-swiper-sm-space-between="20" data-swiper-xs-items="1" data-swiper-xs-space-between="0">
                <div class="swiper-wrapper pb-5" style="padding-bottom: 0px !important;">
                    <?php 
                    $today = date('Y-m-d');
                    $advertisements = $this->db->where('end_date >=',$today)->where('status', 0 )->or_where('status', 8 )->order_by('advertisements_id','ASC')->get("advertisements")->result();
					//echo '<pre>';
				//print_r($advertisements);
				//die();
                    foreach ($advertisements as  $value) { ?>                                   
                    <div class="swiper-slide" data-swiper-autoplay="2000" style="line-height:12px"> 
						<div style="height:60px;max-width:150px; background:<?php echo $value->color?>" align="center">
							<?php if ($value->company_logo != null): ?>
								<img style="max-height:60px;max-width:150px" src="<?=base_url()?>uploads/ads_logo/<?= ($value->company_logo)?$value->company_logo:"default_logo.png" ?>">
                            <?php endif ?>	
						</div>
                            <h4 class="heading heading-xs strong-600 text-uppercase mb-1" style="color: #fff;"><?= $value->title ?></h4>
                            <p style="line-height:1;font-size:12px;margin:0;width:82%;"><?= $value->address ?></p>
							<small style="line-height: 0.5rem;"><?= $value->city_state ?></small><br>
						    <small style="line-height: 0.5rem;"><?= $value->ads_phone ?></small><br>
							<small style="line-height: 0.5rem;"><?= $value->ads_email ?></small><br>
							
                            <?php if ($value->company_url != null): ?>
								<small style="line-height: 0.5rem;">Visit Company URL <a target="_blank" href="<?= $value->company_url ?>">Here</a></small>
                            <?php endif ?>
                    </div>
                    <?php } ?>                                      
                    </div>
                </div>
            </div>                  
        </div>
	</div>
    </div>
 <style>
@media only screen and (min-width: 1100px) {
  .advertisement-click {
    position: absolute;
    padding: 0px;
    left: -130px;
	width: 11%;
  }
}
</style>                            
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

    var member_id = "<?= $this->session->userdata('member_id') ?>";
    $(document).ready(function(){
        // if (member_id == "") {
        //     localStorage.removeItem("_r");
        // }
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
	
	
	
	var mySwiper = new Swiper('.swiper-js-container', {
      // Optional parameters
      direction: 'vertical',
      loop: true,


      // Navigation arrows
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },

    })
</script>
