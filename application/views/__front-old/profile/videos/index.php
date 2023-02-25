<div class="card-title" style="padding: 0.8em; text-align: center; background-color: #E91E63;">
    <h3 class="heading heading-6 strong-500">
        <b style="font-size: 25px !important;"> UPLOAD VIDEO </b></h3>
</div>
<br />

<div class="card-body">
    <span style="margin-left: 6%;">NOTE: Only 30sec. or less will be uploaded <br><br /></span>
    <div class="row">
        <div class="col styling">
            Your Video must be:  <br /><br />
            1. Only mp4 format is supported<br>
            2. Only 1 video/member <br>
            3. Length 30 sec.<br>
            4. Show close-up & far views <br>
            5. Well-lit room<br>
            6. Only you in the video<br>
        </div>
        <div class="col" style="margin-bottom: 2%;">
            When recording, please say: <br /><br />
            1. First Name ONLY (optional)<br>
            2. Age <br>
            3. Profession<br>
            4. State <br>
            5. Brief description of self<br>
            6. Spouse preference<br>
        </div>
        <br/><br/>
    </div>

    <style>
        .styling{
            margin-left: 8%;
        }
    </style>
    <a href="#" class="btn btn-styled btn-xs btn-base-1 btn-shadow" style="color: white; width: 110px;
       margin-left: 65%;" data-filter="*" onclick="gallery_load('video_upload')"><?php echo "Upload Video"?></a><br/>

</div>
<section class="slice sct-color-1" style="padding-bottom: 0 !important;">
    <div class="container">
        <div class="row masonry">
            <?php
            $get_gallery = $this->db->get_where("member", array("member_id" => $this->session->userdata('member_id')))->row()->gallery;
            $gallery_data = json_decode($get_gallery, true);
            if (!empty($gallery_data)) {
                foreach ($gallery_data as $value) {
                    if ($value['video'] != ''){
                        ?>

                        <div class="masonry-item col-lg-6 design" id="div_index_<?=$value['index']?>">
                            <div class="block block--style-3 block--style-3-v2">
                                <div class="block-image relative">
                                    <div class="view view-second view--rounded light-gallery">
                                        <?php

                                        if (file_exists('video/'.$value['video'].'.mp4')) {
                                            ?>
                                            <video width="320" height="240" controls>

                                                <source src="<?php echo base_url()."video/".$value['video'].".mp4" ?>" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                            <a class="" onclick="return confirm_delete(<?=$value['index']?>)">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                            <?php
                                        }
                                        else {
                                            ?>

                                            <?php
                                        }
                                        ?>
                                    </div>

                                </div>
                                <div class="pt-1 text-center">
                                    <h4 class="heading heading-6 strong-500 mb-0">
                                        <a target="_blank" href="<?=base_url()?>uploads/gallery_image/<?=$value['image']?>"><?=$value['title']?></a>
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
            } else {
                ?>

                <?php
            }
            ?>
        </div>
    </div>
</section>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $(".l-gallery").click(function(){
            // $(".light-gallery").lightGallery();
        })
    });
</script>

<script>
    // lightGallery(document.getElementsByClassName("l_g"));
    function gallery_load(page){
        // alert(page);
        $.ajax({
            url: "<?=base_url()?>home/profile/"+page,
            success: function(response) {
                $("#profile_load").html(response);
            }
        });
    }

    var isloggedin = "<?=$this->session->userdata('member_id')?>";

    function confirm_delete(index) {
        if (isloggedin == "") {
            $("#active_modal").modal("toggle");
            $("#modal_header").html("Please Login");
            $("#modal_body").html("<p class='text-center'><?php echo translate('please_log_in_to_delete_this_image')?></p>");
            $("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%'>Close</button> <a href='<?=base_url()?>home/login' class='btn btn-sm btn-base-1 btn-shadow' style='width:25%'>Log In</a>");
        }
        else {
            $("#active_modal").modal("toggle");
            $("#modal_header").html("Confirm Delete");
            $("#modal_body").html("<p class='text-center'><?php echo translate('are_you_sure_that_you_want_to_delete_this_image')?>?</p><span style='color:#DC0330;font-size:11px'>**N.B. <?php echo translate('deleting_an_image_will_not_refund_your_remaining_gallery_capacity');?>**</span>");
            $("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%'>Close</button> <a href='#' id='confirm_delete' class='btn btn-sm btn-base-1 btn-shadow' onclick='return delete_gallery_img("+index+")' style='width:25%'>Confirm</a>");
        }
    }

    function delete_gallery_img(index) {
        $("#confirm_delete").removeAttr("onclick");
        $("#confirm_delete").html("<i class='fa fa-refresh fa-spin'></i> <?php echo translate('processing')?>..");
        setTimeout(function() {
            $.ajax({
                type: "POST",
                url: "<?=base_url()?>home/delete_gallery_img/"+index,
                cache: false,
                success: function(response) {
                    $("#active_modal .close").click();
                    $('#div_index_'+index).remove();
                    $("#success_alert").show();
                    $(".alert-success").html("You Have Deleted This Gallery Item!");
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
</script>