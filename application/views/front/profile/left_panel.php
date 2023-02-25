<div class="sidebar sidebar-inverse sidebar--style-1 bg-base-1 z-depth-2-top">
    <?php if($this->db->get_where("member", array("member_id" => $this->session->userdata('member_id')))->row()->is_closed == 'yes'){?>
        <a class="badge-corner badge-corner-red" style="right: 15px;border-top: 90px solid  #DC0330;border-left: 90px solid transparent;">
            <span style="-ms-transform: rotate(45deg);/* IE 9 */-webkit-transform: rotate(45deg);/* Chrome, Safari, Opera */transform: rotate(45deg);font-size: 14px;margin-left: -24px;margin-top: -16px;"><?=translate('closed')?></span>
        </a>
    <?php }?>
    <div class="sidebar-object mb-0">
        <h2 class="heading heading-3 strong-500 profile-name" style="text-align: center;"><?=strtoupper($get_member[0]->first_name." ".$get_member[0]->last_name)?></h2>

        <div  id="div_show_image" style="width: 300px;height: 300px;display: none;">

            <img id="show_img_click" src="<?= base_url() ?>uploads/profile_image/default.jpg" style="width: 300px;height: 300px;">
        </div>

        <!-- Profile picture -->
        <div class="profile-picture profile-picture--style-2">
                <!--            Removed code from here-->
            <?php
            $member_id = $this->session->userdata('member_id');
            $profile_image = $get_member[0]->profile_image;
            if(!empty($get_member[0]->profile_image) && $get_member[0]->is_profile_img_approved == 1){
                if (file_exists('uploads/profile_image/'.$member_id . "/" . $profile_image)) {
                    ?>
                    <div style="border: 10px solid rgba(255, 255, 255, 0.1);width: 200px;border-radius: 50%;margin-top: 30px;">
                        <div class="profile_img" id="show_img" style="background-image: url(<?= base_url() ?>uploads/profile_image/<?= $member_id . "/" .$profile_image.'?'.rand(999,99999999) ?>)">
                        </div>
                    </div>
            <?php
                }
            }
            else{
            ?>
                <div style="border: 10px solid rgba(255, 255, 255, 0.1);width: 200px;border-radius: 50%;margin-top: 30px;">
                    <div class="profile_img" id="show_img"
                         style="background-image: url(<?= base_url() ?>uploads/profile_image/default.jpg)"></div>
                </div>
            <?php 
                }
            ?>

            <div class="profile-connect mt-1 mb-0" id="save_button_section" style="display: none">
                <button type="button" class="btn btn-styled btn-xs btn-base-2" id="save_image" ><?php echo translate('save_image')?></button>

                <button type="button" class="btn btn-styled btn-xs btn-base-2" id="cancel_image" ><?php echo translate('Cancel')?></button>
            </div>
            <label class="btn-aux" for="profile_image" id="profile_Image_upload"  style="cursor: pointer;">
                <i class="ion ion-edit"></i>
            </label>
            <form action="<?=base_url()?>home/profile/update_image" method="POST" id="profile_image_form" enctype="multipart/form-data">
                <input type="file" style="display: none;" id="profile_image" name="profile_image"/>
            </form>
            <!-- <a href="#" class="btn-aux">
                <i class="ion ion-edit"></i>
            </a> -->
        </div>



        <!-- Profile details -->
        <div class="profile-details">
            <?php
                $education_and_career = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'education_and_career');
                $education_and_career_data = json_decode($education_and_career, true);
            ?>

            <?php
                $package_info = json_decode($get_member[0]->package_info, true);
            ?>
            <!--            FOLLOWERS TAB THAT I HAVE TO REMOVE TO ADD "BLOCKED" AND "INTERESTED" OPTION-->

            <style>
                .vl {
                    border-left: 0 solid white;
                    height: 2px;
                }
            </style>

            <div class="profile-stats clearfix">
            <div class="row">
                <div class="stats-entry col-md-6" style="width: 100%">

                    <a href="#" class="btn btn-styled btn-xs l_nav dropdown dropdown-submenu nav-link" data-toggle="dropdown">
                        <b style="font-size: 12px; color:white">BLOCKED PROFILES</b>
                        <i class="fa fa-sort-down text-white" style="font-size: 12px;"></i></a>
                    <div class="dropdown-menu" style="min-width: 1rem !important; border: 1px solid #f1f1f1 !important; text-decoration:none; background-color: #E91E63;">

                        <div class="dropdown dropdown-submenu">

                            <?php
                            $member = $this->session->userdata('member_id');
                            if ($member){
                            //first select all members that this user has marked as blocked
                            $this->db->select('*');
                            $this->db->from('interest_or_block');
                            $this->db->where('by_member', $member);
                            $this->db->where('block_status', 1);
                            $blocked_members = $this->db->get()->result();
                            
							
								
                            if (empty($blocked_members)){ ?>
                            <a class="dropdown-item btn btn-styled btn-white z-depth-2-bottom"
                               style="color: black;
                font-size: 12px; width: 165px;">No members</a>;
                            <?php
                            }else{

                             foreach ($blocked_members as $member) {

                                //take out the names of all those members
								
                                $this->db->select('*');
                                $this->db->from('member');
                                $this->db->where('member_id', $member->to_member);
                                $by_member = $this->db->get();
								$results=$by_member->result();
                              
								
                                foreach($results as $result){
								$block=$result->display_member;
								
                                ?>

                                <a class="side_drop dropdown-item btn btn-styled btn-white z-depth-2-bottom interestedDropdown"><?php echo $block; ?>
                                    <i class="fa fa-times-circle removeFromList" id="1"></i></a>
                                <?php }}}
                            } ?>
                        </div>
                    </div>

                </div>
                    <div class="vl"></div>
                <div class="stats-entry col-md-6" style="width: 100%">

                    <a href="#" class="btn btn-styled btn-xs l_nav dropdown dropdown-submenu nav-link" data-toggle="dropdown">
                        <b style="font-size: 12px; color:white">SAVED PROFILES</b>
                        <i class="fa fa-sort-down text-white" style="font-size: 12px;"></i></a>
                    <div class="dropdown-menu" style="min-width: 1rem !important; border: 1px solid #f1f1f1 !important; text-decoration:none; background-color: #E91E63;">

                        <div class="dropdown dropdown-submenu">

                            <?php
                            $member = $this->session->userdata('member_id');
                            if ($member){
                            //first select all members that have been marked this user as interested
                            $this->db->select('*');
                            $this->db->from('interest_or_block');
                            $this->db->where('by_member', $member);
                            $this->db->where('interest_status', 2);
                            $to_member = $this->db->get()->result();

                            if (empty($to_member)){ ?>
                                <a class="dropdown-item btn btn-styled btn-white z-depth-2-bottom"
                                   style="color: black; font-size: 12px; width: 165px; padding-left: 25px;">No members</a>
                                <?php
                            }

                            foreach ($to_member as $member){

                            //take out the names of all those members
                            $this->db->select('*');
                            $this->db->from('member');
                            $this->db->where('member_id', $member->to_member);
                            $by_member = $this->db->get();
                            
								$results2=$by_member->result();
                              
								
                                foreach($results2 as $result1){
								
                            $var = $result1->display_member;
                            ?>

                            <a class="dropdown-item side_drop btn btn-styled btn-white z-depth-2-bottom interestedDropdown"><?php echo $var; ?>
                                <i class="fa fa-times-circle removeFromList" id="2" style="padding-left: 50px;"></i></a>
                               <?php }}
                            } ?>
                        </div>


                    </div>
                </div>
            </div>
            </div>

            <!-- Profile connect -->
            <div hidden class="profile-connect mt-5">
                <!-- <a href="#" class="btn btn-styled btn-block btn-circle btn-sm btn-base-5">Follow</a>
                <a href="#" class="btn btn-styled btn-block btn-circle btn-sm btn-base-2">Send message</a> -->
                <h2 class="heading heading-5 strong-400"><?php echo translate('package_informations')?></h2>
            </div>
            <!--			Removed code from here-->
        </div>
        <!-- Profile stats -->
        <!-- rakesh -->

        <?php  

        $x = $this->db->get("cover_pic_plan")->result();
        $hasCoverPackage =  count($x);

         ?>
        <div class="profile-useful-links clearfix">
            <div class="useful-links" style="padding: 0.45rem !important;">
