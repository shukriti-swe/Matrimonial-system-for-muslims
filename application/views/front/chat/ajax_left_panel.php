<?php

$basic_info = $this->Crud_model->get_type_name_by_id('member', $get_member[0]->member_id, 'basic_info');
$basic_info_data = json_decode($basic_info, true);

$present_address = $this->Crud_model->get_type_name_by_id('member', $get_member[0]->member_id, 'present_address');
$present_address_data = json_decode($present_address, true);

$education_and_career = $this->Crud_model->get_type_name_by_id('member', $get_member[0]->member_id, 'education_and_career');
$education_and_career_data = json_decode($education_and_career, true);

$physical_attributes = $this->Crud_model->get_type_name_by_id('member', $get_member[0]->member_id, 'physical_attributes');
$physical_attributes_data = json_decode($physical_attributes, true);

$language = $this->Crud_model->get_type_name_by_id('member', $get_member[0]->member_id, 'language');
$language_data = json_decode($language, true);

$hobbies_and_interest = $this->Crud_model->get_type_name_by_id('member', $get_member[0]->member_id, 'hobbies_and_interest');
$hobbies_and_interest_data = json_decode($hobbies_and_interest, true);

$personal_attitude_and_behavior = $this->Crud_model->get_type_name_by_id('member', $get_member[0]->member_id, 'personal_attitude_and_behavior');
$personal_attitude_and_behavior_data = json_decode($personal_attitude_and_behavior, true);

$residency_information = $this->Crud_model->get_type_name_by_id('member', $get_member[0]->member_id, 'residency_information');
$residency_information_data = json_decode($residency_information, true);

$spiritual_and_social_background = $this->Crud_model->get_type_name_by_id('member', $get_member[0]->member_id, 'spiritual_and_social_background');
$spiritual_and_social_background_data = json_decode($spiritual_and_social_background, true);

$life_style = $this->Crud_model->get_type_name_by_id('member', $get_member[0]->member_id, 'life_style');
$life_style_data = json_decode($life_style, true);

$astronomic_information = $this->Crud_model->get_type_name_by_id('member', $get_member[0]->member_id, 'astronomic_information');
$astronomic_information_data = json_decode($astronomic_information, true);

$permanent_address = $this->Crud_model->get_type_name_by_id('member', $get_member[0]->member_id, 'permanent_address');
$permanent_address_data = json_decode($permanent_address, true);

$family_info = $this->Crud_model->get_type_name_by_id('member', $get_member[0]->member_id, 'family_info');
$family_info_data = json_decode($family_info, true);

$additional_personal_details = $this->Crud_model->get_type_name_by_id('member', $get_member[0]->member_id, 'additional_personal_details');
$additional_personal_details_data = json_decode($additional_personal_details, true);

$partner_expectation = $this->Crud_model->get_type_name_by_id('member', $get_member[0]->member_id, 'partner_expectation');
$partner_expectation_data = json_decode($partner_expectation, true);

$privacy_status = $this->Crud_model->get_type_name_by_id('member', $get_member[0]->member_id, 'privacy_status');
$privacy_status_data = json_decode($privacy_status, true);

