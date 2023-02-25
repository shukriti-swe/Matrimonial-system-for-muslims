<div class="card-title">
    <center>
    <h3 class="heading heading-6 strong-500">
    <b><?php echo translate('gallery')?></b></h3>
    </center>
</div>
<div class="card-body masonry-container">
    <div class="masonry-filter-menu text-center mb-4">
	<span class="masonry-filter-menu text-center mb-4">All photos must be in color, close up, clear, bright, try not to have others in your picture, NO side profiles please, and all photos must be recent (1-3months).</span><br/>
        <a href="#" class="btn btn-styled btn-xs btn-base-1 btn-shadow" data-filter="*" onclick="gallery_load('gallery_upload')"><?php echo translate('upload_image')?></a>
    </div>
    <section class="slice sct-color-1">
        <div class="container">
            <div class="row masonry">
                <?php 
                    $get_gallery = $this->db->get_where("member", array("member_id" => $this->session->userdata('member_id')))->row()->gallery;
                    $gallery_data = json_decode($get_gallery, true);
                    if (!empty($gallery_data)) {
                        foreach ($gallery_data as $value) {
						if ($value['image'] != ''){
                        ?>
                            <div class="masonry-item col-lg-6 design" id="div_index_<?=$value['index']?>">
                                <div class="block block--style-3 block--style-3-v2">
                                    <div class="block-image relative">
                                        <div class="view view-second view--rounded light-gallery">
                                        <?php
                                            if (file_exists('uploads/gallery_image/'.$value['image'])) {
                                            ?>
                                                <img src="<?=base_url()?>uploads/gallery_image/<?=$value['image']?>" style="max-height: 302px;">
                                                <div class="mask mask-base-1--style-2">
                                                    <div class="view-buttons text-center">
                                                        <div class="view-buttons-inner text-center">
                                                            <a target="_blank" href="<?=base_url()?>uploads/gallery_image/<?=$value['image']?>" class="c-white mr-2 l-gallery" data-toggle="light-gallery">
                                                                <i class="fa fa-search"></i>
                                                            </a>
                                                            <a class="c-white ml-2" onclick="return confirm_delete(<?=$value['index']?>)">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
                                            }
                                            else {
                                            ?>
                                                <img src="<?=base_url()?>uploads/gallery_image/default_image.png" style="max-height: 302px;">
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
	    <div class="masonry-filter-menu text-center mb-4">
	        <span>Video should be 45/30 sec long with basic intro. Only mp4 format is only supported</span><br/>
        <a href="#" class="btn btn-styled btn-xs btn-base-1 btn-shadow" data-filter="*" onclick="gallery_load('video_upload')"><?php echo "Upload Video"?></a><br/>

    </div>
	  <section class="slice sct-color-1">
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
        // alert('here');
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