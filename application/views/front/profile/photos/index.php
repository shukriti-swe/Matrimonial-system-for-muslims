<div class="card-title card-bg-c">
	<div class="d-flex">
		<div class="flex-fill">
			<button type="button" class="btn btn-light btn-sm btn-icon-only btn-shadow mt-2" onclick="return location.reload();">
				<span><i class="ion-arrow-left-c"></i></span> Back
			</button></div>
		<div class="flex-fill">
			<h4 class="heading heading-6 text-left">
				UPLOAD PHOTO(S)
			</h4>
		</div>
	</div>
</div>

<div class="card-body masonry-container">
	<div class="masonry-filter-menu mb-4">
		<br />
		<span class="masonry-filter-menu mb-4" style="padding-left: 20px;">
			NOTE: All photos must be: <br> </span>
		<span style="margin-left: 12.8%;">1. Recent 1-3 months<br></span>
		<span style="margin-left: 12.8%;">2. Color only <br></span>
		<span style="margin-left: 12.8%;">3. Close up<br></span>
		<span style="margin-left: 12.8%;">4. Clear<br></span>
		<span style="margin-left: 12.8%;">5. Bright<br></span>
		<div class="row">
			<span style="margin-left: 14.4%;">6. Only you in picture
				<br /> 7. NO side profiles</span>
			<br /><br />

		</div>
		<span style="margin-left: 12.8%;">8. NO more than 2 MB<br></span>
	</div>

	<div class="col-md-12 masonry">
		<?php
		$member_id = $this->session->userdata('member_id');
		$gallery_data = $this->db->get_where("gallery_items", array("member_id" => $member_id, "item_type" => "gallery_image", "is_approved" => 1))->result();
		if (!empty($gallery_data)) {
			foreach ($gallery_data as $value) {
		?>
					<div class="masonry-item col-lg-6 design" id="div_index_<?= $value->item_id ?>">
						<div class="block block--style-3 block--style-3-v2">
							<div class="block-image relative">
								<div class="view view-second view--rounded light-gallery">
									<?php
									if (file_exists('uploads/gallery_image/'. $member_id ."/". $value->item_name)) {
									?>
										<img src="<?= base_url() ?>uploads/gallery_image/<?= $member_id."/".$value->item_name ?>" style="max-height: 302px;">
										<div class="mask mask-base-1--style-2">
											<div class="view-buttons text-center">
												<div class="view-buttons-inner text-center">
													<a target="_blank" href="<?= base_url() ?>uploads/gallery_image/<?= $member_id."/".$value->item_name ?>" class="c-white mr-2 l-gallery" data-toggle="light-gallery">
														<i class="fa fa-search"></i>
													</a>
													<a class="c-white ml-2" onclick="return confirm_delete(<?= $value->item_id ?>)">
														<i class="fa fa-trash"></i>
													</a>
												</div>
											</div>
										</div>
									<?php
									} else {
									?>
										<img src="<?= base_url() ?>uploads/gallery_image/default_image.png" style="max-height: 302px;">
									<?php
									}
									?>
								</div>
							</div>
							<div class="pt-1 text-center">
								<h4 class="heading heading-6 strong-500 mb-0">
									<a target="_blank" href="<?= base_url() ?>uploads/gallery_image/<?= $member_id."/".$value->item_name ?>"><?= $value->image_title?></a>
								</h4>
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
				<a href="#" class="btn btn-styled btn-md btn-base-1 z-depth-2-bottom w-50" data-filter="*" onclick="gallery_load('gallery_upload')">Upload Photo(s)</a>
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
			// alert('here');
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
				$("#modal_body").html("<p class='text-center'><?php echo translate('please_log_in_to_delete_this_image') ?></p>");
				$("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%'>Close</button> <a href='<?= base_url() ?>home/login' class='btn btn-sm btn-base-1 btn-shadow' style='width:25%'>Log In</a>");
			} else {
				$("#active_modal").modal("toggle");
				$("#modal_header").html("Confirm Delete");
				$("#modal_body").html("<p class='text-center'><?php echo translate('are_you_sure_that_you_want_to_delete_this_image') ?>?</p>");
				$("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%'>Close</button> <a href='#' id='confirm_delete' class='btn btn-sm btn-base-1 btn-shadow' onclick='return delete_gallery_img(" + index + ")' style='width:25%'>Confirm</a>");
			}
		}

		function delete_gallery_img(index) {
			$("#confirm_delete").removeAttr("onclick");
			$("#confirm_delete").html("<i class='fa fa-refresh fa-spin'></i> <?php echo translate('processing') ?>..");
			setTimeout(function() {
				$.ajax({
					type: "POST",
					url: "<?= base_url() ?>home/delete_gallery_img/" + index,
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