?>
<style>.lg-outer #lg-download {display: none!important;}</style>
<?php $has_video = 0; ?>

    <div class="sidebar-object mb-0">
        <!-- Profile picture -->
        <div id="container">
            <div class="row">
                <div class="col-md-3">
                    <?php if($get_member[0]->isOnline != 0 && $get_member[0]->isOnline > strtotime(date('Y-m-d H:i:s')) ){ ?>
                        <span class="online"> Online </span>
                    <?php }else{ ?>
                        <span class="offline">Offline</span>
                    <?php } ?>
                </div>
                <div class="col-md-4"></div>
                <div class="col-md-5">
                    <div class="col-sm-12 size-sm">


                        <a class="btn btn-styled btn-block btn-sm btn-white z-depth-2-bottom" id="ignore_a_<?=$get_member[0]->member_id?>" onclick="return confirm_ignore(<?=$get_member[0]->member_id?>)"><i class="fa fa-ban"></i> Block</a>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="my_class" id="member_id" style="display:block;text-align:center;"> <?= $get_member[0]->display_member;?></div>
            </div>
            <div class="profile-picture profile-picture--style-2" id="dp">
                <?php
                $profile_image = $get_member[0]->profile_image;
                $images = json_decode($profile_image, true);
                if (file_exists('uploads/profile_image/'.$images[0]['thumb'])) {
                    $pic_privacy = $get_member[0]->pic_privacy;
                    $pic_privacy_data = json_decode($pic_privacy, true);
                    $is_premium = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata('member_id'), 'membership');
                    if($pic_privacy_data[0]['profile_pic_show']=='only_me'){
                        ?>
                        <div style="border: 10px solid rgba(255, 255, 255, 0.1);width: 200px;border-radius: 50%;margin-top: 10px;">
                            <div class="profile_img" id="show_img" style="background-image: url(<?=base_url()?>uploads/profile_image/default.jpg)"></div>
                        </div>
                    <?php }elseif ($pic_privacy_data[0]['profile_pic_show']=='premium' and $is_premium==2) {
                        ?>
                        <div style="border: 10px solid rgba(255, 255, 255, 0.1);width: 200px;border-radius: 50%;margin-top: 10px;">
                            <div class="profile_img" id="show_img" style="background-image: url(<?=base_url()?>uploads/profile_image/<?=$images[0]['thumb']?>)"></div>
                        </div>
                    <?php }elseif ($pic_privacy_data[0]['profile_pic_show']=='premium' and $is_premium==1) {
                        ?>
                        <div style="border: 10px solid rgba(255, 255, 255, 0.1);width: 200px;border-radius: 50%;margin-top: 10px;">
                            <div class="profile_img" id="show_img" style="background-image: url(<?=base_url()?>uploads/profile_image/default.jpg)"></div>
                        </div>
                    <?php }elseif ($pic_privacy_data[0]['profile_pic_show']=='all') {
                        ?>
                        <div style="border: 10px solid rgba(255, 255, 255, 0.1);width: 200px;border-radius: 50%;margin-top: 10px;">
                            <div class="profile_img" id="show_img" style="background-image: url(<?=base_url()?>uploads/profile_image/<?=$images[0]['thumb']?>)"></div>
                        </div>
                    <?php }else{
                        ?>
                        <div style="border: 10px solid rgba(255, 255, 255, 0.1);width: 200px;border-radius: 50%;margin-top: 10px;">
                            <div class="profile_img" id="show_img" style="background-image: url(<?=base_url()?>uploads/profile_image/default.jpg)"></div>
                        </div>
                    <?php }
                } else {
                    ?>
                    <div style="border: 10px solid rgba(255, 255, 255, 0.1);width: 200px;border-radius: 50%;margin-top: 10px;">
                        <div class="profile_img" id="show_img" style="background-image: url(<?=base_url()?>uploads/profile_image/default_image.png)"></div>
                    </div>
                    <?php
                }
                ?>
            </div>


            <!-- Profile connected accounts -->
            <div class="profile-useful-links clearfix mb-5">
                <div class="profile-details">
                    <h3 class="heading text-uppercase heading-6 strong-400 profile-occupation mt-3"><?=translate( 'Gallery')?></h3>
                </div>
                <?php
                $get_gallery = $this->db->get_where("member", array("member_id" => $get_member[0]->member_id))->row()->gallery;
                $gallery_data = json_decode($get_gallery, true);
                if (!empty($gallery_data)) {
                    $is_premium = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata('member_id'), 'membership');
                    $pic_privacy = $get_member[0]->pic_privacy;
                    $pic_privacy_data = json_decode($pic_privacy, true);
                    $is_premium = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata('member_id'), 'membership');

                    ?>
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div id="gallery" class="light-gallery">
                                    <div class="row">
                                        <?php
                                        foreach ($gallery_data as $value) {
                                            if (file_exists('uploads/gallery_image/'.$value['image']) && strlen($value['image']) > 0) {
                                                ?>
                                          <div class="col-sm-4 col-xs-12 mt-2">
                                                    <a target="_blank" href="<?=base_url()?>uploads/gallery_image/<?=$value['image']?>" class="item">
                                                        <img src="<?=base_url()?>uploads/gallery_image/<?=$value['image']?>" class="img-fluid rounded" style="height: 68px;">
                                                    </a>
                                                </div>
                                                <?php
                                            } else if (file_exists('video/'.$value['video']) && strlen($value['video']) > 0)
                                            {
                                                $has_video = 1;
                                                ?>
                                                 <div class="col-sm-12 col-xs-12 mt-4">
                                                    <video width="200" height="100" controls>

                                                        <source src="<?php echo base_url()."video/".$value['video'] ?>">
                                                        Your browser does not support the video tag.
                                                    </video>
                                                </div>

                                                <?php

                                            }else {
                                                ?>
                                                <div class="col-sm-4 mt-4">
                                                    <a target="_blank" href="<?=base_url()?>uploads/gallery_image/default_image.png" class="item">
                                                        <img src="<?=base_url()?>uploads/gallery_image/default_image.png" class="img-fluid rounded" style="height: 68px;">
                                                    </a>
                                                </div>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                }
                ?>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="videoModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="videoModalLabel">Video</h4>
                        </div>
                        <div class="modal-body">
                            <video controls id="video1" style="width: 100%; height: auto; margin:0 auto; frameborder:0;">
                                <source src="http://[::1]/application/video/7908654190331.mp4" type="video/mp4">
                                Your browser doesn't support HTML5 video tag.
                            </video>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Profile connect -->
        <?php if($this->db->get_where("member", array("member_id" => $this->session->userdata('member_id')))->row()->is_closed == 'no'){ ?>
            <div class="profile-connect mt-2">
                <div class="row" >
                    <div class="col-sm-12 size-sm">
                        <?php
                        $interests = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata('member_id'), 'interest');
                        $interest = json_decode($interests, true);
                        if (!empty($this->session->userdata('member_id'))) {
                            if (in_assoc_array($get_member[0]->member_id, 'id', $interest)) {
                                $interest_onclick = 0;
                                $interest_text = translate('interest_expressed');
                                $interest_class = "btn btn-styled btn-block btn-sm btn-white z-depth-2-bottom li_active";
                            }
                            else {
                                $interest_onclick = 1;
                                // $interest_text = translate('express_interest');
                                $interest_text = 'I Like You';
                                $interest_class = "btn btn-styled btn-block btn-sm btn-white z-depth-2-bottom";
                            }
                        }
                        else {
                            $interest_onclick = 1;
                            $interest_text = translate('express_interest');
                            $interest_class = "btn btn-styled btn-block btn-sm btn-white z-depth-2-bottom";
                        }
                        ?>
                        <!-- <a class="<?=$interest_class?>" id="interest_a_<?=$get_member[0]->member_id?>" <?php if ($interest_onclick == 1){?>onclick="return confirm_interest(<?=$get_member[0]->member_id?>)"<?php }?>>
                        <span id="interest_text">
                            <i class="fa fa-heart"></i> <?=$interest_text?>
                        </span>
                    </a> -->
                    </div>
                </div>

                <div class="row" style="margin-top: 4px;">
                    <div class="col-sm-12 size-sm">
                        <?php
                        $if_message = $this->db->get_where('message_thread', array('message_thread_from' => $get_member[0]->member_id, 'message_thread_to' => $this->session->userdata('member_id')))->row();
                        if (!$if_message) {
                            $if_message  = $this->db->get_where('message_thread', array('message_thread_from' => $this->session->userdata('member_id'), 'message_thread_to' => $get_member[0]->member_id))->row();

                        }
                        if ($if_message) {
                            $message_onclick = 0;
                            $message_text = 'Send Message';
                            $message_class = "btn btn-styled btn-block btn-sm btn-white z-depth-2-bottom ";
                        }
                        else {
                            $message_onclick = 1;
                            // $message_text = translate('enable_messaging');
                            $message_text = 'Send Message';
                            $message_class = "btn btn-styled btn-block btn-sm btn-white z-depth-2-bottom";
                        }

                        ?>

                        <!-- <a class="<?=$message_class?>" id="message_a_<?=$get_member[0]->member_id?>" <?php if ($message_onclick == 1){	?>onclick="return confirm_message(	<?=$get_member[0]->member_id?>)"<?php 	} elseif ($message_onclick == 0){		?>onclick="profile_load('messaging',<?php echo $if_message->message_thread_id?>);"<?php	}	?>>
                        <i class="fa fa-comments-o"></i> <?=$message_text?>
                    </a> -->
                    </div>

                </div>

                <div class="row" id="showVideo" style="margin-top: 4px;">
                    <div class="col-sm-12 size-sm">

                        <a class="<?=$interest_class?>" data-toggle="modal" data-target="#videoModal">
                        <span id="">
                            <i class="fa "></i> Show Video
                        </span>
                        </a>
                    </div>
                </div>

                <!-- <div class="row" style="margin-top: 4px;">
                <div class="col-sm-12 size-sm">


                    <a class="btn btn-styled btn-block btn-sm btn-white z-depth-2-bottom" id="ignore_a_<?=$get_member[0]->member_id?>" onclick="return confirm_ignore(<?=$get_member[0]->member_id?>)"><i class="fa fa-ban"></i> Block</a>
                </div>
            </div> -->
            </div>
        <?php } ?>
        <!-- <div class="profile-stats clearfix mt-2">
            <div class="stats-entry" style="width: 100%">
                <span class="stats-count" id="follower"><?=$get_member[0]->follower?></span>
                <span class="stats-label text-uppercase"><?php echo translate('followers');?></span>
            </div>
        </div> -->
        <!-- Profile stats -->
        <div class="profile-stats clearfix mt-2">
            <div class="stats-entry">
                <span class="stats-label text-uppercase text-left pl-2"><?php echo translate('age');?></span>
                <span class="stats-label text-uppercase text-left pl-2">PROFESSION</span>
                <span class="stats-label text-uppercase text-left pl-2">RESIDENCE</span>
                <span class="stats-label text-uppercase text-left pl-2">SECT</span>
            </div>

            <?php
            $sql ="SELECT sortname FROM country WHERE country_id =".$basic_info_data[0]['residence'];$query = $this->db->query($sql);
            if ($query->num_rows() > 0) { foreach ($query->result() as $row) {?> <?php  $countryCode = strtolower($row->sortname); ?>  <?php }  } ?>

            <div class="stats-entry">
                <span class="stats-label text-uppercase text-left pl-2"> <?=$calculated_age = (date('Y') - date('Y', $get_member[0]->date_of_birth));?>&nbsp</span>
                <span class="stats-label text-uppercase text-left pl-2"><?=$this->Crud_model->get_type_name_by_id('profession', $basic_info_data[0]['profession']);?>&nbsp</span>
                <span class="stats-label text-uppercase text-left pl-2"> <img SRC="http://api.hostip.info/images/flags/<?=$countryCode?>.gif" width="20" height="15"></span>
                <span class="stats-label text-uppercase text-left pl-2"><?=$this->Crud_model->get_type_name_by_id('sect', $basic_info_data[0]['my_sect'])?>&nbsp</span>
            </div>
        </div>
    </div>


