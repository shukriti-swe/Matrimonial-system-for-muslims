<div class="card-title card-bg-c">
	<div class="d-flex">
		<div class="flex-fill">
			<button type="button" class="btn btn-light btn-sm btn-icon-only btn-shadow mt-2" onclick="return location.reload();">
				<span><i class="ion-arrow-left-c"></i></span> Back
			</button></div>
		<div class="flex-fill">
			<h4 class="heading heading-6 text-left">
			CHANGE PASSWORD
			</h4>
		</div>
	</div>
</div>
<div id="ajax_alert"></div>
<div class="card-body">
	<form class="form-default col-12" id="change_password_form" method="post" role="form">
		<div class="row mt-3">
			<div class="col-md-10 ml-auto mr-auto">
				<div class="form-group has-feedback">
					<label for="current_password" class="control-label" style="color: black; font-size: 14px;"><b>CURRENT PASSWORD</b> <span class="text-danger">*</span></label>
					<input type="password" class="form-control" name="current_password" id="current_password" required>
					<span class="glyphicon form-control-feedback" id="current_password_alert" aria-hidden="true" style="color: red;"></span>
				</div>
			</div>
			<div class="col-md-10 ml-auto mr-auto">
				<div class="form-group has-feedback">
					<label for="new_password" class="control-label" style="color: black; font-size: 14px;"><b>NEW PASSWORD</b> <span class="text-danger">*</span></label>
					<input type="password" class="form-control" name="new_password" id="new_password" required>
					<span class="glyphicon form-control-feedback" id="new_password_alert" aria-hidden="true" style="color: red;"></span>
				</div>
			</div>
			<div class="col-md-10 ml-auto mr-auto">
				<div class="form-group has-feedback">
					<label for="confirm_password" class="control-label" style="color: black; font-size: 14px;"><b>CONFIRM PASSWORD</b> <span class="text-danger">*</span></label>
					<input type="password" class="form-control" name="confirm_password" id="confirm_password" required>
					<span class="glyphicon form-control-feedback" id="confirm_password_alert" aria-hidden="true" style="color: red;"></span>
				</div>
			</div>

		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="form-group has-feedback text-center">
					<div class="text-danger" id="validation_error">
						<!-- Shows Validation Errors -->
					</div>

					<div class="text-center m-4">
						<button type="button" class="btn btn-styled btn-md btn-base-1 z-depth-2-bottom w-50" id="btn_pass"><?php echo translate('save') ?>
						</button>
					</div>

				</div>
			</div>
		</div>
	</form>
</div>

<script>
	$(document).ready(function() {
		var current_pass = "";
		var new_pass = "";
		var confirm_pass = "";

		// function btn_state() {
		// 	if (new_pass == confirm_pass && (new_pass != '' || confirm_pass != '')) {
		// 		$("#btn_pass").removeAttr("disabled");
		// 	} else {
		// 		$("#btn_pass").attr("disabled", "disabled");
		// 	}
		// }

		// $("#confirm_password").keyup(function() {
			
		// 	// btn_state();
		// });

		// $("#current_password").keyup(function() {
		// 	current_pass = $("#current_password").val();
		// 	if (current_pass == '') {
		// 		alert('Current password field must not be empty!');
		// 	}
		// });

		// $("#new_password").keyup(function() {
		// 	confirm_pass = $("#confirm_password").val();
		// 	new_pass = $("#new_password").val();

		// 	if (new_pass == '') {
		// 		alert('New password field must not be empty!');
		// 	}
		// 	if (confirm_pass != new_pass) {
		// 		// alert('Your passwords do not match!');
		// 		$("#confirm_password").css("border", "1px solid #e33244");
		// 	} else if (confirm_pass == new_pass) {
		// 		// alert('yes');
		// 		$("#confirm_password").css("border", "1px solid #71ba51");
		// 	}
		// 	btn_state();
		// });

		$("#btn_pass").click(function() {

			var $current_password_alert = $("#current_password_alert");
			var $new_password_alert = $("#new_password_alert");
			var $confirm_password_alert = $("#confirm_password_alert");

			$("#current_password_alert").text("");
			$("#new_password_alert").text("");
			$("#confirm_password_alert").text("");

			var current_pass = $("#current_password").val();
			var new_pass = $("#new_password").val();
			var confirm_pass = $("#confirm_password").val();

			var isSuccess = true;

			if (current_pass.trim() == "") {
				isSuccess = false;
				$current_password_alert.text("This field is required");
				$("#current_password").addClass('border-danger');
				return;
			}
			if (new_pass.trim() == "") {
				isSuccess = false;
				$new_password_alert.text("This field is required");
				$("#new_password").addClass('border-danger');
				return;
			}
			if (confirm_pass.trim() == "") {
				isSuccess = false;
				$confirm_password_alert.text("This field is required");
				$("#confirm_password").addClass('border-danger');
				return;
			}

			if (confirm_pass.trim() != new_pass.trim())
			{
				isSuccess = false;
				$confirm_password_alert.text("New password and Confirm password does not match");
			}
			if (isSuccess == true) {
				$('#btn_pass').html("<i class='fa fa-refresh fa-spin'></i> <?php echo translate('processing') ?>...");
				$.ajax({
					type: "POST",
					url: "<?= base_url() ?>home/profile/update_password",
					cache: false,
					data: $('#change_password_form').serialize(),
					success: function(response) {
						// if (IsJsonString(response)) {
						// 	// Re_Enabling the Elements
						// 	$('#btn_pass').html("<?php echo translate('save') ?>");
						// 	// Displaying Validation Error for ajax submit
						// 	// alert('TRUE');
						// 	var JSONArray = $.parseJSON(response);
						// 	var html = "";
						// 	$.each(JSONArray, function(row, fields) {
						// 		// alert(fields['ajax_error']);
						// 		html = fields['ajax_error'];
						// 	});
						// 	$('#validation_info').html(html);
						// 	$('#ajax_validation_alert').show();
						// 	$('#change_password_form').trigger("reset");
						// 	setTimeout(function() {
						// 		$('#ajax_validation_alert').fadeOut('fast');
						// 	}, 5000); // <-- time in milliseconds
						// } else {
							console.log(response);
							if (response == "true") {
								// Loading the specific Section Area
								$('#btn_pass').html("<?php echo translate('save') ?>");
								$('#change_password_form').trigger("reset");
								// $("#confirm_password").css("border", "1px solid #e6e6e6");

								$('#ajax_alert').html("<div class='alert alert-success fade show' role='alert'><?php echo translate('you_have_successfully_updated_your_password!') ?></div>");
								$('#ajax_alert').show();
								setTimeout(function() {
									$('#ajax_alert').fadeOut('fast');
								}, 5000); // <-- time in milliseconds
								window.location.reload();
							}
							if (response == "false"){
								$('#btn_pass').html("<?php echo translate('save') ?>");
								$('#change_password_form').trigger("reset");
								
								$('#ajax_alert').html("<div class='alert alert-success fade show' role='alert'><?php echo translate('invalid_current_password!') ?></div>");
								$('#ajax_alert').show();
								setTimeout(function() {
									$('#ajax_alert').fadeOut('fast');
								}, 5000); // <-- time in milliseconds
							}
						// }
					},
					fail: function(error) {
						alert(error);
					}
				});
			}
		});

		function IsJsonString(str) {
			try {
				JSON.parse(str);
			} catch (e) {
				return false;
			}
			return true;
		}
	});
</script>