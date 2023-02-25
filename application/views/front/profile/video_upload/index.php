<div class="card-title card-bg-c">
<div class="d-flex">
		<div class="flex-fill">
			<button type="button" class="btn btn-light btn-sm btn-icon-only btn-shadow mt-2" onclick="return location.reload();">
				<span><i class="ion-arrow-left-c"></i></span> Back
			</button></div>
		<div class="flex-fill">
			<h4 class="heading heading-6 text-left">
			UPLOAD YOUR VIDEO
			</h4>
		</div>
	</div>

</div>
<br />
<div class="card-body">
<form class="form-inline cssform p-4" name="property" id="property" method="POST" action="<?php echo base_url() ?>home/video_upload" enctype="multipart/form-data">
		<b>Select Video:</b>
		<div class="input-group mb-2 mr-sm-2">
			<input type="file" id="video" name="video">
		</div>

		<div class="form-check mb-2 mr-sm-2">
			<input type="submit" id="submit_button" name="submit" hidden value="Submit" />
		</div>
	</form>
    <!-- <form class="cssform" name="property" id="property" method="POST" style="margin-left: 5%;" action="<?php echo base_url()?>home/video_upload"  enctype="multipart/form-data" >
 <table>
 <tr>
  <td><b>Select Video:</b></td>
  <td><input type="file" id="video" name="video" ></td>
 </tr>
 <tr>
  <td> <input type="submit" id="submit_button" name="submit" hidden value="Submit" /></td>
 </tr>
</table>
</form> -->
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
    var rem_video = parseInt("<?=$this->Crud_model->get_type_name_by_id('member', $this->session->userdata('member_id'), 'video_gallery')?>");
    var membership = parseInt("<?= $this->Crud_model->get_type_name_by_id('member', $this->session->userdata('member_id'), 'membership') ?>");

    function confirm_gallery_upload(id) {
        // alert(id);
        if (isloggedin == "") {
            $("#active_modal").modal("toggle");
            $("#modal_header").html("<?php echo translate('please_log_in')?>");
            $("#modal_body").html("<p class='text-center'><?php echo translate('please_log_in_to_upload_images_in_gallery')?></p>");
            $("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%; background-color: #E91E63'>Close</button> <a href='<?=base_url()?>home/login' class='btn btn-sm btn-base-1 btn-shadow' style='width:25%; background-color: #E91E63'><?php echo translate('log_in')?></a>");
        }
        else {
            if (rem_video != 1) {
                if (membership == 1) {
                    $("#active_modal").modal("toggle");
                    $("#modal_header").html("<?php echo translate('purchase_the_platinum_package')?>");
                    $("#modal_body").html("<p class='text-center'><b><?php echo translate('only_1_video_can_be_uploaded')?></b></p>");
                    $("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%; background-color: #E91E63; color:white;'>Close</button> <a onclick='profile_load(\"my_packages\"),modalClose()' class='btn btn-sm btn-base-1 btn-shadow' style='width:25%; background-color: #E91E63;color:white;'><?php echo translate('view_platinum')?></a>");
                }
                else if (membership > 1) {
                    $("#active_modal").modal("toggle");
                    $("#modal_header").html("<span style='color:red;'><?php echo translate('your_video_submission_limit_has_been_reached') ?><span>");
                    $("#modal_body").html("<p class='text-center' style='color:black;'><b><?php echo translate('only_1_video_can_be_uploaded') ?></b></p>");
                    $("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%; background-color: #E91E63'>Close</button>");
                }
            }
            else {
                $("#active_modal").modal("toggle");
                $("#modal_header").html("<p style='color: black; font-weight:700'> <?php echo 'CONFIRM GALLERY UPLOAD'?></p>");
                $("#modal_body").html("");
                $("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%; background-color: #E91E63'>Close</button> <a href='#' id='confirm_gallery_upload' class='btn btn-sm btn-base-1 btn-shadow' onclick='return do_gallery_upload("+id+")' style='width:25%; background-color: #E91E63; color:white;'><?php echo translate('confirm')?></a>");
            }
        }
        return false;
    }

    function do_gallery_upload(id) {
        if ($("#video").val() === ''){
            alert("Please select a video before proceeding!");
        }
        // alert(id);
        if (isloggedin != "" && $("#video").val() != '') {
            $("#confirm_gallery_upload").removeAttr("onclick");
            $("#confirm_gallery_upload").html("<i class='fa fa-refresh fa-spin'></i> <?php echo translate('processing');?>..");
            setTimeout(function() {
                $("#active_modal .close").click();
                $('#submit_button').trigger('click');
            }, 500); // <-- time in milliseconds
        }
        return false;
    }

    function modalClose()
    {
        $("#active_modal").modal("toggle");
    }
</script>