<script>

    $( document ).ready(function() {
        $('#videoModal').on('shown.bs.modal', function () {
            $('body > div.modal-backdrop.fade.show').removeClass( "modal-backdrop" );
        })
        $('#videoModal').on('hidden.bs.modal', function () {
            $('#video1')[0].pause();
        })

        if (<?php echo $has_video.' == 0'?>)
        {
            $('#showVideo').hide();
        }


    });

    var isloggedin = "<?=$this->session->userdata('member_id')?>";
    var rem_interests = parseInt("<?=$this->Crud_model->get_type_name_by_id('member', $this->session->userdata('member_id'), 'express_interest')?>");
    var rem_messages = parseInt("<?=$this->Crud_model->get_type_name_by_id('member', $this->session->userdata('member_id'), 'direct_messages')?>");


    function confirm_interest(id) {
        // alert(id);
        if (isloggedin == "") {
            $("#active_modal").modal("toggle");
            $("#modal_header").html("<?php echo translate('please_log_in');?>");
            $("#modal_body").html("<p class='text-center'><?php echo translate('please_log_in_to_express_your_interest_on_this_member');?></p>");
            $("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%'><?php echo translate('close');?></button> <a href='<?=base_url()?>home/login' class='btn btn-sm btn-base-1 btn-shadow' style='width:25%'><?php echo translate('log_in');?></a>");
        }
        else {
            if (rem_interests <= 0) {
                $("#active_modal").modal("toggle");
                $("#modal_header").html("<?php echo translate('buy_premium_packages');?>");
                $("#modal_body").html("<p class='text-center'><b><?php echo translate('remaining_express_interest(s): ');?>"+rem_interests+" <?php echo translate('times');?></b><br><?php echo translate('please_buy_packages_from_the_premium_plans.');?></p>");
                $("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%'><?php echo translate('close');?></button> <a href='<?=base_url()?>home/plans' class='btn btn-sm btn-base-1 btn-shadow' style='width:25%'><?php echo translate('premium_plans');?></a>");
            }
            else {
                $("#active_modal").modal("toggle");
                $("#modal_header").html("<?php echo translate('confirm_express_interest');?>");
                $("#modal_body").html("<p class='text-center'><b><?php echo translate('remaining_express_interest(s):');?> "+rem_interests+" <?php echo translate('times');?></b><br><span style='color:#DC0330;font-size:11px'>**N.B. <?php echo translate('expressing_an_interest_will_cost_1_from_your_remaining_interests');?>**</span></p>");
                $("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%'><?php echo translate('close');?></button> <a href='#' id='confirm_interest' class='btn btn-sm btn-base-1 btn-shadow' onclick='return do_interest("+id+")' style='width:25%'><?php echo translate('confirm');?></a>");
            }
        }
        return false;
    }

    function do_interest(id) {
        // alert(id);
        if (isloggedin == "") {
            $("#active_modal").modal("toggle");
            $("#modal_header").html("<?php echo translate('please_log_in');?>");
            $("#modal_body").html("<p class='text-center'><?php echo translate('please_log_in_to_ignore_this_member');?></p>");
            $("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%'><?php echo translate('close');?></button> <a href='<?=base_url()?>home/login' class='btn btn-sm btn-base-1 btn-shadow' style='width:25%'><?php echo translate('log_in');?></a>");
        }
        else {
            $("#interest_a_"+id).addClass("li_active");
            $("#confirm_interest").removeAttr("onclick");
            $("#confirm_interest").html("<i class='fa fa-refresh fa-spin'></i> <?php echo translate('processing');?>..");
            $("#interest_a_"+id).removeAttr("onclick");
            setTimeout(function() {
                $.ajax({
                    type: "POST",
                    url: "<?=base_url()?>home/add_interest/"+id,
                    cache: false,
                    success: function(response) {
                        $("#active_modal .close").click();
                        $("#interest_text").html("<i class='fa fa-heart'></i> <?php echo translate('interest_expressed');?>");
                        $("#interest_a_"+id).css("cssText", "");
                        $("#success_alert").show();
                        $(".alert-success").html("<?php echo translate('you_have_expressed_an_interest_on_this_member!');?>");
                        $('#danger_alert').fadeOut('fast');
                        setTimeout(function() {
                            $('#success_alert').fadeOut('fast');
                        }, 5000); // <-- time in milliseconds
                    },
                    fail: function (error) {
                        alert(error);
                    }
                });
            }, 500); // <-- time in milliseconds
        }
        return false;
    }

    function confirm_message(id) {
        // alert(id);
        if (isloggedin == "") {
            $("#active_modal").modal("toggle");
            $("#modal_header").html("<?php echo translate('please_log_in');?>");
            $("#modal_body").html("<p class='text-center'><?php echo translate('please_log_in_to_enable_messaging');?></p>");
            $("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%'><?php echo translate('close');?></button> <a href='<?=base_url()?>home/login' class='btn btn-sm btn-base-1 btn-shadow' style='width:25%'><?php echo translate('log_in');?></a>");
        }
        else {
            enable_message(id);

        }
        return false;
    }

    function enable_message(id) {
        if (isloggedin == "") {
            $("#active_modal").modal("toggle");
            $("#modal_header").html("<?php echo translate('please_log_in');?>");
            $("#modal_body").html("<p class='text-center'><?php echo translate('please_log_in_to_enable_messaging');?></p>");
            $("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%'><?php echo translate('close');?></button> <a href='<?=base_url()?>home/login' class='btn btn-sm btn-base-1 btn-shadow' style='width:25%'><?php echo translate('log_in');?></a>");
        }
        else {
            $("#message_a_"+id).addClass("li_active");
            $("#confirm_message").removeAttr("onclick");
            $("#confirm_message").html("<i class='fa fa-refresh fa-spin'></i> <?php echo translate('processing');?>..");
            $("#message_a_"+id).removeAttr("onclick");
            setTimeout(function() {
                $.ajax({
                    type: "POST",
                    url: "<?=base_url()?>home/enable_message/"+id,
                    cache: false,
                    dataType: 'json',
                    success: function(response) {
                        $("#active_modal .close").click();
                        $("#message_text").html("<i class='fa fa-comments-o'></i><?php echo translate('message_enabled');?>");
                        $("#message_a_"+id).css("cssText", "");
                        $("#success_alert").show();
                        $(".alert-success").html("<?php echo translate('you_have_enable_messaging_with_this_member!');?>");
                        $('#danger_alert').fadeOut('fast');
                        setTimeout(function() {
                            $('#success_alert').fadeOut('fast');
                        }, 5000); // <-- time in milliseconds
                        profile_load('messaging',response);
                    },
                    fail: function (error) {
                        alert(error);
                    }
                });
            }, 500); // <-- time in milliseconds
        }
        return false;
    }

    function do_shortlist(id) {
        // alert(id);
        if (isloggedin == "") {
            // $('#myModal').modal();
            alert("Please Log in");
        }
        else {
            $("#shortlist_a_"+id).addClass("li_active");
            $("#shortlist_a_"+id).removeAttr("onclick");
            $("#shortlist_text").html("<i class='fa fa-refresh fa-spin'></i> <?php echo translate('shortlisting');?>..");
            setTimeout(function() {
                $.ajax({
                    type: "POST",
                    url: "<?=base_url()?>home/add_shortlist/"+id,
                    cache: false,
                    success: function(response) {
                        $("#shortlist_text").html("<i class='fa fa-list-ul'></i> <?php echo translate('shortlisted');?>");
                        $("#shortlist_a_"+id).attr("onclick","return remove_shortlist("+id+")");
                        $("#shortlist_a_"+id).css("cssText", "");
                        $("#success_alert").show();
                        $(".alert-success").html("<?php echo translate('you_have_shortlisted_this_member!');?>");
                        $('#danger_alert').fadeOut('fast');
                        setTimeout(function() {
                            $('#success_alert').fadeOut('fast');
                        }, 5000); // <-- time in milliseconds
                    },
                    fail: function (error) {
                        alert(error);
                    }
                });
            }, 500); // <-- time in milliseconds
        }
        return false;
    }

    function remove_shortlist(id) {
        // alert(id);
        if (isloggedin == "") {
            // $('#myModal').modal();
            alert("Please Log in");
        }
        else {
            $("#shortlist_a_"+id).removeAttr("onclick");
            $("#shortlist_text").html("<i class='fa fa-refresh fa-spin'></i> <?php echo translate('removing');?>..");
            setTimeout(function() {
                $.ajax({
                    type: "POST",
                    url: "<?=base_url()?>home/remove_shortlist/"+id,
                    cache: false,
                    success: function(response) {
                        $("#shortlist_text").html("<i class='fa fa-list-ul'></i> <?php echo translate('shortlist');?>");
                        $("#shortlist_a_"+id).attr("onclick","return do_shortlist("+id+")");
                        $("#shortlist_a_"+id).css("cssText", "");
                        $("#shortlist_a_"+id).removeClass("li_active");
                        $("#danger_alert").show();
                        $(".alert-danger").html("<?php echo translate('you_have_removed_this_member_from_shortlist!');?>");
                        $('#success_alert').fadeOut('fast');
                        setTimeout(function() {
                            $('#danger_alert').fadeOut('fast');
                        }, 5000); // <-- time in milliseconds
                    },
                    fail: function (error) {
                        alert(error);
                    }
                });
            }, 500); // <-- time in milliseconds
        }
        return false;
    }

    var follower = parseInt("<?=$this->Crud_model->get_type_name_by_id('member', $get_member[0]->member_id, 'follower')?>");
    function do_follow(id) {
        // alert(id);

        if (isloggedin == "") {
            // $('#myModal').modal();
            alert("Please Log in");
        }
        else {
            $("#followed_a_"+id).addClass("li_active");
            $("#followed_a_"+id).removeAttr("onclick");
            $("#followed_text").html("<i class='fa fa-refresh fa-spin'></i> <?php echo translate('following');?>..");
            setTimeout(function() {
                $.ajax({
                    type: "POST",
                    url: "<?=base_url()?>home/add_follow/"+id,
                    cache: false,
                    success: function(response) {
                        $("#followed_text").html("<i class='fa fa-star'></i> <?php echo translate('unfollow');?>");
                        $("#followed_a_"+id).attr("onclick","return do_unfollow("+id+")");
                        $("#followed_a_"+id).css("cssText", "");
                        $("#success_alert").show();
                        $(".alert-success").html("<?php echo translate('you_have_followed_this_member!');?>");
                        $('#danger_alert').fadeOut('fast');
                        setTimeout(function() {
                            $('#success_alert').fadeOut('fast');
                        }, 5000); // <-- time in milliseconds
                        follower = follower + 1;
                        $('#follower').html(follower);
                    },
                    fail: function (error) {
                        alert(error);
                    }
                });
            }, 500); // <-- time in milliseconds
        }
        return false;
    }

    function do_unfollow(id) {
        // alert(id);
        if (isloggedin == "") {
            // $('#myModal').modal();
            alert("Please Log in");
        }
        else {
            $("#followed_a_"+id).removeAttr("onclick");
            $("#followed_text").html("<i class='fa fa-refresh fa-spin'></i> <?php echo translate('unfollowing');?>..");
            setTimeout(function() {
                $.ajax({
                    type: "POST",
                    url: "<?=base_url()?>home/add_unfollow/"+id,
                    cache: false,
                    success: function(response) {
                        $("#followed_text").html("<i class='fa fa-star'></i> <?php echo translate('follow');?>");
                        $("#followed_a_"+id).attr("onclick","return do_follow("+id+")");
                        $("#followed_a_"+id).css("cssText", "");
                        $("#followed_a_"+id).removeClass("li_active");
                        $("#danger_alert").show();
                        $(".alert-danger").html("<?php echo translate('you_have_unfollowed_this_member!');?>");
                        $('#success_alert').fadeOut('fast');
                        setTimeout(function() {
                            $('#danger_alert').fadeOut('fast');
                        }, 5000); // <-- time in milliseconds
                        follower = follower - 1;
                        $('#follower').html(follower);
                    },
                    fail: function (error) {
                        alert(error);
                    }
                });
            }, 500); // <-- time in milliseconds
        }
        return false;
    }

    function confirm_ignore(id) {
        // alert(id);
        if (isloggedin == "") {
            $("#active_modal").modal("toggle");
            $("#modal_header").html("<?php echo translate('please_log_in');?>");
            $("#modal_body").html("<p class='text-center'><?php echo translate('please_log_in_to_ignore_this_member');?></p>");
            $("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%'><?php echo translate('close');?></button> <a href='<?=base_url()?>home/login' class='btn btn-sm btn-base-1 btn-shadow' style='width:25%'><?php echo translate('log_in');?></a>");
        }
        else {
            $("#active_modal").modal("toggle");
            $("#modal_header").html("<?php echo translate('confirm_ignore');?>");
            $("#modal_body").html("<p class='text-center'><?php echo translate('are_you_sure_that_you_want_to_ignore_this_member?');?></p>");
            $("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%'><?php echo translate('close');?></button> <a href='#' id='confirm_ignore' class='btn btn-sm btn-base-1 btn-shadow' onclick='return do_ignore("+id+")' style='width:25%'><?php echo translate('confirm');?></a>");
        }
        return false;
    }

    function do_ignore(id) {
        // alert(id);
        if (isloggedin == "") {
            $("#active_modal").modal("toggle");
            $("#modal_header").html("<?php echo translate('please_log_in');?>");
            $("#modal_body").html("<p class='text-center'><?php echo translate('please_log_in_to_ignore_this_member');?></p>");
            $("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%'><?php echo translate('close');?></button> <a href='<?=base_url()?>home/login' class='btn btn-sm btn-base-1 btn-shadow' style='width:25%'><?php echo translate('log_in');?></a>");
        }
        else {
            $("#confirm_ignore").removeAttr("onclick");
            $("#confirm_ignore").html("<i class='fa fa-refresh fa-spin'></i> <?php echo translate('processing');?>..");
            setTimeout(function() {
                $.ajax({
                    type: "POST",
                    url: "<?=base_url()?>home/add_ignore/"+id,
                    cache: false,
                    success: function(response) {
                        $("#danger_alert").show();
                        $(".alert-danger").html("<?php echo translate('you_have_ignored_this_member!');?>");
                        $('#success_alert').fadeOut('fast');
                        setTimeout(function() {
                            $('#danger_alert').fadeOut('fast');
                        }, 5000); // <-- time in milliseconds
                        setTimeout(function() {
                            window.location.href = "<?=base_url()?>home/listing";
                        }, 2000); // <-- time in milliseconds
                    },
                    fail: function (error) {
                        alert(error);
                    }
                });
            }, 500); // <-- time in milliseconds
        }
        return false;
    }


    function profile_load(page,sp){
        // alert('here');
        if (typeof message_interval !== 'undefined') {
            clearInterval(message_interval);
        }

        if(page !== ''){
            $.ajax({
                url: "<?=base_url()?>home/profile/"+page,
                success: function(response) {
                    $("#profile_load").html(response);
                    if(page == 'messaging'){
                        //  $('body').find('#thread_'+sp).click();
                    }
                    // window.scrollTo(0, 0);
                    if (sp != 'no') {
                        $(".btn-back-to-top").click();
                    }
                }
            });
            $('.p_nav').removeClass("active");
            $('.l_nav').removeClass("li_active");
            $('.m_nav').removeClass("m_nav_active");

            if (page!='gallery'||page!='happy_story'||page!='my_packages'||page!='payments' ||page=='change_pass'||page=='picture_privacy') {
                $('.'+page).addClass("active");
                $('.m_'+page).addClass("m_nav_active");
            }
            if (page=='gallery'||page=='happy_story'||page=='my_packages'||page=='payments' ||page=='change_pass'||page=='picture_privacy') {
                $('.'+page).addClass("li_active");
            }

        }
    }