<div>
                <a href="#" class="btn btn-styled btn-sm btn-white z-depth-2-bottom mb-3 l_nav dropdown dropdown-submenu nav-link" data-toggle="dropdown">
                      <b style="font-size: 12px">MY ACCOUNT</b>&nbsp;
                    <i class="fa fa-sort-down"></i></a>
                <ul class="dropdown-menu" style="border: 1px solid #f1f1f1 !important;">
                    <li class="dropdown dropdown-submenu">
                        <li>
                            <a class="dropdown-item my_packages btn btn-styled btn-sm btn-white z-depth-2-bottom mb-3" id="my_packages" style=" color: black;font-size: 12px; width: 285px;" onclick="profile_load('my_packages')">MY PACKAGE</a>
                        </li>

                        <!-- rakesh -->

                        <?php  if ($hasCoverPackage) { ?>
                            <li>
                                <a class="dropdown-item my_packages btn btn-styled btn-sm btn-white z-depth-2-bottom mb-3" id="my_packages" style=" color: black;font-size: 12px; width: 285px;" onclick="profile_load('cover_pic_packages')">PROMOTE MY
PHOTO</a>
                            </li>
                        <?php    }  ?>
                        

                        <li>
                            <a class="dropdown-item change_pass btn btn-styled btn-sm btn-white z-depth-2-bottom mb-3" style="color: black;font-size: 12px;" onclick="profile_load('change_pass')">CHANGE PASSWORD</a>
                        </li>
                        <?php 
                            $membership = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata('member_id'), 'membership');
                            if($membership == 2){
                        ?>
                        <li>
                            <a class="dropdown-item billing btn btn-styled btn-sm btn-white z-depth-2-bottom mb-3" style="color: black;font-size: 12px;" onclick="profile_load('billing')">BILLING</a>
                        </li>
                        <?php } ?>
                        <li>
                            <a class="dropdown-item delete_account btn btn-styled btn-sm btn-white z-depth-2-bottom mb-3" style=" color: black;font-size: 12px;" onclick="profile_load('delete_account')">DELETE MY ACCOUNT</a>
                        </li>
                    </li>
                </ul>
            </div>
                <div>
                <a href="#" class="btn btn-styled btn-sm btn-white z-depth-2-bottom mb-3 l_nav dropdown dropdown-submenu nav-link" data-toggle="dropdown">
                    <b style="font-size: 12px;">PHOTO(S) & VIDEO UPLOAD</b>&nbsp;
                    <i class="fa fa-sort-down"></i></a>
                <ul class="dropdown-menu" style="border: 1px solid #f1f1f1 !important;">
                    <li class="dropdown dropdown-submenu">
                    <li>
                        <a class="dropdown-item btn btn-styled btn-sm btn-white z-depth-2-bottom mb-3 gallery" style=" color: black;
                font-size: 12px;  width: 285px;" onclick="profile_load('photos')">
                            PHOTO(S)</a>
                    </li>
