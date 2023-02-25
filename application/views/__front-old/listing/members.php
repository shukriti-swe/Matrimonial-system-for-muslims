<?php
if (empty($get_all_members)) {
    ?>
        <div class='text-center pt-5 pb-5'><i class='fa fa-exclamation-triangle fa-5x'></i><h5><?=translate('no_result_found!')?></h5></div>
    <?php
}

foreach ($get_all_members as $member): ?>
    <?php

if (intval($member->hide_profile) == 2){
        $image = json_decode($member->profile_image, true);
    ?>
    <div class="block block--style-3 col-lg-3 col-sm-1 list" style="float:left; border-radius: 2px;"  id="block_<?=$member->member_id?>">
        <div class="block-image" style="padding-top: 19px;">
            <a onclick="return goto_profile(<?=$member->member_id?>)">
                    <?php
                    if (file_exists('uploads/profile_image/'.$image[0]['thumb'])) {
                    ?>
                    <?php
                        $pic_privacy = $member->pic_privacy;
                        $pic_privacy_data = json_decode($pic_privacy, true);
                        $is_premium = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata('member_id'), 'membership');
                        if($pic_privacy_data[0]['profile_pic_show']=='only_me'){
                    ?>
                        <div class="listing-image" style="border-style: solid;  border-width: 1px; border-color: black; background-image: url(<?=base_url()?>uploads/profile_image/default.jpg"></div>
                        <?php }elseif ($pic_privacy_data[0]['profile_pic_show']=='premium' and $is_premium==2) {
                        ?>
                            <div class="listing-image" style="border-style: solid;  border-width: 1px; border-color: black; background-image: url(<?=base_url()?>uploads/profile_image/<?=$image[0]['thumb']?>)"></div>
                        <?php }elseif ($pic_privacy_data[0]['profile_pic_show']=='premium' and $is_premium==1) {
                        ?>
                            <div class="listing-image" style="border-style: solid;  border-width: 1px; border-color: black; background-image: url(<?=base_url()?>uploads/profile_image/default.jpg"></div>
                        <?php }elseif ($pic_privacy_data[0]['profile_pic_show']=='all') {
                        ?>
                        <div class="listing-image styling" style="border-style: solid;  border-width: 1px; border-color: black; background-image: url(<?=base_url()?>uploads/profile_image/<?=$image[0]['thumb']?>)"></div>
                    <?php }else{ ?>
                        <div class="listing-image" style="border-style: solid;  border-width: 1px; border-color: black; background-image: url(<?=base_url()?>uploads/profile_image/default.jpg"></div>
                    <?php }
                    }
                    else {
                    ?>
                        <div class="listing-image" style="border-style: solid;  border-width: 1px; border-color: black; background-image: url(<?=base_url()?>uploads/profile_image/default.jpg"></div>
                    <?php
                    }
                    ?>
                </a>
        </div>
        
          <style>
            .styling {
               height: 170px !important; width: 120px !important;
            }

        </style>
        <?php
            $basic_info = $this->Crud_model->get_type_name_by_id('member', $member->member_id, 'basic_info');
            $basic_info_data = json_decode($basic_info, true);

            $education_and_career = $this->Crud_model->get_type_name_by_id('member', $member->member_id, 'education_and_career');
            $education_and_career_data = json_decode($education_and_career, true);

            $physical_attributes = $this->Crud_model->get_type_name_by_id('member', $member->member_id, 'physical_attributes');
            $physical_attributes_data = json_decode($physical_attributes, true);

            $spiritual_and_social_background = $this->Crud_model->get_type_name_by_id('member', $member->member_id, 'spiritual_and_social_background');
            $spiritual_and_social_background_data = json_decode($spiritual_and_social_background, true);

            $language = $this->Crud_model->get_type_name_by_id('member', $member->member_id, 'language');
            $language_data = json_decode($language, true);

            $present_address = $this->Crud_model->get_type_name_by_id('member', $member->member_id, 'present_address');
            $present_address_data = json_decode($present_address, true);
            $calculated_age = (date('Y') - date('Y', $member->date_of_birth));

            $display_member = $this->Crud_model->get_type_name_by_id('member', $member->member_id, 'display_member');
        ?>
        <div class="block-title-wrapper">
            <?php if ($member->membership == 2): ?>
               <!-- <a class="badge-corner badge-corner-red">
                    <span style="-ms-transform: rotate(45deg);/* IE 9 */-webkit-transform: rotate(45deg);/* Chrome, Safari, Opera */transform: rotate(45deg);font-size: 10px;margin-left: -14px;">
                        <?=translate('premium')?>
                    </span>
                </a>-->
            <?php endif ?>
            <h3 class="heading heading-5 strong-500" style="text-align: center">
                <a onclick="return goto_profile(<?=$member->member_id?>)" class="c-base-1"><?=$display_member?></a>
            </h3>

            <table class="table-striped table-bordered " style="font-size: 10px;">
                <tr>
                    <td width="120" height="30" style="padding-left: 5px;" class="font-dark"><b><?php echo strtoupper(translate('age'))?></b></td>
                    <td width="120" height="30" style="padding-left: 5px;" class="font-dark" colspan="3"><?=strtoupper($calculated_age)?></td>
                </tr>
                <tr>
                    <td width="120" height="30" style="padding-left: 5px;" class="font-dark"><b><?php echo strtoupper('Sect') ?></b></td>
                    <td width="120" height="30" style="padding-left: 3px; overflow: hidden !important;text-overflow: ellipsis;" class="font-dark" colspan="3"><?=strtoupper($this->Crud_model->get_type_name_by_id('sect', $basic_info_data[0]['my_sect']));?></td>
                </tr>

                <tr>
                    <td width="120" height="30" style="padding-left: 5px;" class="font-dark"><b><?php echo strtoupper('Profession') ?></b></td>
                    <td width="120" height="30" style="padding-left: 3px; overflow: hidden !important;text-overflow: ellipsis;" class="font-dark"><?=strtoupper($this->Crud_model->get_type_name_by_id('profession', $basic_info_data[0]['profession']));?></td>
                </tr>
                <tr>
                    <td width="120" height="30" style="padding-left: 5px;" class="font-dark"><b><?php echo strtoupper('Residence') ?></b></td>
                    <td width="120" height="30" style="padding-left: 3px; overflow: hidden !important;text-overflow: ellipsis;" class="font-dark" class="font-dark" colspan="3"><?=strtoupper($this->Crud_model->get_type_name_by_id('country', $basic_info_data[0]['residence']));?></td>
                </tr>

                </table>
        </div>
        <div class="block-footer b-xs-top">
            <div class="row align-items-center">
                <div class="col-sm-12 text-center">
                    <ul class="inline-links inline-links--style-3">
                        <li class="listing-hover">
                            <a onclick="return goto_profile(<?=$member->member_id?>)">
                                <i class="fa fa-id-card"></i><?php echo strtoupper(translate('full_profile'))?>
                            </a>
                        </li>

                    </ul>

                </div>
            </div>
        </div>
    </div>