</script>
<style>
    /* xs */
    .size-sm {
        padding-left: 0px !important;
        padding-right: 0px !important;
    }
    .size-smtr {
        padding-left: 0px !important;
        padding-right: 0px !important;
        padding-top: .50rem!important;
    }
    .size-smtl {
        padding-left: 0px !important;
        padding-right: 0px !important;
        padding-top: .50rem!important;
    }
    .size-smr {
        padding-left: 0px !important;
        padding-right: 0px !important;
        padding-top: 0px !important;
    }
    .size-sml {
        padding-left: 0px !important;
        padding-right: 0px !important;
        padding-top: .50rem!important;
    }
    /* sm */
    @media (min-width: 768px) {
        .size-sm {
            padding-left: 0px !important;
            padding-right: 0px !important;
        }
        .size-smtr {
            padding-left: 0px !important;
            padding-right: .25rem!important;
            padding-top: .50rem!important;
        }
        .size-smtl {
            padding-left: .25rem!important;
            padding-right: 0px !important;
            padding-top: .50rem!important;
        }
        .size-smr {
            padding-left: 0px !important;
            padding-right: .25rem!important;
            padding-top: 0px !important;
        }
        .size-sml {
            padding-left: .25rem!important;
            padding-right: 0px !important;
            padding-top: 0px !important;
        }
    }
    /* md */
    @media (min-width: 992px) {
        .size-sm {
            padding-left: 0px !important;
            padding-right: 0px !important;
        }
        .size-smtr {
            padding-left: 0px !important;
            padding-right: .25rem!important;
            padding-top: .50rem!important;
        }
        .size-smtl {
            padding-left: .25rem!important;
            padding-right: 0px !important;
            padding-top: .50rem!important;
        }
        .size-smr {
            padding-left: 0px !important;
            padding-right: .25rem!important;
            padding-top: 0px !important;
        }
        .size-sml {
            padding-left: .25rem!important;
            padding-right: 0px !important;
            padding-top: 0px !important;
        }
    }
    /* lg */
    @media (min-width: 1200px) {
        .size-sm {
            padding-left: 0px !important;
            padding-right: 0px !important;
        }
        .size-smtr {
            padding-left: 0px !important;
            padding-right: .25rem!important;
            padding-top: .50rem!important;
        }
        .size-smtl {
            padding-left: .25rem!important;
            padding-right: 0px !important;
            padding-top: .50rem!important;
        }
        .size-smr {
            padding-left: 0px !important;
            padding-right: .25rem!important;
            padding-top: 0px !important;
        }
        .size-sml {
            padding-left: .25rem!important;
            padding-right: 0px !important;
            padding-top: 0px !important;
        }
    }
</style>