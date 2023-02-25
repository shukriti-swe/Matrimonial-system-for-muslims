<div class="card-title card-bg-c">
	<div class="d-flex">
		<div class="flex-fill">
			<button type="button" class="btn btn-light btn-sm btn-icon-only btn-shadow mt-2" onclick="return location.reload();">
				<span><i class="ion-arrow-left-c"></i></span> Back
			</button></div>
		<div class="flex-fill">
			<h4 class="heading heading-6 text-left">
				UPLOAD YOUR IMAGE
			</h4>
		</div>
	</div>
</div>
<br />
<div class="card-body">
	<form class="form-default col-12" id="gallery_upload_form" method="post" action="<?= base_url() ?>home/gallery_upload/add" role="form" enctype="multipart/form-data">
		<div class="form-group has-feedback col-10 ml-auto mr-auto">
			<label class="control-label"><?php echo translate('image_title') ?></label>
			<input type="text" id="photo_upload_title" name="title" class="form-control">
		</div>
		<div class="form-group has-feedback col-10 ml-auto mr-auto select_div" id="img_main">
			<label class="control-label"><?php echo translate('upload_image') ?></label>
			<div class="col-sm-12" style="margin:2px; padding:2px;">
				<img class="img-responsive img-border blah z-depth-1-bottom" style="width: 100%;border: 1px solid #e6e6e6;" src="<?= base_url() ?>uploads/happy_story_image/default_image.jpg" class="img-sm">
			</div>
			<label for="image_main" class="control-label">
				<a class="btn btn-styled btn-xs btn-base-2 btn-shadow ml-1" style="color: #FFF"><?php echo translate('select_a_photo') ?></a>
			</label>
			<input type="file" id="image_main" name="image" class="form-control imgInp" style="display: none" required>
		</div>
		<!-- <div class="form-group has-feedback col-10 ml-auto mr-auto select_div" id="img_main">
            <div class="col-12">
                <small class="text-danger" id="val_error">
                </small>
            </div>
        </div> -->
		<div class="form-group has-feedback col-10 ml-auto mr-auto text-center mt-5">
			<a href="#" class="btn btn-sm btn-danger btn-shadow" data-filter="*" style="background-color: #E91E63" onclick="profile_load('photos')"><?php echo translate('go_back') ?></a>
			<button type="submit" id="btn_gallery_upload" class="btn btn-sm btn-base-1 btn-shadow" data-filter="*" style="display: none;"><?php echo translate('upload') ?></button>
			<a id="submit_gallery" class="btn btn-sm btn-base-1 btn-shadow" onclick="return confirm_gallery_upload(<?= $this->session->userdata('member_id') ?>)" style="color: white"><?php echo translate('upload') ?></a>
		</div>
	</form>
</div>
<script>
	$('.swiper-container').swiper();
	// SCRIT FOR IMAGE UPLOAD
	function readURL_all(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('.select_div').find('.blah').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	$("#img_main").on('change', '.imgInp', function() {
		readURL_all(this);
	});

	// var imgTag = document.getElementById('image_main')

	// imgTag.onclick = charge

	// function charge() {
	// 	document.body.onfocus = roar
	// }

	// function roar() {
	// 	if (imgTag.value.length)
	// 		document.body.onfocus = null
	// 	$('.select_div').find('.blah').attr('src', '<?= base_url() ?>uploads/happy_story_image/default_image.jpg');
	// }
</script>
<script>
	var isloggedin = "<?= $this->session->userdata('member_id') ?>";
	var rem_photos = parseInt("<?= $this->Crud_model->get_type_name_by_id('member', $this->session->userdata('member_id'), 'photo_gallery') ?>");
	var membership = parseInt("<?= $this->Crud_model->get_type_name_by_id('member', $this->session->userdata('member_id'), 'membership') ?>");

	function confirm_gallery_upload(id) {
		// alert(id);
		if (isloggedin == "") {
			$("#active_modal").modal("toggle");
			$("#modal_header").html("<?php echo translate('please_log_in') ?>");
			$("#modal_body").html("<p class='text-center'><?php echo translate('please_log_in_to_upload_images_in_gallery') ?></p>");
			$("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%; background-color: #E91E63'>Close</button> <a href='<?= base_url() ?>home/login' class='btn btn-sm btn-base-1 btn-shadow' style='width:25%; background-color: #E91E63'><?php echo translate('log_in') ?></a>");
		} else {
			if (rem_photos <= 0) {
				if (membership == 1) {
					$("#active_modal").modal("toggle");
					$("#modal_header").html("<?php echo translate('purchase_the_platinum_package') ?>");
					$("#modal_body").html("<p class='text-center'><b><?php echo translate('remaining_gallery_upload(s): ') ?>" + rem_photos + " </b></p>");
					$("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%; background-color: #E91E63'>Close</button> <a onclick='profile_load(\"my_packages\"),modalClose()' class='btn btn-sm btn-base-1 btn-shadow' style='width:25%; background-color: #E91E63;color:white;'><?php echo translate('view_platinum') ?></a>");
				}
				else if (membership > 1) {
					$("#active_modal").modal("toggle");
					$("#modal_header").html("<span style='color:red;'><?php echo translate('your_picture_submission_limit_has_been_reached') ?><span>");
					$("#modal_body").html("<p class='text-center' style='color:black;'><b><?php echo translate('remaining_gallery_upload(s): ') ?>" + rem_photos + " </b></p>");
					$("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%; background-color: #E91E63'>Close</button>");
				}
			} else {
				$("#active_modal").modal("toggle");
				$("#modal_header").html("<p style='color: black; font-weight:700'> <?php echo 'CONFIRM GALLERY UPLOAD' ?></p>");
				$("#modal_body").html("");
				$("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%; background-color: #E91E63'>Close</button> <a href='#' id='confirm_gallery_upload' class='btn btn-sm btn-base-1 btn-shadow' onclick='return do_gallery_upload(" + id + ")' style='width:25%; background-color: #E91E63'><?php echo translate('confirm') ?></a>");
			}
		}
		return false;
	}

	function do_gallery_upload(id) {

		if ($("#image_main").val() === '') {
			alert("Please select an Image before proceeding!");
		}
		// alert(id);
		if (isloggedin != "") {
			$("#confirm_gallery_upload").removeAttr("onclick");
			$("#confirm_gallery_upload").html("<i class='fa fa-refresh fa-spin'></i> <?php echo translate('processing'); ?>..");
			setTimeout(function() {
				$("#active_modal .close").click();
				$("#btn_gallery_upload").click();
			}, 500); // <-- time in milliseconds
		}
		return false;
	}
	function modalClose()
    {
        $("#active_modal").modal("toggle");
    }
</script>