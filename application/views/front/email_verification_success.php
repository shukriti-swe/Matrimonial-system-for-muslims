<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title ?></title>
</head>
<body>
	<a href='<?=base_url()?>'><img class="mx-auto d-block" src='<?=base_url()?>uploads/header_logo/header_logo_1558265578.png'></a>
	<br><br>
	<h1 style=" text-align: center;">Congratulations!<h1>

	<!--<h2 style=" text-align: center;">You have successfully verified your email. Now you can proceed to complete the registration process.</h2>-->
	<h2 style=" text-align: center;">You have successfully verified your email. please <a href="<?=base_url()?>home/profile_detail/"><b><u>CLICK HERE</u></b></a> to complete the registration process.</h2>

	<script src="<?php echo base_url() ?>template/front/vendor/jquery/jquery.min.js"></script>
	<script>
		$(document).ready(function () {
			encryptMemberId = '<?php echo $encryptMemberId ?>';
			memberId = '<?php echo $this->session->userdata('member_id') ?>';
			formData = {'encryptMemberId': encryptMemberId}

	        $.ajax({
	            method: 'post',
	            dataType:'text',
	            data: formData,
	            url: "<?=base_url()?>home/email_verified/",
	            success: function (data) {

	                // if (data == true){
	                // 	setTimeout(function(){
	                // 		if (memberId == '' || memberId == undefined)
	                // 		{
	                // 			window.location.href = "<?=base_url()?>home/login";
	                // 		}
	                // 		else
	                // 		{
	                // 			window.location.href = "<?=base_url()?>home";
	                // 		}
	                		
	                // 	}, 2000);
	                // }

	            },
	            error: function (error) {
	                console.log(error);
	            }
	        });
		})
	</script>
</body>
</html>