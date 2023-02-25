<section class="slice sct-color-1" style="padding-bottom: 0rem !important;padding-top:  0.5rem !important;">
    <div class="container">
        <div class="section-title section-title--style-1 text-center" style="margin-bottom: 0rem !important;">
            <h3 class="section-title-inner">
            <span><b>PREMIUM MEMBERS</b></span>
            </h3>
        
        </div>

        <div class="swiper-js-container">
            <div class="swiper-container" data-swiper-autoplay="true" data-swiper-items="4" data-swiper-space-between="20" data-swiper-md-items="3" data-swiper-md-space-between="20" data-swiper-sm-items="2" data-swiper-sm-space-between="20" data-swiper-xs-items="1" data-swiper-xs-space-between="0">
                <div class="swiper-wrapper pb-5" style="padding-bottom: 0px !important;">
                    <?php foreach ($premium_members as $premium_member): ?>
					<?php 
						$basic_info = $this->Crud_model->get_type_name_by_id('member', $premium_member->member_id, 'basic_info');
						$basic_info_data = json_decode($basic_info, true);
						
					?>
                        <div class="swiper-slide" data-swiper-autoplay="2000">
                            <div class="block block--style-5">
                                <div class="card card-hover--animation-1 z-depth-1-top z-depth-2--hover home-p-member" >
								 <h3 class="heading heading-5 premium_heading" style="TEXT-ALIGN: center;"><?=$premium_member->display_member?></h3>
                                    <div class="profile-picture profile-picture--style-2">
<center>
                                        <?php
                                        $image = json_decode($premium_member->profile_image, true);
                                            if (file_exists('uploads/profile_image/'.$image[0]['thumb'])) {
                                            ?>
                                            <?php
                                                $pic_privacy = $premium_member->pic_privacy;
                                                $pic_privacy_data = json_decode($pic_privacy, true);
                                                $is_premium = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata('member_id'), 'membership');
                                                if($pic_privacy_data[0]['profile_pic_show']=='only_me'){
                                                    if($premium_member->member_id != $this->session->userdata('member_id')){

                                            ?>
                                                <div class="home_pm" style="background-image: url(<?=base_url()?>uploads/profile_image/default.jpg"></div>
                                            <?php }else{ ?>
                                                <div class="home_pm" style="background-image: url(<?=base_url()?>uploads/profile_image/<?=$image[0]['thumb']?>)">
                                                </div>
                                                <?php } }elseif ($pic_privacy_data[0]['profile_pic_show']=='premium' and $is_premium==2) {
                                                ?>
                                                    <div class="home_pm" style="background-image: url(<?=base_url()?>uploads/profile_image/<?=$image[0]['thumb']?>)"></div>
                                                <?php }elseif ($pic_privacy_data[0]['profile_pic_show']=='premium' and $is_premium==1) {
                                                ?>
                                                    <div class="home_pm" style="background-image: url(<?=base_url()?>uploads/profile_image/default.jpg"></div>
                                                <?php }elseif ($pic_privacy_data[0]['profile_pic_show']=='all') {
                                                ?>
                                                <div class="home_pm" style="background-image: url(<?=base_url()?>uploads/profile_image/<?=$image[0]['thumb']?>)"></div>
                                            <?php }else{ ?>
                                                <div class="home_pm" style="background-image: url(<?=base_url()?>uploads/profile_image/default.jpg"></div>
                                            <?php }
                                            }
                                            else {
                                            ?>
                                                <div class="home_pm" style="background-image: url('<?=base_url()?>uploads/profile_image/default.jpg"></div>
                                            <?php
                                            }
                                        ?>
                                        <!-- <img src="<?=base_url()?>template/front/uploads/profile_image/"> -->
</center>                                    
</div>
                                    <div class="card-body text-center">
                                       
										<div style="font-size: 13px;TEXT-ALIGN: left;">
                                        <span class=""><b>Age:</b> <?php  $calculated_age = (date('Y') - date('Y', $premium_member->date_of_birth));   echo $calculated_age;  ?></span><br
                                        <span class=""><b>State:</b>  <?php echo $this->Crud_model->get_type_name_by_id('country', $basic_info_data[0]['grew_up'])?></span><br/>
										<span class=""><b>Profession:</b>  <?php echo $this->Crud_model->get_type_name_by_id('profession', $basic_info_data[0]['profession'])?></span><br/>
                                        <!-- <h3 class="heading heading-light heading-sm strong-300">CEO of Webpixels</h3> -->
                                        </div>
                                        <?php if($premium_member->member_id == $this->session->userdata('member_id')){ ?>
                                            <a href="<?=base_url()?>home/profile" class="btn btn-styled btn-xs btn-base-1 z-depth-2-bottom mt-2 text-white"><?=translate('full_profile')?></a>
                                        <?php } else { ?>
                                            <a class="btn btn-styled btn-xs btn-base-1 z-depth-2-bottom mt-2 text-white" onclick="return goto_profile(<?=$premium_member->member_id?>)"><?=translate('full_profile')?></a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
                <!-- Add Pagination 
                <div class="swiper-pagination">
                </div>-->
            </div>
        </div>
    </div>
</section>
<script>
    var isloggedin = "<?=$this->session->userdata('member_id')?>";

    $(document).ready(function() {
        setTimeout(function() {
            set_premium_member_box_height();
        }, 1000);
    });

    function set_premium_member_box_height() {
        var max_title = 0;
        $('.swiper-slide .premium_heading').each(function() {
            var current_height = parseInt($(this).css('height'));
            if (current_height >= max_title) {
                max_title = current_height;
            }
        });
        $('.swiper-slide .premium_heading').css('height', max_title);
    }

    function goto_profile(id) {
        // alert(id);
        if (isloggedin == "") {
            $("#active_modal").modal("toggle");
            $("#modal_header").html("LOGIN OR REGISTER");
            $("#modal_body").html("<p class='text-center'>To<br/>View full Profile</p>");
            $("#modal_buttons").html("<a href='<?=base_url()?>home/login' class='btn btn-sm btn-base-1 btn-shadow' style='width:25%'><?=translate('login')?></a><a href='<?=base_url()?>home/registration' class='btn btn-sm btn-base-1 btn-shadow' style='width:25%; margin-left:20px;'>Registration</a>");
        }
        else {
            window.location.href = "<?=base_url()?>home/member_profile/"+id;
        }
    }
</script>