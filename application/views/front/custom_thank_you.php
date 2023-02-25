
<!DOCTYPE html>
<html>
<head>
	<title>Match Made in Jannah</title>
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>
<body>		

<section>
	<div class="container">
		<div class="d-flex align-items-center justify-content-center" style="margin-top: 50px;">
			<div class="p-2  text-center">
				<a class="navbar-brand" href="<?=base_url()?>home/" style="width:100%">
					<img src="http://wd.rssoft.win/matchmade/uploads/header_logo/header_logo_1600378115.png" class="img-responsive" height="100%" width="100%">
				</a><br><br>
				<h1 class="section-title"  style="color: #000;font-weight: bold; font-size: 30px;">Thank You</h1>
				<i class="fa fa-check-circle" style="color: #000;font-weight: bold; font-size: 50px;"></i>
				<br>
				<p class="text-blue">
					
					<?php if (isset($advertisement)): ?>
						<b>Your advertisement will now be screened and you will be notified soon</b>
					<?php endif ?>
					<?php if ( !isset($cover_pics_cleck) && !isset($advertisement) && !isset($contact_send) ): ?>
						<b>Thank you for <?= $value ?> at Match Made in Jannah.</b>
					<?php endif ?>
					<?php if (isset($contact_send)): ?>
						<b>We Appreciate You Contacting Us</b>
					<?php endif ?>
					<br><b>Have A Great Day!</b>
				</p>
				
				<?php if (isset($cover_pics_cleck)): ?>
					<p><b>SELECT:  Photo(s) & Video Upload, then click Cover Photo Upload to continue...</b></p>
				<?php endif ?>
				<!-- <br>
				<p>Having trouble? <a class="text-red" href="https://www.blauda.co.ke/contact-us">Contact us</a></p>
				<br>
				<p><a class="btn btn-sm no-rad bg-blue" href="https://www.blauda.co.ke/">Continue to homepage</a></p> -->
			</div>
		</div>
	</div>
</section>
<?php if ($value == "buying cover pic package") { ?>
	<script>
		$(document).ready(function(){
			setTimeout(function(){
	    		window.location.href = "<?=base_url("/home/profile?thanks=2")?>";	    		
	    	}, 10000);
		})
	</script>
<?php }else{ ?>

	<script>
		$(document).ready(function(){
			setTimeout(function(){
	    		window.location.href = "<?=base_url("/")?>";	    		
	    	}, 12000);
		})
	</script> 

<?php } ?> 
  
</body>
</html>