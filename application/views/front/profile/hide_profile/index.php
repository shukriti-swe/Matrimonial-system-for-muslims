<div class="card-title card-bg-c">
	<div class="d-flex">
		<div class="flex-fill">
			<button type="button" class="btn btn-light btn-sm btn-icon-only btn-shadow mt-2" onclick="return location.reload();">
				<span><i class="ion-arrow-left-c"></i></span> Back
			</button></div>
		<div class="flex-fill">
			<h4 class="heading heading-6 text-left">
				HIDE MY PROFILE
			</h4>
		</div>
	</div>

</div>
<div class="card-body">

	<div id="main_view">
		<form class="form-default text-center" id="validate_password" data-toggle="validator" role="form">
			<div class="card-body">
				<form class="form-default col-12" method="post" role="form">
					<div class="row">
						<div class="col-md-10 ml-auto mr-auto" style="padding-top: 12px; text-align: left; font-size: 12px">
							<div class="form-group has-feedback">
								<label for="current_password" class="control-label" style="color: black; font-size: 14px;"><b>CURRENT PASSWORD</b></label>
								<input type="password" class="form-control" name="current_password" id="current_password" required>
								<span class="glyphicon form-control-feedback" aria-hidden="true" style="color: red; float:right">* Required</span>
								<!--<div style="font-size: 12px; margin: 7px;"">-->
								<!--    <a href="<?= base_url() ?>home/forget_pass" class="c-gray-light"><?php echo translate('recover_password') ?></a>-->
								<!--</div>-->
								<div class="help-block with-errors"></div>
							</div>
						</div>

						<div class="col-md-10 ml-auto mr-auto filter-radio" style="padding-top: 12px; text-align: left; font-size: 12px">

							<div style="text-align: left">
								<input type="checkbox" data-id="1" name="hide">
								<label for="hide" class="styles">Hide Profile</label><br>
								<input type="checkbox" data-id="2" name="show">
								<label for="show" class="styles">Show Profile</label><br>
							</div>

						</div>
					</div>
				</form>
			</div>

			<style>
				.styles {
					margin: 5px;
					font-size: 14px;
					color: black;
				}
			</style>

			<div class="col-md-12">
				<div class="form-group has-feedback text-center">
					<div class="text-danger" id="validation_error">
						<!-- Shows Validation Errors -->
					</div>

					<div class="text-center m-4">
						<button type="button" class="btn btn-styled btn-md btn-base-1 z-depth-2-bottom w-50 onSubmit" id="btn_pass"><?php echo translate('save') ?></button>
					</div>

				</div>
			</div>
	</div>


	<script>
		//Hide / Show feature
		//$(document).ready(function () {
		//
		//    var current_pass = "";
		//    $("#current_password").keyup(function () {
		//        current_pass = $("#current_password").val();
		//        console.log(current_pass);
		//        if (current_pass == '') {
		//            alert('Current password field must not be empty!');
		//        }
		//
		//    $(document).on('click', '.hideShow', function () {
		//            // var token = $('meta[name="csrf-token"]').attr('content');
		//            var value = $(this).data('id');
		//            console.log(value);
		//
		//        $(document).on('click', '.onSubmit', function () {
		//            console.log('ss');
		//            $.ajax({
		//                method: 'post',
		//                url: "<?//=base_url()?>//home/hideProfile/"+value,
		//                data: {
		//                    value: value,
		//                    // _token: token
		//                },
		//                cache: false,
		//                success: function (result) {
		//
		//                    return location.reload();
		//
		//                },
		//                error: function () {
		//                    console.log("AJAX error");
		//                }
		//            });
		//    });
		//});
		//});

		$(document).ready(function() {
			// var current_pass = "";
			$(".onSubmit").on('click', function() {
				// current_pass = $("#current_password").val();
				// console.log(current_pass);
				// if (current_pass == '') {
				//     alert('Current password field must not be empty!');
				// }


				//Save Reason For Deleting Account
				$.ajax({
					method: 'post',
					url: "<?= base_url() ?>home/hideProfile/",
					data: $('#validate_password').serialize(),
					cache: false,
					success: function(msg) {
						alert(msg);
					},
					error: function() {
						console.log("AJAX error");
					}
				});
			});

		});
	</script>