<!-- 
					<?php
                        $user_id = $this->session->userdata('member_id');
                        $a = $this->db->where('member_id',$user_id)->order_by('payment_date','DESC')->limit(1)->get('cover_pic_payment')->row();
                        if (isset($a) && !empty($a)) {
                            $b = $a->payment_date;
                            $c = $a->end_date;
                        }
                     if (isset($b) && !isset($c)): ?>
                        <li>
                            <a class="dropdown-item btn btn-styled btn-sm btn-white z-depth-2-bottom mb-3" style=" color: black;font-size: 12px;  width: 285px;" onclick="profile_load('cover_pic_packages_')">
                                COVER PHOTO UPLOAD</a>
                        </li>
                    <?php endif ?>
-->
					<?php  if ($hasCoverPackage) { ?>
                            <li>
                                <a class="dropdown-item my_packages btn btn-styled btn-sm btn-white z-depth-2-bottom mb-3" id="my_packages" style=" color: black;font-size: 12px; width: 285px;" onclick="profile_load('cover_pic_packages')">COVER PHOTO UPLOAD</a>
                            </li>
                        <?php    }  ?>
                    <li>
                        <a class="dropdown-item btn btn-styled btn-sm btn-white z-depth-2-bottom mb-3" style=" color: black;
                font-size: 12px;  width: 285px;" onclick="profile_load('videos')">
                            VIDEO</a>
					</li>
                    <li>
                        <a class="dropdown-item btn btn-styled btn-sm btn-white z-depth-2-bottom mb-3" style=" color: black;
                font-size: 12px;" onclick="profile_load('photo_video_privacy')">
                            PHOTO(S) & VIDEO PRIVACY SETTINGS</a>
                    </li>
                    <li>
                        <a class="dropdown-item btn btn-styled btn-sm btn-white z-depth-2-bottom mb-3 picture_privacy" style=" color: black;
                font-size: 12px;" onclick="profile_load('hide_profile')">HIDE MY PROFILE</a>
                    </li>
					</li>
                </ul>
                </div>
                          </div>
                             </div>


                    <!--        <div class="profile-useful-links clearfix">-->