<?php } endforeach ?>
<div id="pseudo_pagination" style="display: none;">
    <?= $this->ajax_pagination->create_links();?>
</div>

<script type="text/javascript">
    $('#pagination').html($('#pseudo_pagination').html());
</script>

<script>
    var isloggedin = "<?=$this->session->userdata('member_id')?>";

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

    var rem_interests = parseInt("<?=$this->Crud_model->get_type_name_by_id('member', $this->session->userdata('member_id'), 'express_interest')?>");
    function confirm_interest(id) {
        // alert(id);
        if (isloggedin == "") {
            $("#active_modal").modal("toggle");
            $("#modal_header").html("<?php echo translate('please_log_in')?>");
            $("#modal_body").html("<p class='text-center'><?php echo translate('please_log_in_to_express_interest_on_this_member')?></p>");
            $("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%'><?=translate('close')?></button> <a href='<?=base_url()?>home/login' class='btn btn-sm btn-base-1 btn-shadow' style='width:25%'><?php echo translate('log_in')?></a>");
        }
        else {
            if (rem_interests <= 0) {
                $("#active_modal").modal("toggle");
                $("#modal_header").html("<?php echo translate('buy_premium_packages')?>");
                $("#modal_body").html("<p class='text-center'><b>Remaining Express Interest(s): "+rem_interests+" times</b><br><?php echo translate('please_buy_packages_from_the_premium_plans.')?></p>");
                $("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%'><?=translate('close')?></button> <a href='<?=base_url()?>home/plans' class='btn btn-sm btn-base-1 btn-shadow' style='width:25%'><?php echo translate('premium_plans')?></a>");
            }
            else {
                $("#active_modal").modal("toggle");
                $("#modal_header").html("<?php echo translate('confirm_express_interest')?>");
                $("#modal_body").html("<p class='text-center'><b><?php echo translate('remaining_express_interest(s): ')?>"+rem_interests+" <?php echo translate('times')?></b><br><span style='color:#DC0330;font-size:11px'>**N.B. <?php echo translate('expressing_an_interest_will_cost_1_from_your_remaining_interests')?>**</span></p>");
                $("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%'><?=translate('close')?></button> <a href='#' id='confirm_interest' class='btn btn-sm btn-base-1 btn-shadow' onclick='return do_interest("+id+")' style='width:25%'><?php echo translate('confirm')?></a>");
            }
        }
        return false;
    }

    function do_interest(id) {
        // alert(id);
        if (isloggedin == "") {
            $("#active_modal").modal("toggle");
            $("#modal_header").html("<?php echo translate('please_log_in')?>");
            $("#modal_body").html("<p class='text-center'><?php echo translate('please_log_in_to_express_interest_on_this_member')?></p>");
            $("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%'><?php echo translate('close')?></button> <a href='<?=base_url()?>home/login' class='btn btn-sm btn-base-1 btn-shadow' style='width:25%'><?php echo translate('log_in')?></a>");
        }
        else {
            $("#confirm_interest").removeAttr("onclick");
            $("#confirm_interest").html("<i class='fa fa-refresh fa-spin'></i> <?php echo translate('processing')?>..");
            $("#interest_a_"+id).removeAttr("onclick");
            setTimeout(function() {
                $.ajax({
                    type: "POST",
                    url: "<?=base_url()?>home/add_interest/"+id,
                    cache: false,
                    success: function(response) {
                        rem_interests = rem_interests - 1;
                        $("#active_modal .close").click();
                        $("#interest_"+id).html("<i class='fa fa-heart'></i> <?php echo translate('interest_expressed')?>");
                        $("#interest_"+id).attr("class","c-base-1");
                        $("#interest_a_"+id).css("cssText", "");
                        $("#success_alert").show();
                        $(".alert-success").html("<?php echo translate('you_have_expressed_an_interest_on_this_member!')?>");
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

    function do_shortlist(id) {
        // alert(id);
        if (isloggedin == "") {
            $("#active_modal").modal("toggle");
            $("#modal_header").html("<?php echo translate('please_log_in')?>");
            $("#modal_body").html("<p class='text-center'><?php echo translate('please_log_in_to_shortlist_this_member')?></p>");
            $("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%'><?php echo translate('close')?></button> <a href='<?=base_url()?>home/login' class='btn btn-sm btn-base-1 btn-shadow' style='width:25%'><?php echo translate('log_in')?></a>");
        }
        else {
            $("#shortlist_a_"+id).removeAttr("onclick");
            $("#shortlist_"+id).html("<i class='fa fa-refresh fa-spin'></i> <?php echo translate('shortlisting')?>..");
            setTimeout(function() {
                $.ajax({
                    type: "POST",
                    url: "<?=base_url()?>home/add_shortlist/"+id,
                    cache: false,
                    success: function(response) {
                        $("#shortlist_"+id).html("<i class='fa fa-list-ul'></i> <?php echo translate('shortlisted')?>");
                        $("#shortlist_"+id).attr("class","c-base-1");
                        $("#shortlist_a_"+id).attr("onclick","return remove_shortlist("+id+")");
                        $("#shortlist_a_"+id).css("cssText", "");
                        $("#success_alert").show();
                        $(".alert-success").html("<?php echo translate('you_have_shortlisted_this_member!')?>");
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
            $("#active_modal").modal("toggle");
            $("#modal_header").html("<?php echo translate('please_log_in')?>");
            $("#modal_body").html("<p class='text-center'><?php echo translate('please_log_in_to_remove_this_member_from_shortlist')?></p>");
            $("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%'><?=translate('close')?></button> <a href='<?=base_url()?>home/login' class='btn btn-sm btn-base-1 btn-shadow' style='width:25%'><?php echo translate('log_in')?></a>");
        }
        else {
            $("#shortlist_a_"+id).removeAttr("onclick");
            $("#shortlist_"+id).html("<i class='fa fa-refresh fa-spin'></i> <?php echo translate('removing')?>..");
            setTimeout(function() {
                $.ajax({
                    type: "POST",
                    url: "<?=base_url()?>home/remove_shortlist/"+id,
                    cache: false,
                    success: function(response) {
                        $("#shortlist_"+id).html("<i class='fa fa-list-ul'></i> <?php echo translate('shortlist')?>");
                        $("#shortlist_"+id).attr("class","");
                        $("#shortlist_a_"+id).attr("onclick","return do_shortlist("+id+")");
                        $("#shortlist_a_"+id).css("cssText", "");
                        $("#danger_alert").show();
                        $(".alert-danger").html("<?php echo translate('you_have_removed_this_member_from_shortlist!')?>");
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

    function do_follow(id) {
        // alert(id);
        if (isloggedin == "") {
            $("#active_modal").modal("toggle");
            $("#modal_header").html("<?php echo translate('please_log_in')?>");
            $("#modal_body").html("<p class='text-center'><?php echo translate('please_log_in_to_follow_this_member')?></p>");
            $("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%'><?php echo translate('close')?></button> <a href='<?=base_url()?>home/login' class='btn btn-sm btn-base-1 btn-shadow' style='width:25%'><?php echo translate('log_in')?></a>");
        }
        else {
            $("#followed_a_"+id).removeAttr("onclick");
            $("#followed_"+id).html("<i class='fa fa-refresh fa-spin'></i> <?php echo translate('following')?>..");
            setTimeout(function() {
                $.ajax({
                    type: "POST",
                    url: "<?=base_url()?>home/add_follow/"+id,
                    cache: false,
                    success: function(response) {
                        $("#followed_"+id).html("<i class='fa fa-star'></i> <?php echo translate('unfollow')?>");
                        $("#followed_"+id).attr("class","c-base-1");
                        $("#followed_a_"+id).attr("onclick","return do_unfollow("+id+")");
                        $("#followed_a_"+id).css("cssText", "");
                        $("#success_alert").show();
                        $(".alert-success").html("<?php echo translate('you_have_followed_this_member!')?>");
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

    function do_unfollow(id) {
        // alert(id);
        if (isloggedin == "") {
            $("#active_modal").modal("toggle");
            $("#modal_header").html("<?php echo translate('please_log_in')?>");
            $("#modal_body").html("<p class='text-center'><?php echo translate('please_log_in_to_unfollow_this_member')?></p>");
            $("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%'><?php echo translate('close')?></button> <a href='<?=base_url()?>home/login' class='btn btn-sm btn-base-1 btn-shadow' style='width:25%'><?php echo translate('log_in')?></a>");
        }
        else {
            $("#followed_a_"+id).removeAttr("onclick");
            $("#followed_"+id).html("<i class='fa fa-refresh fa-spin'></i> <?php echo translate('unfollowing')?>..");
            setTimeout(function() {
                $.ajax({
                    type: "POST",
                    url: "<?=base_url()?>home/add_unfollow/"+id,
                    cache: false,
                    success: function(response) {
                        $("#followed_"+id).html("<i class='fa fa-star'></i> <?php echo translate('follow')?>");
                        $("#followed_"+id).attr("class","");
                        $("#followed_a_"+id).attr("onclick","return do_follow("+id+")");
                        $("#followed_a_"+id).css("cssText", "");
                        $("#danger_alert").show();
                        $(".alert-danger").html("<?php echo translate('you_have_unfollowed_this_member!')?>");
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

    function confirm_ignore(id) {
        // alert(id);
        if (isloggedin == "") {
            $("#active_modal").modal("toggle");
            $("#modal_header").html("<?php echo translate('please_log_in')?>");
            $("#modal_body").html("<p class='text-center'><?php echo translate('please_log_in_to_ignore_this_member')?></p>");
            $("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%'><?php echo translate('close')?></button> <a href='<?=base_url()?>home/login' class='btn btn-sm btn-base-1 btn-shadow' style='width:25%'><?php echo translate('log_in')?></a>");
        }
        else {
            $("#active_modal").modal("toggle");
            $("#modal_header").html("<?php echo translate('confirm_ignore')?>");
            $("#modal_body").html("<p class='text-center'><?php echo translate('are_you_sure_that_you_want_to_ignore_this_member?')?></p>");
            $("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%'><?php echo translate('close')?></button> <a href='#' id='confirm_ignore' class='btn btn-sm btn-base-1 btn-shadow' onclick='return do_ignore("+id+")' style='width:25%'><?php echo translate('confirm')?></a>");
        }
        return false;
    }

    function do_ignore(id) {
        // alert(id);
        if (isloggedin == "") {
            $("#active_modal").modal("toggle");
            $("#modal_header").html("<?php echo translate('please_log_in')?>");
            $("#modal_body").html("<p class='text-center'><?php echo translate('please_log_in_to_ignore_this_member')?></p>");
            $("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%'><?php echo translate('close')?></button> <a href='<?=base_url()?>home/login' class='btn btn-sm btn-base-1 btn-shadow' style='width:25%'><?php echo translate('log_in')?></a>");
        }
        else {
            $("#confirm_ignore").removeAttr("onclick");
            $("#confirm_ignore").html("<i class='fa fa-refresh fa-spin'></i> <?php echo translate('processing')?>..");
            setTimeout(function() {
                $.ajax({
                    type: "POST",
                    url: "<?=base_url()?>home/add_ignore/"+id,
                    cache: false,
                    success: function(response) {
                        $("#active_modal .close").click();
                        $("#block_"+id).hide();
                        $("#danger_alert").show();
                        $(".alert-danger").html("<?php echo translate('you_have_ignored_this_member!')?>");
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
</script>