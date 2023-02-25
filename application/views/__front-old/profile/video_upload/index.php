<div class="card-title" style="padding: 0.8em; text-align: center; background-color: #E91E63;">
    <h3 class="heading heading-6 strong-500">
        <b style="font-size: 25px !important;"> UPLOAD YOUR VIDEO </b></h3>
</div>
<br />
<div class="card-body">
    <form class="cssform" name="property" id="property" method="POST" style="margin-left: 5%;" action="<?php echo base_url()?>home/video_upload"  enctype="multipart/form-data" >
 <table>
 <tr>
  <td><b>Select Video:</b></td>
  <td><input type="file" id="video" name="video" ></td>
 </tr>
 <tr>
  <td> <input type="submit" id="submit_button" name="submit" hidden value="Submit" /></td>
 </tr>
</table>
</form>
<div class="form-group has-feedback col-10 ml-auto mr-auto text-center mt-5">
            <a href="#" class="btn btn-sm btn-danger btn-shadow" data-filter="*" style="background-color: #E91E63" onclick="profile_load('videos')"><?php echo translate('go_back')?></a>
            <button type="submit" id="btn_gallery_upload" class="btn btn-sm btn-base-1 btn-shadow" data-filter="*" style="display: none;"><?php echo translate('upload')?></button>
            <a id="submit_gallery" class="btn btn-sm btn-base-1 btn-shadow" onclick="return confirm_gallery_upload(<?=$this->session->userdata('member_id')?>)" style="color: white"><?php echo translate('upload')?></a>
        </div>
</div>




<script>
    $('.swiper-container').swiper();
    // SCRIT FOR IMAGE UPLOAD
    function readURL_all(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.select_div').find('.blah').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#img_main").on('change', '.imgInp', function () {
        readURL_all(this);
    });
</script>
<script>

    var isloggedin = "<?=$this->session->userdata('member_id')?>";
    var rem_photos = parseInt("<?=$this->Crud_model->get_type_name_by_id('member', $this->session->userdata('member_id'), 'photo_gallery')?>");

    function confirm_gallery_upload(id) {
        // alert(id);
        if (isloggedin == "") {
            $("#active_modal").modal("toggle");
            $("#modal_header").html("<?php echo translate('please_log_in')?>");
            $("#modal_body").html("<p class='text-center'><?php echo translate('please_log_in_to_upload_images_in_gallery')?></p>");
            $("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%; background-color: #E91E63'>Close</button> <a href='<?=base_url()?>home/login' class='btn btn-sm btn-base-1 btn-shadow' style='width:25%; background-color: #E91E63'><?php echo translate('log_in')?></a>");
        }
        else {
            if (rem_photos <= 0) {
                $("#active_modal").modal("toggle");
                $("#modal_header").html("<?php echo translate('buy_premium_packages')?>");
                $("#modal_body").html("<p class='text-center'><b><?php echo translate('remaining_gallery_upload(s): ')?>"+rem_photos+" <?php echo translate('times')?></b><br><?php echo translate('please_buy_packages_from_the_premium_plans.')?></p>");
                $("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%; background-color: #E91E63'>Close</button> <a href='<?=base_url()?>home/plans' class='btn btn-sm btn-base-1 btn-shadow' style='width:25%; background-color: #E91E63'><?php echo translate('premium_plans')?></a>");
            }
            else {
                $("#active_modal").modal("toggle");
                $("#modal_header").html("<p style='color: black; font-weight:700'> <?php echo 'CONFIRM GALLERY UPLOAD'?></p>");
                $("#modal_body").html("");
                $("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%; background-color: #E91E63'>Close</button> <a href='#' id='confirm_gallery_upload' class='btn btn-sm btn-base-1 btn-shadow' onclick='return do_gallery_upload("+id+")' style='width:25%; background-color: #E91E63'><?php echo translate('confirm')?></a>");
            }
        }    
        return false;
    }

    function do_gallery_upload(id) {
        // alert(id);
        if (isloggedin != "") {
            $("#confirm_gallery_upload").removeAttr("onclick");
            $("#confirm_gallery_upload").html("<i class='fa fa-refresh fa-spin'></i> <?php echo translate('processing');?>..");
            setTimeout(function() {
                $("#active_modal .close").click();
                $('#submit_button').trigger('click');
            }, 500); // <-- time in milliseconds
        }    
        return false;
    }
</script>