<!--            <div class="useful-links">-->
<!--                <a class="btn btn-styled btn-sm btn-white z-depth-2-bottom mb-3 gallery l_nav" onclick="profile_load('gallery')">-->
<!--                    <b style="font-size: 12px">Photo / Video Upload</b>-->
<!--                </a>-->
<!--				 <a class="btn btn-styled btn-sm btn-white z-depth-2-bottom mb-3 picture_privacy l_nav" onclick="profile_load('picture_privacy')">-->
<!--                    <b style="font-size: 12px">Privacy Settings</b>-->
<!--                </a>-->
<!--                <a hidden class="btn btn-styled btn-sm btn-white z-depth-2-bottom mb-3 happy_story l_nav" onclick="profile_load('happy_story')">-->
<!--                    <b style="font-size: 12px">--><?php //echo translate('happy_story')?><!--</b>-->
<!--                </a>-->
<!--                <a class="btn btn-styled btn-sm btn-white z-depth-2-bottom mb-3 my_packages l_nav" onclick="profile_load('my_packages')">-->
<!--                    <b style="font-size: 12px">--><?php //echo translate('My_package')?><!--</b>-->
<!--                </a>-->
<!--                <a hidden class="btn btn-styled btn-sm btn-white z-depth-2-bottom mb-3 payments l_nav" onclick="profile_load('payments')">-->
<!--                    <b style="font-size: 12px">--><?php //echo translate('payment_informations')?><!--</b>-->
<!--                </a>-->
<!--               -->
<!--               -->
<!--                <a class="btn btn-styled btn-sm btn-white z-depth-2-bottom mb-3 change_pass l_nav" onclick="profile_load('change_pass')">-->
<!--                    <b style="font-size: 12px">--><?php //echo translate('change_password')?><!--</b>-->
<!--                </a>-->
<!--                --->
<!--                <div class="text-center pt-3 pb-0">-->
<!--                    --><?php //if($this->db->get_where("member", array("member_id" => $this->session->userdata('member_id')))->row()->is_closed == 'yes'){?>
<!--                        <a onclick="profile_load('reopen_account')">-->
<!--                        <i class="fa fa-unlock"></i>-->
<!--                        --><?php //echo translate('re-open_account?')?>
<!--                    </a>-->
<!--                    --><?php //}else{?>
<!--                        <a onclick="profile_load('close_account')">-->
<!--                            <i class="fa fa-lock"></i>-->
<!--                            --><?php //echo translate('close_account')?>
<!--                        </a>-->
<!--                    --><?php //} ?>
<!--                </div>-->
<!--                -->
<!--            </div>-->
<!--        </div>-->
    </div>
