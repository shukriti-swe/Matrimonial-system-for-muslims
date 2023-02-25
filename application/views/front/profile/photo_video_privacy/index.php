<?php
$pic_privacy = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'pic_privacy');
$pic_privacy_data = json_decode($pic_privacy, true);
// print_r($pic_privacy_data);exit;
?>
<style>
	.dropdown {
		position: relative;
		display: inline-block;
	}

	.dropdown-content {
		display: none;
		position: absolute;
		background-color: #f9f9f9;
		min-width: 160px;
		box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
		padding: 12px 16px;
		z-index: 1;
	}

	.dropdown:hover .dropdown-content {
		display: block;
	}
</style>

<div class="row">
	<div class="col-lg-3 col-md-4" id="ajax_alert" style="display: none; position: fixed; top: 15px; right: 0; z-index: 9999">
		<div class="alert alert-success fade show" role="alert">
			<?php echo translate('you_have_successfully_updated_picture_privacy!') ?>
		</div>
	</div>
	<div class="col-lg-12">
		<div class="card-title card-bg-c">
			<div class="d-flex">
				<div class="flex-fill">
					<button type="button" class="btn btn-light btn-sm btn-icon-only btn-shadow mt-2" onclick="return location.reload();">
						<span><i class="ion-arrow-left-c"></i></span> Back
					</button></div>
				<div class="flex-fill">
					<h4 class="heading heading-6 text-left">
						PHOTO(S) & VIDEO PRIVACY
					</h4>
				</div>
			</div>
		</div>
		<form class="form-default col-12" method="post" id="picture_privacy_form" role="form">
			<!-- <div class="row"> -->
			<div class="col-md-7 mr-auto mt-4">
				<div class="row mb-3">
					<div class="stats-entry col-md-5">
						<label class="control-label label-lh">Profile Photo:</label>
					</div>
					<div class="stats-entry col-md-7">
						<select class="profilePhoto form-control" name="profile_pic_show">
							<option value="only_me" <?php if ($pic_privacy_data[0]['profile_pic_show'] == 'only_me') {
														echo "selected";
													} ?> class="form-control"><?php echo translate('only_me') ?></option>
							<option value="all" <?php if ($pic_privacy_data[0]['profile_pic_show'] == 'all') {
													echo "selected";
												} ?> class="form-control"><?php echo translate('all_members') ?></option>
							<option value="premium" <?php if ($pic_privacy_data[0]['profile_pic_show'] == 'premium') {
														echo "selected";
													} ?> class="form-control"><?php echo translate('platinum_members') ?></option>
						</select>
					</div>
				</div>
			</div>

			<div class="col-md-7 mr-auto">
				<div class="row mb-3">
					<div class="stats-entry col-md-5">
						<label class="control-label label-lh">Gallery Photo:</label>
					</div>
					<div class="stats-entry col-md-7">
						<select class="form-control" name="gallery_show">
							<option value="only_me" <?php if ($pic_privacy_data[0]['gallery_show'] == 'only_me') {
														echo "selected";
													} ?> class="form-control"><?php echo translate('only_me') ?></option>
							<option value="all" <?php if ($pic_privacy_data[0]['gallery_show'] == 'all') {
													echo "selected";
												} ?> class="form-control"><?php echo translate('all_members') ?></option>
							<option value="premium" <?php if ($pic_privacy_data[0]['gallery_show'] == 'premium') {
														echo "selected";
													} ?> class="form-control"><?php echo translate('platinum_members') ?></option>
						</select>
					</div>
				</div>
			</div>

			<div class="col-md-7 mr-auto">
				<div class="row mb-3">
					<div class="stats-entry col-md-5">
						<label for="delete_photo" class="control-label label-lh" style="color: black;">Gallery Video:</label>
					</div>
					<div class="stats-entry col-md-7">
						<select class="form-control" name="gallery_video">
							<option value="only_me" <?php if ($pic_privacy_data[0]['video_show'] == 'only_me') {
														echo "selected";
													} ?> class="form-control"><?php echo translate('only_me') ?></option>
							<option value="all" <?php if ($pic_privacy_data[0]['video_show'] == 'all') {
													echo "selected";
												} ?> class="form-control"><?php echo translate('all_members') ?></option>
							<option value="premium" <?php if ($pic_privacy_data[0]['video_show'] == 'premium') {
														echo "selected";
													} ?> class="form-control"><?php echo translate('platinum_members') ?></option>
						</select>
					</div>
				</div>
			</div>
			<!-- </div> -->
			<!-- <div class="col"></div> -->
			<div class="col-md-12">
				<div class="block">

					<div class="text-center m-4">
						<button type="button" class="btn btn-styled btn-md btn-base-1 z-depth-2-bottom w-50" id="btn_pic_privacy"><?php echo translate('save') ?></button>
					</div>
				</div>
			</div>

			<div class="col-md-12 col-xs-12">

			</div>
		</form>
	</div>


	<script>
		$(document).ready(function() {
			$("#btn_pic_privacy").click(function() {
				$('#btn_pic_privacy').html("<i class='fa fa-refresh fa-spin'></i> <?php echo translate('processing') ?>...");
				$.ajax({
					type: "POST",
					url: "<?= base_url() ?>home/profile/update_pic_privacy",
					cache: false,
					data: $('#picture_privacy_form').serialize(),
					success: function(response) {

						$('#btn_pic_privacy').html("<?php echo translate('save') ?>");
						// $('#ajax_alert').html("<div class='alert alert-success fade show' role='alert'><?php echo translate('you_have_successfully_edited_picture_privacy!') ?></div>");
						$('#ajax_alert').show();
						setTimeout(function() {
							$('#ajax_alert').fadeOut('fast');
						}, 6000); // <-- time in milliseconds

					},
					fail: function(error) {
						alert(error);
					}
				});
			});
		});
	</script>