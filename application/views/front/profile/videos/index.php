<div class="card-title card-bg-c">
	<div class="d-flex">
		<div class="flex-fill">
			<button type="button" class="btn btn-light btn-sm btn-icon-only btn-shadow mt-2" onclick="return location.reload();">
				<span><i class="ion-arrow-left-c"></i></span> Back
			</button></div>
		<div class="flex-fill">
			<h4 class="heading heading-6 text-left">
				UPLOAD VIDEO
			</h4>
		</div>
	</div>
</div>
<br />

<div class="card-body">
	<!-- <span style="margin-left: 6%;">NOTE: Only 30sec. or less will be uploaded <br><br /></span> -->
	<div class="row p-4">
		<div class="col-md-6">
			Your Video must be: <br /><br />
			1. Only mp4 format is supported<br>
			2. Only 1 video/member <br>
			3. Length 30 sec.<br>
			4. Show close-up & far views <br>
			5. Well-lit room<br>
			6. Only you in the video<br>
			7. The maximum video size is 10 MB<br>
		</div>
		<div class="col-md-6">
			When recording, please say: <br /><br />
			1. First Name ONLY (optional)<br>
			2. Age <br>
			3. Profession<br>
			4. State <br>
			5. Brief description of self<br>
			6. Spouse preference<br>
		</div>
	</div>
	<div class="col-md-12 masonry">
		<?php
		$member_id = $this->session->userdata('member_id');
		$gallery_data = $this->db->get_where("gallery_items", array("member_id" => $member_id, "item_type" => "gallery_video", "is_approved" => 1))->result();
		if (!empty($gallery_data)) {
			foreach ($gallery_data as $key => $value) {
		?>

					<div class="masonry-item col-lg-6 design" id="div_index_<?= $value->item_id ?>">
						<div class="block block--style-3 block--style-3-v2">
							<div class="block-image relative">
								<div class="view view-second view--rounded light-gallery">
									<?php

									if (file_exists('video/'. $member_id . "/" . $value->item_name)) {
									?>
										<video width="320" height="240" controls>

											<source src="<?php echo base_url() . "video/". $member_id . "/" . $value->item_name?>">
											Your browser does not support the video tag.
										</video>
										<a onclick="return confirm_delete(<?= $value->item_id ?>)">
											<i class="fa fa-trash"></i>
										</a>
									<?php
									} else {
									?>

									<?php
									}
									?>
								</div>
							</div>
						</div>
					</div>
			<?php
			}
		} else {
			?>

		<?php
		}
		?>
	</div>

	<div class="col-md-12">
		<div class="block">
			<div class="text-center m-4">
				<a href="#" class="btn btn-styled btn-md btn-base-1 z-depth-2-bottom w-50" data-filter="*" onclick="gallery_load('video_upload')"><?php echo "Upload Video" ?></a><br />
			</div>
		</div>
	</div>
</div>

</div>
<script type="text/javascript">
	$(document).ready(function() {
		$(".l-gallery").click(function() {
			// $(".light-gallery").lightGallery();
		})
	});
</script>

<script>
	// lightGallery(document.getElementsByClassName("l_g"));
	function gallery_load(page) {
		// alert(page);
		$.ajax({
			url: "<?= base_url() ?>home/profile/" + page,
			success: function(response) {
				$("#profile_load").html(response);
			}
		});
	}

	var isloggedin = "<?= $this->session->userdata('member_id') ?>";

	function confirm_delete(index) {
		if (isloggedin == "") {
			$("#active_modal").modal("toggle");
			$("#modal_header").html("Please Login");
			$("#modal_body").html("<p class='text-center'><?php echo translate('please_log_in_to_delete_this_video') ?></p>");
			$("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%'>Close</button> <a href='<?= base_url() ?>home/login' class='btn btn-sm btn-base-1 btn-shadow' style='width:25%'>Log In</a>");
		} else {
			$("#active_modal").modal("toggle");
			$("#modal_header").html("Confirm Delete");
			$("#modal_body").html("<p class='text-center'><?php echo translate('are_you_sure_that_you_want_to_delete_this_video') ?>?</p>");

			$("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%'>Close</button> <a href='#' id='confirm_delete' class='btn btn-sm btn-base-1 btn-shadow' onclick='return delete_gallery_img(" + index + ")' style='width:25%'>Confirm</a>");

			$("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%'>Close</button> <a href='#' id='confirm_delete' class='btn btn-sm btn-base-1 btn-shadow' onclick='return delete_gallery_video(" + index + ")' style='width:25%'>Confirm</a>");
		}
	}

	function delete_gallery_video(index) {
		$("#confirm_delete").removeAttr("onclick");
		$("#confirm_delete").html("<i class='fa fa-refresh fa-spin'></i> <?php echo translate('processing') ?>..");
		setTimeout(function() {
			$.ajax({
				type: "POST",
				url: "<?= base_url() ?>home/delete_gallery_video/" + index,
				cache: false,
				success: function(response) {
					$("#active_modal .close").click();
					$('#div_index_' + index).remove();
					$("#success_alert").show();
					$(".alert-success").html("You Have Deleted This Gallery Item!");
					$('#danger_alert').fadeOut('fast');
					setTimeout(function() {
						$('#success_alert').fadeOut('fast');
					}, 5000); // <-- time in milliseconds
				},
				fail: function(error) {
					alert(error);
				}
			});
		}, 500); // <-- time in milliseconds
	}
</script>