</div>
<link rel="stylesheet" href="<?=base_url()?>template/front/css/croppie.css" type="text/css">
<script src="<?=base_url()?>template/front/js/croppie.js"></script>
<script>

    //User Block feature
    $(document).ready(function () {
        $(document).on('click', '.changeStatus', function () {
            $(".changeStatus").fadeOut(function () {
                // var token = $('meta[name="csrf-token"]').attr('content');
                var to_member = $(this).data('id');
                console.log(to_member);

                $.ajax({
                    method: 'post',
                    url: "<?=base_url()?>home/toggleBtn/"+to_member,
                    data: {
                        to_member: to_member,
                        // _token: token
                    },
                    cache: false,
                    success: function (result) {

                        return location.reload();

                    },
                    error: function () {
                        console.log("AJAX error");
                    }
                });
            });
        });

        var pathname = new URL(window.location.href).pathname;
        param = pathname.split("/")
        
        if (param[4] === "platinumPlan")
        {
            setTimeout(function(){
                document.getElementById("my_packages").click();
            },1000)
        }
    });

    $(function (){
        $(document).on("click", ".removeFromList", function(e){
            var value = $(this).parent().text();
            var id = this.id;

            $(this).parent().remove();

            formData = {'value':value, 'id':id}

            $.ajax({
                method: 'post',
                dataType:'text',
                data: formData,
                url: "<?=base_url()?>home/unblock/",
                success: function (result) {

                    return location.reload();

                },
                error: function () {
                    console.log("AJAX error");
                }
            });

        });
    });

    //User Interest Email feature
    $(document).ready(function () {
        $(document).on('click', '.interestStatus', function () {
            $(".interestStatus").fadeOut(function () {
                // var token = $('meta[name="csrf-token"]').attr('content');
                var by_member = $(this).data('id');
                console.log(by_member);

                $.ajax({
                    method: 'post',
                    url: "<?=base_url()?>home/toggleInterest/"+by_member,
                    data: {
                        by_member: by_member,
                        // _token: token
                    },
                    cache: false,
                    success: function (result) {

                        return location.reload();

                    },
                    error: function () {
                        console.log("AJAX error");
                    }
                });
            });
        });
    });

    $("#profile_image").change(function () {
        readURL(this);
    });
    function readURL(input) {

        $('#show_img_click').croppie('destroy');
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                // $("#show_img").css({
                //     "background-image" : "url("+ e.target.result +")"
                // });
            $("#save_button_section").show();
            $("#cancel_button_section").show();
            $("#div_show_image").show();
            $('#show_img_click').attr('src', '<?= base_url() ?>uploads/profile_image/default.jpg');
            $("#show_img").hide();
                
                $('#show_img_click').croppie('destroy');
                $('#show_img_click').attr('src', e.target.result);
                var show_img_click = $('#show_img_click').croppie({
                    viewport: {
                        width: 200,
                        height: 200
                    }
                });
                $("#save_image").click(function() {
                    console.log('yes');
                    show_img_click.croppie('result', 'blob').then(function(blob) {
                        console.log(blob);
                        var formData = new FormData();
                        formData.append('file',$('#profile_image')[0].files[0],'a.jpg');
                        // formData.append('croppedImage', blob);
                        formData.append('profile_image', blob, 'a.jpg');
                        $.ajax({
                            method: 'POST',

                            url: '<?=base_url()?>home/profile/update_image',
                            data:formData,
                            processData: false,
                            contentType: false,
                            // xhrFields: {
                            //     responseType: 'blob'
                            // },
                            success: function(response){
                              
                                return location.reload();
                            },
                            error: function(blob){
                                console.log(blob);
                            }
                        });

                    });
                })

                $('#cancel_image').click(function(){
                    location.reload();
                })
                
            }

            reader.readAsDataURL(input.files[0]);


        }
    }
    // $("#save_image").click(function(e) {
    //     e.preventDefault();
    //     // alert('asdas');
    //     $("#profile_image_form").submit();
    // })
        $("#profile_Image_upload").click(function(e) {
        alert("PHOTO REQUIREMENT:\nIn Color\nClose Up\nClear\nBright\nRecent");
    })
</script>