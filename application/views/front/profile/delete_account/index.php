<div class="card-title card-bg-c">
	<div class="d-flex">
		<div class="flex-fill">
			<button type="button" class="btn btn-light btn-sm btn-icon-only btn-shadow mt-2" onclick="return location.reload();">
				<span><i class="ion-arrow-left-c"></i></span> Back
			</button></div>
		<div class="flex-fill">
			<h4 class="heading heading-6 text-left">
				DELETE MY ACCOUNT
			</h4>
		</div>
	</div>

</div>
<div class="card-body">

	<div id="main_view">
		<form class="form-default text-center" id="deleteAccountForm" data-toggle="validator" role="form">
			<div class="card-body">
				<div class="row mt-3">
					<div class="col-md-10 ml-auto mr-auto" style="padding-top: 12px; text-align: left; font-size: 12px">
						<div class="form-group has-feedback">
							<label for="current_password" class="control-label" style="color: black; font-size: 14px"><b>CURRENT PASSWORD <span style="color:red">*</span></b></label>
							<input type="password" class="form-control" name="current_password" id="current_password" required>
							<span class="glyphicon form-control-feedback" id="enter_pass" aria-hidden="true" style="color: red; display: none;">Please enter your password</span>
							<br>
							<span class="glyphicon form-control-feedback" id="enter_valid_pass" aria-hidden="true" style="color: red; display: none;">Please enter the correct password to proceed</span>

							<div class="help-block with-errors"></div>
						</div>
					</div>

					<div class="col-md-10 ml-auto mr-auto filter-radio" style="padding-top: 12px; text-align: left; font-size: 12px">
						<label for="reason_for_leaving" class="control-label" style="color: black; text-align:center; font-size: 14px"><b>What are your reasons for leaving? <span style="color:red">*</span></b></label><br>
						<div class="p-2">
							<input type="checkbox" data-id="1" class="reason" name="dltReason" value="I found someone">
							<label for="thanks" style="font-size: 14px;">I found someone</label><br>
							<input type="checkbox" data-id="2" class="reason" name="dltReason" value="Too busy to look">
							<label for="busy" style="font-size: 14px;">Too busy to look</label><br>
							<input type="checkbox" data-id="3" class="reason" name="dltReason" value="Not interested">
							<label for="not" style="font-size: 14px;">Not interested</label><br>
							<input type="checkbox" data-id="4" class="reason" name="dltReason" value="Personal reasons">
							<label for="personal" style="font-size: 14px;">Personal reasons</label><br>
							<input type="checkbox" data-id="5" class="reason" name="dltReason" value="In a relationship">
							<label for="back" style="font-size: 14px;">In a relationship</label>
						</div>
						<span class="glyphicon form-control-feedback" id="selectReason" aria-hidden="true" style="color: red; display: none;">Please select your reason for leaving</span>
					</div>
					<div class="col-md-12">
						<div class="block">
							<div class="text-center m-4">
								<button type="button" class="btn btn-styled btn-md btn-base-1 z-depth-2-bottom w-50 deleteAccount onSubmit" onclick="validateDeleteAccount()" id="confirm_btn" data-id=<?= $this->session->userdata('member_id') ?>>Delete</button>
							</div>
						</div>
					</div>
				</div>
			</div>

	</div>
	</form>
</div>
</div>


<script type="text/javascript">
	function validateDeleteAccount() {
		var $enterPassAlert = $("#enter_pass");
		var $enterValidPassAlert = $("#enter_valid_pass");
		var $reasonAlert = $("#selectReason");

		$enterPassAlert.css("display", "none");
		$enterValidPassAlert.css("display", "none");
		$reasonAlert.css("display", "none");

		var password = $("#current_password").val();

		var isSuccess = true;

		// password
		if (password.trim() == "") {
			isSuccess = false;
			$enterPassAlert.css("display", "block");
			return;
		}

		if ($("#deleteAccountForm input:checkbox:checked").length == 0) {
			isSuccess = false;
			$reasonAlert.css("display", "block");
			return;
		} else {
			var reasons = [];
            $.each($("input[name='dltReason']:checked"), function(){
                reasons.push($(this).val());
            });
            // console.log(reasons);
			if (isSuccess == true) {
				formData = {
					"currentPassword": password, "reasons": reasons
				}
				$('#confirm_btn').html("<i class='fa fa-refresh fa-spin'></i> <?php echo translate('processing') ?>...");
				$.ajax({
					method: 'post',
					url: "<?= base_url() ?>home/reason",
					data: formData,
					cache: false,
					success: function(msg) {
						if (msg == "Invalid_Password") {
							$('#confirm_btn').html("<?php echo translate('delete') ?>");
							$enterValidPassAlert.show();
						} else {
						    $('#confirm_btn').html("<?php echo translate('delete') ?>");
						    alert("Success! Your account has been deleted");
						    window.location.href = 'login';
						}
					},
					error: function() {
						console.log("AJAX error");
					}
				});
			}
		}
	}

	// $(document).ready(function () {

	//     $(".onSubmit").on('click', function () {
	//         // var current_pass = "";
	//         // current_pass = $("#current_password").val();
	//         // console.log(current_pass);
	//         // if (current_pass == '') {
	//         //     alert('Current password field must not be empty!');
	//         // }
	//         // console.log($('#deleteAccountForm').serialize());

	//         //Save Reason For Deleting Account
	//         $.ajax({
	//             method: 'post',
	//             url: "<?= base_url() ?>home/reason",
	//             data: $('#deleteAccountForm').serialize(),
	//             cache: false,
	//             success: function (msg) {
	//                 alert(msg);
	//             },
	//             error: function () {
	//                 console.log("AJAX error");
	//             }
	//         });
	//     }); //
	// });


	// //Delete Account feature
	// $(document).ready(function () {
	//     $(document).on('click', '.deleteAccount', function () {
	//         // var token = $('meta[name="csrf-token"]').attr('content');
	//         var member = $(this).data('id');
	//         console.log(member);

	//         $.ajax({
	//             method: 'post',
	//             url: "<?= base_url() ?>admin/member_delete/" + member,
	//             data: {
	//                 member: member,
	//                 // _token: token
	//             },
	//             cache: false,
	//             success: function (result) {

	//                 return location.reload();

	//             },
	//             error: function () {
	//                 console.log("AJAX error");
	//             }
	//         });
	//     });
	// });
</script>